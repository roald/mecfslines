<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $fillable = ['page', 'type', 'order', 'heading', 'topic', 'body'];

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

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
