<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;

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
}
