<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Models\Subscription;

class SubscriptionController extends Controller
{
    public function index()
    {
        return redirect()->route('users.index');
    }

    public function create()
    {
        $subscription = new Subscription();
        return view('subscriptions.edit')->with('subscription', $subscription);
    }

    public function store(SubscriptionRequest $request)
    {
        $subscription = Subscription::create($request->allValidated());
        return redirect()->route('subscriptions.show', $subscription);
    }

    public function show(Subscription $subscription)
    {
        return view('subscriptions.show')->with('subscription', $subscription);
    }

    public function edit(Subscription $subscription)
    {
        return view('subscriptions.edit')->with('subscription', $subscription);
    }

    public function update(SubscriptionRequest $request, Subscription $subscription)
    {
        $subscription->fill($request->allValidated())->save();
        return redirect()->route('subscriptions.show', $subscription);
    }

    public function remove(Subscription $subscription)
    {
        return view('subscriptions.remove')->with('subscription', $subscription);
    }

    public function destroy(Subscription $subscription)
    {
        $subscription->delete();
        return redirect()->route('subscriptions.index');
    }
}
