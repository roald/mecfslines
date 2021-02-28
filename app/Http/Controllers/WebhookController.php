<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\OrderPayed;
use App\Models\Payment;
use Carbon\Carbon;

class WebhookController extends Controller
{
    public function mollie(Request $request)
    {
        // Get Mollie payment
        if( !$request->has('id') ) abort(500);
        $mollie = mollie()->payments()->get($request->id);
        if( !$mollie ) abort(500);

        // Find local Payment
        $payment = Payment::find($mollie->metadata->payment_id);
        if( !empty($payment->reference) && $payment->reference != $request->id ) abort(404);

        // Update Payment
        $payment->status = $mollie->status;
        $payment->method = $mollie->method;

        // Only update Order on changes
        if( $payment->isDirty() ) {
            $payment->save();

            $order = $payment->order;
            if( !$order->isCompleted() ) {
                $order->status = $mollie->status;
                if( $mollie->status == 'paid' ) $order->payed_at = $mollie->paidAt;
                $order->save();

                // Active Subscriptions
                if( $order->isCompleted() ) {
                    foreach( $order->subscriptions as $subscription ) {
                        $subscription->activate();
                    }
                }
            }
        }
    }
}
