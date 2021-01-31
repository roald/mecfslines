<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $fillable = ['block', 'type', 'action', 'target', 'page_id', 'order', 'role'];

    public static $types = ['page', 'url'];

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
