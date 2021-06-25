<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected  $fillable = [
        'type',
        'category_name'
    ];

    // categories : titles == 1:n
    public function titles()
    {
        return $this->hasMany(Title::class);
    }
}