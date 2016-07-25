<?php

namespace ARMACMan\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{

    use SoftDeletes;

    public function users() {
        return $this->belongsToMany(User::class, 'users_roles', 'user_id', 'role_id');
    }

}
