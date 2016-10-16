<?php

namespace ARMACMan\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Community extends Model
{
    use SoftDeletes;

    protected $table = 'community';
    protected $with = ['profile', 'owner', 'members', 'members.member', 'members.member.user'];

    public function owner() {
        return $this->belongsTo(User::class);
    }

    public function profile() {
        return $this->belongsTo(CommunityProfile::class);
    }

    public function members() {
        return $this->hasMany(CommunityMembers::class);
    }

    public function servers() {
        return $this->hasMany(Servers::class);
    }

}
