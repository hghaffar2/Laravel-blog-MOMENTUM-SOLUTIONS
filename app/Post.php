<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'post','user_id'
        ];

    protected function comments(){
        return $this->hasMany('App\Comment');
    }
    protected function user(){
        return $this->belongsTo('App\User');
    }



}
