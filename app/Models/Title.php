<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'author_id',
        'category_id',
        'title',
        'subtitle',
        'description',
        'edition',
        'publisher',
        'publication_year',
        'publication_format',
        'isbn_10',
        'isbn_13',
        'asin',
        'title_img',        
    ];

    //titles : users == 1:m
    public function users()
    {
        return $this->belongsToMany(User::class, 'title_user', 'user_id', 'title_id', 'id', 'id')->withPivot('condition','max_loan_days','possible_delivery_methods');
    }
    
    // titles : authors == n:1 (so kange keine Co- Autoren etc. erl.)
    public function authors()
    {
        return $this->belongsTo(Author::class);
    }

    // titles : category == n:1
    public function categories()
    {
        return $this->belongsTo(Category::class);
    } 
}