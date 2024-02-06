<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //a post belongto one category
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    //a post belongto one user
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    //post has many comment
    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }
}
