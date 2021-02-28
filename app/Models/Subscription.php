<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    protected $fillable = ['membership_id', 'order_id', 'user_id'];

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activate()
    {
        // Determine subscription start
        if( empty($this->started_at) ) {
            $currentEndDate = $this->user->subscriptions()->max('ended_at');
            if( empty($currentEndDate) ) $currentEndDate = Carbon::now();
            $this->started_at = $currentEndDate;
        }

        // Determine subscription end
        if( empty($this->ended_at) ) {
            $this->ended_at = $this->started_at->add($this->membership->duration);
        }

        $this->save();
    }
}
