<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'country',
        'state',
        'address', //oder user addresse -> $hidden ??
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // titles : users == n:m
    public function titles()
    {
        return $this->belongsToMany(Title::class, 'title_user', 'title_id', 'user_id', 'id', 'id');//->withPivot('condition','max_loan_days','possible_delivery_methods');
    }

    // Bookings : users == n:1
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id', 'id');
    }
}