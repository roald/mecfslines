<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Membership extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'duration', 'price', 'status', 'extend_id'];

    public static $durations = ['1 month', '3 months', '1 year'];

    public static $stati = ['active', 'inactive'];

    public function extend()
    {
        return $this->belongsTo(Membership::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function buy(Order $order = null)
    {
        // User as to be signed in
        if( !Auth::check() ) abort(401);

        // Create Order
        if( is_null($order) ) {
            $order = Auth::user()->orders()->create(['status' => 'open', 'amount' => 0]);
        }

        // Create Subscription for Order
        $order->subscriptions()->create(['membership_id' => $this->id, 'user_id' => Auth::user()->id]);

        // Calculate amount
        $order->calculate();

        return $order;
    }
}
