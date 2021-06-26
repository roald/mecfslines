<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;

class ExtendSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:extend';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Extend subscriptions ending tomorrow';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Look from 4 days back until tomorrow
        $periodStart = Carbon::now()->subDays(4)->startOfDay();
        $periodEnd = Carbon::tomorrow()->endOfDay();

        // Loop through users
        $users = User::with('subscriptions')->whereHas('subscriptions')->get();
        foreach( $users as $user ) {
            // Search for users whose subscription is ending
            $subscriptionEnd = $user->subscriptions->max('ended_at');
            if( $subscriptionEnd > $periodStart && $subscriptionEnd < $periodEnd ) {
                $this->verifyExtension($user);
            }
        }

        return 0;
    }

    /**
     * Check if the User should get an extension to the subscription
     */
    public function verifyExtension(User $user)
    {
        // Get current / latest Subscription
        $subscription = $user->subscriptions()->orderBy('ended_at', 'desc')->first();

        // Verify that subscription is ending
        if( $subscription->ended_at > Carbon::tomorrow()->endOfDay() ) return;

        // Verify that subscription can be extended
        if( is_null($subscription->membership->extend_id) ) return;

        // Verify User has mandate
        if( $user->hasMandate() == false ) return;

        // Extend Subscription
        $this->extendSubscription($user, $subscription);
    }

    /**
     * Create the extension to the subscription
     */
    public function extendSubscription(User $user, Subscription $oldSubscription)
    {
        // Create Order with new Subscription
        $order = $user->orders()->create(['status' => 'open', 'amount' => 0]);
        $subscription = $order->subscriptions()->create([
            'membership_id' => $oldSubscription->membership->extend_id,
            'user_id' => $user->id,
        ]);
        $order->calculate();

        // Create automatic Payment
        $payment = $order->payments()->create([
            'description' => __('Order') ." #". $order->id,
            'amount' => $order->amount,
            'status' => 'open',
        ]);
        $mollie = mollie()->payments()->create([
            'amount' => [
                'currency' => 'EUR',
                'value' => $payment->amount,
            ],    
            'customerId'  => $order->user->mollie(),
            'sequenceType' => 'recurring',
            'description' => $payment->description,
            'redirectUrl' => route('orders.detail', $order),
            'webhookUrl'  => \App::environment('production') ? route('webhooks.mollie') : null,
            'metadata'    => [
                'payment_id' => $payment->id,
            ],    
        ]);    
        $payment->reference = $mollie->id;
        $payment->save();

        // Activate Subscription
        $subscription->activate();
    }
}
