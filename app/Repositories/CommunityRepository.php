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

    public function getByOwner(User $owner)
    {
        return $this->model->where('owner_id', $owner->id)->with(['profile', 'members', 'members.member', 'members.member.user', 'members.member.profile'])->first();
    }
}