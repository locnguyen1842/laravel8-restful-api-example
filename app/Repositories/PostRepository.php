<?php

namespace App\Repositories;

use App\Repositories\Contracts\PostRepositoryInterface;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    /**
     * @var \App\Models\Post
     */
    protected $model;

    /**
     * PostRepository constructor.
     *
     * @param Post $model
     */
    public function __construct(\App\Models\Post $model)
    {
        parent::__construct($model);
    }
}
