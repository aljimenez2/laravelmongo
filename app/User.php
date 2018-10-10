<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Authenticatable ;

class User extends Authenticatable
{
    protected $connection = 'mongodb';
    protected $collection = 'users';
    protected $primaryKey = 'id';
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}