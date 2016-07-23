<?php

namespace ARMACMan\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];
    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at'
    ];

    /**
     * Hash the user's password with bcrypt when setting.
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
