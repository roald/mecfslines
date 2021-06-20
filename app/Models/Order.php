<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Notifications\OrderPaid;
use App\Notifications\PaymentFailed;
use App\Notifications\PaymentReceipt;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'payed_at' => 'datetime',
    ];

    protected $fillable = ['user_id', 'amount', 'status'];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isPaid()
    {
        return $this->status == 'paid';
    }

    public function complete()
    {
        if( !$this->isPaid() ) return false;

        // Activate subscriptions
        foreach( $this->subscriptions as $subscription ) {
            $subscription->activate();
        }
        
        // Link events
        foreach( $this->events as $event ) {
            $event->participate($this->user);
        }

        // Send payment receipt
        $this->user->notify(new PaymentReceipt($this));
        if( env('TALC_NOTIFY_USERS', false) ) {
            $adminIds = explode(',', env('TALC_NOTIFY_USERS'));
            $admins = User::whereIn('id', $adminIds)->get();
            foreach( $admins as $admin ) $admin->notify(new OrderPaid($this));
        }
        
        return true;
    }

    public function paymentFailed()
    {
        if( $this->isPaid() ) return;

        // Deactivate subscriptions
        $this->subscriptions()->update(['started_at' => null, 'ended_at' => null]);

        // Send payment failed notification
        $this->user->notify(new PaymentFailed($this));
    }

    public function calculate()
    {
        // Precondition failed
        if( $this->isPaid() ) abort(412);

        $this->amount = $this->subscriptions->sum(function($subscription) { return $subscription->membership->price; });
        $this->amount += $this->products->sum('price');
        $this->save();
    }
}
