<?php

namespace ARMACMan\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Community extends Model
{
    use SoftDeletes;

    public function owner() {
        return $this->hasOne(User::class);
    }
}
