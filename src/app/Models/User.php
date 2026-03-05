<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_completed',

    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function boughtOrders()
    {
        return $this->hasMany(Order::class,'buyer_id');
    }

    public function soldOrders()
    {
        return $this->hasMany(Order::class,'seller_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function favoriteItems()
    {
        return $this->belongsToMany(Item::class,'favorites');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
