<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // everything is fillable except
    // better security so people cannot add an id
    protected $guarded = [];
    protected $fillable = ['title', 'excerpt', 'body', 'user_id','category_id','slug'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
