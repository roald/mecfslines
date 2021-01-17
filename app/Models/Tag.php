<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function blocks()
    {
        return $this->morphedByMany(Block::class, 'taggable');
    }

    public function events()
    {
        return $this->morphedByMany(Event::class, 'taggable');
    }

    public function memberships()
    {
        return $this->morphedByMany(Membership::class, 'taggable');
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'taggable');
    }
}
