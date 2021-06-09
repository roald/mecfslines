<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'payed_at' => 'datetime',
    ];

    protected $fillable = ['user_id', 'amount', 'status'];

    public function events()
    {
        return $this->belongsToMany(Order::class);
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

    public function isCompleted()
    {
        return $this->status == 'paid';
    }

    public function complete()
    {
        if( !$this->isCompleted() ) return false;

        // Activate subscriptions
        foreach( $this->subscriptions as $subscription ) {
            $subscription->activate();
        }

        // Link events
        foreach( $this->events as $event ) {
            $event->participate($this->user);
        }
    }
}
