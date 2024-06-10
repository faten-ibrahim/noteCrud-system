<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseRepository implements EloquentRepositoryInterface
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }


    /**
     * create
     *
     * @param array $data
     *
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    /**
     * update
     *
     * @param  string $id
     * @param  array $data
     * @return Model
     */
    public function update($id, array $data): Model
    {
        $model = $this->model->findOrFail($id);
        $model->update($data);
        return $model;
    }

    /**
     * find
     *
     * @param  string $id
     * @return Model
     */
    public function find($id): Model
    {
        return $this->model->findOrFail($id);
    }
}
