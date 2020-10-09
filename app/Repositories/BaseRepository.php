<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @param Model $model
     *
     * @throws Exception
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes)
    {
        $model = $this->model->newInstance($attributes);

        $model->save();

        return $model;
    }

    public function update(array $attributes,int $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $model->fill($attributes);

        $model->save();

        return $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getNewQuery()
    {
        return $this->model->newQuery();
    }
}
