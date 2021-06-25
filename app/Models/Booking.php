<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected  $fillable = [
        'user_id',
        'status',
    ];
    
    // bookings : statuses == 1:n
    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    // bookings : users == n:1
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}