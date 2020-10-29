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
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function modelFilter(string $modelFilterClass, ?array $input = []) {
        /** @phpstan-ignore-next-line */
        return $this->model->modelFilter($modelFilterClass, $input);
    }

    public function create(array $attributes)
    {
        $model = $this->model->newInstance($attributes);

        $model->save();

        return $model;
    }

    public function update(array $attributes,int $id)
    {
        $model = $this->getNewQuery()->findOrFail($id);

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

    public function find(int $id,array $columns = ['*'])
    {
        return $this->getNewQuery()->findOrFail($id, $columns);

    }
}
