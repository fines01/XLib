<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class TitleUser extends Pivot
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title_id',
        'user_id',
        'status_id',
        'max_loan_days',
        'condition',
        'possible_delivery_methods',
    ];
    
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;
    
    // items : statuses == 1:1
    public function status()
    {
    return $this->belongsTo(Status::class);
    }

    // items : titles == n:1
    public function title()
    {
        return $this->belongsTo(Title::class);//
    }

    // items : users == n:1
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}