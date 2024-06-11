<?php

namespace App\Repositories\Eloquent;

use App\Models\Note;
use App\Models\User;
use App\Repositories\NoteRepositoryInterface;
use Illuminate\Support\Collection;

class NoteRepository extends BaseRepository implements NoteRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(Note $model)
    {
        parent::__construct($model);
    }

    /**
     * get all notes
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->ownedBy(auth()->user()->id)->get();
    }

    /**
     * delete note
     *
     * @param  string $id
     * @return void
     */
    public function delete($note): void
    {
        $note->delete();
    }
}
