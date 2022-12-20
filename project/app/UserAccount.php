<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserAccount extends Authenticatable
{
    use Notifiable;
    public $table = "user_profiles";
    protected $fillable = [
        'name','country','zip','current_balance', 'gender', 'email', 'phone', 'password', 'fax', 'address', 'city', 'zip', 'status', 'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
