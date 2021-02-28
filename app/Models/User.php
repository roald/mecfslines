<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Carbon\Carbon;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'role', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static $roles = ['user', 'admin'];

    public function events()
    {
        return $this->belongsToMany(Event::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function isAdmin()
    {
        return $this->role == 'admin';
    }

    public function isMember()
    {
        return $this->subscriptions()->where('ended_at', '>', Carbon::now())->count() > 0;
    }

    public function mollie()
    {
        // Return existing Mollie customer ID
        if( $this->mollie_id ) return $this->mollie_id;

        // Create new Mollie customer
        $mollie = mollie()->customers()->create([
            'name'  => $this->name,
            'email' => $this->email,
        ]);
        $this->mollie_id = $mollie->id;
        $this->save();
        return $this->mollie_id;
    }
}
