<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

     public $table = 'users'; 
     protected $primaryKey = 'id';  
     public $incrementing = false; 
     
    protected $fillable = [
        'id',
        'username',
        'password',
        'api_token',
        'role'
    ];

    protected $hidden = [
        'password'
    ];

    
}
