<?php

namespace ARMACMan\Transfomers\Community;


use ARMACMan\Models\Community;
use ARMACMan\Models\Servers;
use ARMACMan\Transfomers\Transformer;

class ServerTransformer extends Transformer
{
    private $model;

    public function __construct(Servers $servers)
    {
        $this->model = $servers;
    }

    public function transform(Servers $server) {
        $transformed = [
            'id' => $server->id,
            'name' => $server->name,
            'ip_address' => $server->ip_address,
            'port' => $server->port,
            'query_port' => $server->query_port,
        ];
        return $transformed;
    }

    public function transformMany($servers) {
        return $servers->map(function($server){
            return $this->transform($server);
        });
    }

}