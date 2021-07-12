<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected  $fillable = [
        'first_name',
        'last_name'
    ];
    
    // authors : titles == 1:n
    public function titles()
    {
        return $this->hasMany(Title::class);
    } 
    
}