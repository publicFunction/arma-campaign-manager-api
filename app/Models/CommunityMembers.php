<?php

namespace ARMACMan\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommunityMembers extends Model
{
    use SoftDeletes;

    protected $table = 'community_members';

    public function member() {
        return $this->belongsTo(Members::class);
    }



}
