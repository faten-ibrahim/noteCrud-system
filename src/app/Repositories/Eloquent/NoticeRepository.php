<?php

namespace App\Repositories\Eloquent;

use App\Models\Notice;
use App\Models\User;
use App\Repositories\NoticeRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Collection;

class NoticeRepository extends BaseRepository implements NoticeRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(Notice $model)
    {
        parent::__construct($model);
    }

    /**
     * get all notices
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->ownedBy(auth()->user()->id)->get();
    }

    /**
     * delete notice
     *
     * @param  string $id
     * @return void
     */
    public function delete($notice): void
    {
        $notice->delete();
    }
}
