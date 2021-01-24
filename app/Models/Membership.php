<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Membership extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'duration', 'price', 'status', 'repeatable'];

    public static $durations = ['1 month', '3 months', '1 year'];

    public static $stati = ['active', 'inactive'];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
