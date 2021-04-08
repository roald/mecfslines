<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Models\Subscription;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
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
        $subscription->started_at = Carbon::parse($request->started_at)->startOfDay();
        $subscription->ended_at = Carbon::parse($request->ended_at)->endOfDay();
        $subscription->save();
        
        return redirect()->route('subscriptions.show', $subscription);
    }
}
