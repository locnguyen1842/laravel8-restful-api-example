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
     * @param string
     * @param array|[] $searchQuery
     *
     * @return \Illuminate\Database\Eloquent\Builder
     * @throws \Exception
     */
    public function modelFilter(string $modelFilterClass, ?array $searchQuery = []);
}