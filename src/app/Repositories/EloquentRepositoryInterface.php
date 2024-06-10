<?php

namespace App\Repositories;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentRepositoryInterface
{

    /**
     * find
     *
     * @param  string $id
     * @return Model
     */
    public function find($id): Model;

    /**
     * create
     *
     * @param  array $data
     * @return Model
     */
    public function create(array $data): Model;

    /**
     * update
     *
     * @param  string $id
     * @param  array $data
     * @return Model
     */
    public function update(Model $model, array $data): Model;

}
