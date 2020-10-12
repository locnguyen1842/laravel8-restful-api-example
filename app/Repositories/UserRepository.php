<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * @var \App\Models\User
     */
    protected $model;

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(\App\Models\User $model)
    {
        parent::__construct($model);
    }
}
