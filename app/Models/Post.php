<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;

class Post extends Model
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['title', 'slug', 'content', 'published_at'];

    protected $casts = [
        'published_at' => 'date',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function multimedia()
    {
        return $this->morphOne(Multimedia::class, 'model');
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
