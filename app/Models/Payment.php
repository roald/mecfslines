<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['description', 'amount', 'status'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getCheckoutUrl()
    {
        if( $this->reference ) {

            // Existing Mollie payment
            $mollie = mollie()->payments()->get($this->reference);
            if( $mollie ) return $mollie->getCheckoutUrl();

        } else {

            // Create new Mollie payment
            $mollie = mollie()->payments()->create([
                'amount' => [
                    'currency' => 'EUR',
                    'value' => $this->amount,
                ],
                'customerId'  => $this->order->user->mollie(),
                'sequenceType' => 'oneoff',
                'description' => $this->description,
                'redirectUrl' => route('orders.detail', $this->order),
                'webhookUrl'  => \App::environment('production') ? route('webhooks.mollie') : null,
                'metadata'    => [
                    'payment_id' => $this->id,
                ],
            ]);
            $this->reference = $mollie->id;
            $this->save();

            return $mollie->getCheckoutUrl();
        }
    }

    public function isCompleted()
    {
        return in_array($this->status, ['paid', 'canceled', 'expired', 'failed']);
    }

    public function isSuccessful()
    {
        return $this->status == 'paid';
    }

    public function isUnsuccessful()
    {
        return in_array($this->status, ['canceled', 'expired', 'failed']);
    }

    public function syncStatus($mollie = null)
    {
        // Get Mollie status
        if( empty($this->reference) ) abort(500);
        if( is_null($mollie) ) $mollie = mollie()->payments()->get($this->reference);
        if( !$mollie ) abort(500);

        // Update Payment
        $this->status = $mollie->status;
        $this->method = $mollie->method;
        if( $this->isClean() ) return; // Only continue on changes
        $this->save();

        // Push updates onto Order
        $order = $this->order;
        if( !$order->isPaid() ) {
            $order->status = $mollie->status;
            if( $order->isPaid() ) $order->payed_at = $mollie->paidAt;
            $order->save();
        }
        if( $this->isSuccessful() ) $order->complete();
        if( $this->isUnsuccessful() ) $order->paymentFailed();
    }
}
