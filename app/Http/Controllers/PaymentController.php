<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Order;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function index(Order $order)
    {
        return redirect()->route('orders.show', $order);
    }

    public function show(Payment $payment)
    {
        return view('payments.show')->with('payment', $payment);
    }

    public function mollie(Payment $payment)
    {
        if( empty($payment->reference) ) {
            return redirect()->route('payments.show', $payment);
        }

        $mollie = mollie()->payments()->get($payment->reference);
        return redirect($mollie->_links->dashboard->href);
    }

    public function refresh(Payment $payment)
    {
        $payment->syncStatus();
        return redirect()->route('payments.show', $payment);
    }
}
