<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use App\Repositories\NoteRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class NoteController extends Controller
{
    /**
     * noteRepository
     *
     * @var NoteRepositoryInterface
     */
    private $noteRepository;

    public function __construct(NoteRepositoryInterface $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return NoteResource::collection($this->noteRepository->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        $note = $this->noteRepository->create([
            'content' => $request['content'],
            'user_id' => auth()->user()->id
        ]);

        return (new NoteResource($note))
            ->setStatusCode(Response::HTTP_CREATED)->response();
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        Gate::authorize('view', $note);

        return (new NoteResource($note))
            ->setStatusCode(Response::HTTP_OK)->response();
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        Gate::authorize('update', $note);
        $this->noteRepository->update($note, $request->only(['content']));

        return (new NoteResource($note))
            ->setStatusCode(Response::HTTP_OK)->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        Gate::authorize('delete', $note);
        $this->noteRepository->delete($note);

        return response()->json([
            'success' => 'true', 'status_code' => Response::HTTP_OK,
            'data' => ['message' => 'Successfully Deleted ']
        ])->setStatusCode(Response::HTTP_OK);
    }
}
