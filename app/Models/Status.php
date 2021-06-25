<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected  $fillable = [
        'booking_id',
        'available',
        'booking_date',
        'return_date',
        'notification_sent',
        'delivery_method'
    ];

    // statuses : bookings == n:1
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    
    // statuses : title_user (single items) == 1:1
    public function item()
    {
        return $this->hasOne(TitleUser::class);
    }
}