<?php

namespace ARMACMan\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use SoftDeletes;

    protected $table = 'member_profile';

    /*public function member() {
        return $this->belongsTo(User::class);
    }*/

    /*public function profile() {
        return $this->belongsTo(CommunityProfile::class);
    }*/
}
