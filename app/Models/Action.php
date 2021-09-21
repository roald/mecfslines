<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;

    protected $fillable = ['block', 'type', 'action', 'target', 'page_id', 'order', 'role'];

    public static $types = ['page', 'url', 'email'];

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function link()
    {
        if( $this->type == 'url' ) {
            return $this->target;
        } elseif( $this->type == 'page' ) {
            return route('web.page', $this->page);
        } elseif( $this->type == 'email' ) {
            return 'mailto:'. $this->target;
        } else {
            abort(404);
        }
    }
}
