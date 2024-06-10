<?php

namespace App\Repositories;

use App\Model\User;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;


interface NoticeRepositoryInterface
{
    /**
     * get all notices
     *
     * @return Collection
     */
    public function all(): Collection;

    /**
     * delete
     *
     * @param  string $id
     * @return void
     */
    public function delete($id): void;
}
