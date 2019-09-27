<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'firstname',
        'middlename',
        'surname',
        'street',
        'barangay',
        'city',
        'state',
        'country',
        'postal_code',
        'email',
        'password',
        'role',
        'is_activated',
        'contact_number',
        'contact_number_two',
        'avatar',
        'avatar_size',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

}
