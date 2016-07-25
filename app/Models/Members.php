<?php

namespace ARMACMan\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Members extends Model
{
    use SoftDeletes;

    protected $table = 'members';

    public function member() {
        return $this->belongsTo(Members::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function profile() {
        return $this->belongsTo(Profile::class);
    }
}
