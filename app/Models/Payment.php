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
                'webhookUrl'  => route('webhooks.mollie'),
                'metadata'    => [
                    'payment_id' => $this->id,
                ],
            ]);
            $this->reference = $mollie->id;
            $this->save();

            return $mollie->getCheckoutUrl();

        }
    }
}
