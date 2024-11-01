<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    protected $fillable = ['title', 'slug', 'type', 'description', 'started_at', 'ended_at'];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public static $types = ['default'];

    public function multimedia()
    {
        return $this->morphOne(Multimedia::class, 'model');
    }

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

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('media')
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->singleFile()
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')->width('400')->height('400');
                $this->addMediaConversion('large')->width('1000')->height('1000');
            });
    }

    public function buy(Order $order = null)
    {
        // User as to be signed in
        if( !Auth::check() ) abort(401);

        // Create Order
        if( is_null($order) ) {
            $order = Auth::user()->orders()->create(['status' => 'open', 'amount' => 0]);
        }

        // Add Event to Order
        $order->events()->attach($this->id);

        // Calculate amount
        $order->calculate();

        return $order;
    }

    public function participate(User $user)
    {
        $this->users()->syncWithoutDetaching($user->id);
    }
}
