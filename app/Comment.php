<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment','user_id','post_id'
    ];

    protected function user(){
        return $this->belongsTo('App\User');
    }

    protected function post(){
        return $this->belongsTo('App\Post');
    }
}
