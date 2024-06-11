<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Models\Note;
use App\Repositories\NoteRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


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
        // Gate::authorize()
        $this->noteRepository = $noteRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax())
            return $this->getNotes();

        return view('notes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        $this->noteRepository->create([
            'content' => $request['content'],
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('notes.index')->with('status', 'note Added successfully !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        Gate::authorize('view', $note);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        Gate::authorize('update', $note);
        return view('notes.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        Gate::authorize('update', $note);
        $this->noteRepository->update($note, $request->only(['content']));
        return redirect()->route('notes.index')->with('status', 'note Updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        Gate::authorize('delete', $note);
        $this->noteRepository->delete($note);
        return redirect()->route('notes.index')->with('status', 'note Deleted successfully !');
    }

    /**
     * prepare notes list for the datatable view
     *
     * @return void
     */
    public function getNotes()
    {
        $data = $this->noteRepository->all();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('notes.actions', compact('row'));
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at ? with($data->created_at)->format('m/d/Y') : '';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
