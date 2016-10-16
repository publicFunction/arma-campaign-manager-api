<?php

namespace ARMACMan\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servers extends Model
{
    use SoftDeletes;

    protected $table = 'servers';
    protected $fillable = ['community_id', 'name', 'ip_address', 'port', 'query_port'];

}
