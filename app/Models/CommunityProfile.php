<?php

namespace ARMACMan\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CommunityProfile extends Model
{
    use SoftDeletes;

    protected $table = 'community_profile';

    
}
