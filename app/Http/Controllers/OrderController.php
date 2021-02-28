<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Payment;
use Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();
        return view('orders.index')->with('orders', $orders);
    }

    public function create()
    {
        $order = new Order();
        return view('orders.edit')->with('order', $order);
    }

    public function store(OrderRequest $request)
    {
        $order = Order::create($request->allValidated());
        return redirect()->route('orders.show', $order);
    }

    public function show(Order $order)
    {
        return view('orders.show')->with('order', $order);
    }

    public function edit(Order $order)
    {
        return view('orders.edit')->with('order', $order);
    }

    public function update(OrderRequest $request, Order $order)
    {
        $order->fill($request->allValidated())->save();
        return redirect()->route('orders.show', $order);
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index');
    }

    public function mine()
    {
        $orders = Auth::user()->orders()->orderBy('updated_at', 'desc')->get();
        return view('profile.orders')->with('orders', $orders);
    }

    public function detail(Order $order)
    {
        if( Auth::user()->id != $order->user_id ) abort(403);

        return view('profile.payment')->with('order', $order);
    }

    public function pay(Order $order)
    {
        // Verify access
        if( Auth::user()->id != $order->user_id ) abort(403);
        if( $order->isCompleted() ) return redirect()->route('orders.detail', $order);

        // Check active payments
        foreach( $order->payments as $payment ) {
            $checkout = $payment->getCheckoutUrl();
            if( $checkout ) return redirect($checkout, 303);
        }

        // Create new Payment
        $payment = $order->payments()->create([
            'description' => __('Order') ." #". $order->id,
            'amount' => $order->amount,
            'status' => 'open',
        ]);
        $order->status = 'open';
        $order->save();
        return redirect($payment->getCheckoutUrl(), 303);
    }
}
