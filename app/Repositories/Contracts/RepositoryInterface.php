<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface {
    
    /**
     * Get a model.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getModel();

    /**
     * Get a new query builder.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getNewQuery();

    /**
     * Create model record
     *
     * @param array $attributes
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function create(array $attributes);

    /**
     * Update model record for given id
     *
     * @param array $attributes
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws \Exception
     */
    public function update(array $attributes, int $id);

    /**
     * Set a model filter
     *
     * @param string $modelFilterClass
     * @param array|null $searchQuery
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws \Exception
     */
    public function modelFilter(string $modelFilterClass, ?array $searchQuery = []);
    
    /**
     * Find a model by its primary key or throw an exception.
     *
     * @param  int  $id
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static|static[]
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function find(int $id,array $columns = ['*']);
}