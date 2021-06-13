<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'slug', 'description', 'price', 'type', 'status'];

    public static $stati = ['available', 'unavailable', 'hidden'];
    public static $types = ['product'];

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
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

        // Add Product to Order
        $order->products()->attach($this->id);

        // Calculate amount
        $order->calculate();

        return $order;
    }
}
