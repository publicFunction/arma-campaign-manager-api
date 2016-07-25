<?php

namespace ARMACMan\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Community extends Model
{
    use SoftDeletes;

    protected $table = 'community';

    public function owner() {
        return $this->hasOne(User::class);
    }

    public function profile() {
        return $this->belongsTo(CommunityProfile::class);
    }

    public function members() {
        return $this->hasMany(CommunityMembers::class);
    }
}
