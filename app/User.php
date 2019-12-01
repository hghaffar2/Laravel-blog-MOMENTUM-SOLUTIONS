<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;


    protected $fillable = [
        'first_name','last_name', 'email', 'password'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected function posts(){
        return $this->hasMany('App\Post');
    }
    protected function comments(){
        return $this->hasMany('App\Comment');
    }
}
