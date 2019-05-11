<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'name';
    protected $fillable = [
        'name', 'password','level','created_at','updated_at'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $dates = ['create_at','updated_at'];
    protected $dateFormat = 'Y/m/d';
    
    public $incrementing = false;

}
