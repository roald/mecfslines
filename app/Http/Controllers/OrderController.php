<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(20);
        return view('orders.index')->with('orders', $orders);
    }

    public function create(User $user)
    {
        $order = new Order(['amount' => 0, 'status' => 'open', 'user_id' => $user->id]);
        return view('orders.edit')->with('order', $order);
    }

    public function store(OrderRequest $request, User $user)
    {
        // Create Order
        $order = $user->orders()->create([
            'amount' => $request->amount,
            'status' => 'open',
        ]);

        // Add possible Subscription
        if($request->has('membership_id') && !empty($request->membership_id)) {
            $user->subscriptions()->create([
                'membership_id' => $request->membership_id,
                'order_id' => $order->id,
            ]);
        }

        // Link possible Products
        if( $request->has('product_ids') ) {
            $order->products()->sync(array_keys($request->product_ids));
        }

        return redirect()->route('orders.show', $order);
    }

    public function show(Order $order)
    {
        return view('orders.show')->with('order', $order);
    }

    public function edit(Order $order)
    {
        if( $order->isCompleted() ) abort(403);
        return view('orders.edit')->with('order', $order);
    }

    public function update(OrderRequest $request, Order $order)
    {
        if( $order->isCompleted() ) abort(403);

        // Update Order
        $order->amount = $request->amount;
        $order->save();

        if( !empty($request->membership_id) && $order->subscriptions()->count() == 0 ) {
            // Add Subscription to Order
            $user->subscriptions()->create([
                'membership_id' => $request->membership_id,
                'order_id' => $order->id,
            ]);
        } elseif( $order->subscriptions()->count() == 1 ) {
            // Manage linked Subscription
            $subscription = $order->subscriptions()->first();
            if( !empty($subscription->started_at) ) return redirect()->back()->withInput()->with('errors', collect([__('Not allowed to change active subscription')]));

            if( empty($request->membership_id) ) {
                // Remove requested Membership
                $subscription->delete();
            } elseif( $request->membership_id != $subscription->membership_id ) {
                // Update requested Membership
                $subscription->membership_id = $request->membership_id;
                $subscription->save();
            }
        }

        // Update Products
        if( $request->has('product_ids') || $order->products()->count() > 0 ) {
            $order->products()->sync(array_keys($request->product_ids));
        }

        return redirect()->route('orders.show', $order);
    }

    public function remove(Order $order)
    {
        if( $order->isCompleted() ) abort(403);
        return view('orders.remove')->with('order', $order);
    }

    public function destroy(Order $order)
    {
        if( $order->isCompleted() ) abort(403);
        if( $order->subscriptions()->whereNotNull('started_at')->count() > 0 ) abort(403);
        $order->subscriptions()->delete();
        $order->products()->detach();
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

    public function calculate(Order $order)
    {
        if( $order->isCompleted() ) abort(403);

        $order->amount = $order->subscriptions->sum(function($subscription) { return $subscription->membership->price; });
        $order->amount += $order->products->sum('price');
        $order->save();

        return redirect()->route('orders.show', $order);
    }
}
