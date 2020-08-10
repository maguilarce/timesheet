<?php

namespace App;

/*use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract; 
*/

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//class Users extends Model implements
//  AuthenticatableContract,
//  AuthorizableContract,
// CanResetPasswordContract

class User extends Authenticatable
{
    use Authenticatable, Authorizable, CanResetPassword;
    //protected $table = "users";

    protected $fillable = [
        'username',
        'password',
        'first_name',
        'last_name',
        'email',
        'password_changed_at'


    ];
}
