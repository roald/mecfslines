<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Order $order)
    {
        return redirect()->route('orders.show', $order);
    }

    public function create(Order $order)
    {
        $payment = new Payment(['order' => $order]);
        return view('payments.edit')->with('payment', $payment);
    }

    public function store(PaymentRequest $request, Order $order)
    {
        $payment = new Payment($request->all());
        $order->payments()->save($payment);
        return redirect()->route('payments.show', $payment);
    }

    public function show(Payment $payment)
    {
        return view('payments.show')->with('payment', $payment);
    }

    public function edit(Payment $payment)
    {
        return view('payments.edit')->with('payment', $payment);
    }

    public function update(PaymentRequest $request, Payment $payment)
    {
        $payment->fill($request->all())->save();
        return redirect()->route('payments.show', $payment);
    }

    public function destroy(Payment $payment)
    {
        $order = $payment->order;
        $payment->delete();
        return redirect()->route('orders.payments.index', $order);
    }
}
