<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Block extends Model implements HasMedia
{
    use HasFactory, HasMediaTrait;

    protected $fillable = ['page', 'type', 'order', 'heading', 'topic', 'body', 'grant'];

    public static $grants = ['all', 'public', 'user'];

    public static $types = [
        'general' => ['header', 'text', 'footer'],
        'events' => ['event-list', 'event-detail'],
        'products' => ['product-list', 'product-detail'],
        'memberships' => ['membership-list'],
    ];

    public function actions()
    {
        return $this->hasMany(Action::class);
    }

    public function multimedia()
    {
        return $this->morphMany(Multimedia::class, 'model');
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('media')
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('thumb')->width('400')->height('400');
                $this->addMediaConversion('large')->width('1000')->height('1000');
            });
    }
}
