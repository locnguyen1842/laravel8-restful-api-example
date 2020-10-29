<?php

namespace App\Repositories;

use App\Repositories\Contracts\CommentRepositoryInterface;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    /**
     * @var \App\Models\Comment
     */
    protected $model;

    /**
     * CommentRepository constructor.
     *
     * @param \App\Models\Comment $model
     */
    public function __construct(\App\Models\Comment $model)
    {
        parent::__construct($model);
    }
}
