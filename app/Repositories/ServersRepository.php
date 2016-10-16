<?php

namespace ARMACMan\Repositories;

use ARMACMan\Models\Community;
use ARMACMan\Models\Servers;

class ServersRepository extends EloquentRepository
{
    /**
     * Set the relevant model instance.
     *
     * @param User $model
     */
    public function __construct(Servers $model)
    {
        $this->model = $model;
    }

    public function getById($server_id)
    {
        return $this->model->where('id', $server_id)->first();
    }

    public function getByCommunity(Community $community)
    {
        return $this->model->where('community_id', $community->id)->get();
    }
}