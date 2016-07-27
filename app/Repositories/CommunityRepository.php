<?php

namespace ARMACMan\Repositories;

use ARMACMan\Models\Community;
use ARMACMan\Models\User;

class CommunityRepository extends EloquentRepository
{
    /**
     * Set the relevant model instance.
     *
     * @param User $model
     */
    public function __construct(Community $model)
    {
        $this->model = $model;
    }

    public function getByUser(User $user)
    {
        return $this->model->where('owner_id', $user->id)->first();
    }
}