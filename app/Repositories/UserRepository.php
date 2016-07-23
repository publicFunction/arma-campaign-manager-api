<?php

namespace ARMACMan\Repositories;

use ARMACMan\Models\User;

class UserRepository extends EloquentRepository
{
    /**
     * Set the relevant model instance.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getByEmail($email)
    {
        return $this->model->where('email', $email)->first();
    }
}