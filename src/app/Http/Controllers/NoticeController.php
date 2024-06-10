<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;
use App\Repositories\NoticeRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use App\Models\Notice;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class NoticeController extends Controller
{
    /**
     * noticeRepository
     *
     * @var NoticeRepositoryInterface
     */
    private $noticeRepository;

    public function __construct(NoticeRepositoryInterface $noticeRepository)
    {
        // Gate::authorize()
        $this->noticeRepository = $noticeRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax())
            return $this->getNotices();

        return view('notices.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notices.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoticeRequest $request)
    {
        $this->noticeRepository->create([
            'content' => $request['content'],
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('notices.index')->with('status', 'Notice Added successfully !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Notice $notice)
    {
        Gate::authorize('view', $notice);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notice $notice)
    {
        Gate::authorize('update', $notice);
        return view('notices.edit', compact('notice'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoticeRequest $request, Notice $notice)
    {
        Gate::authorize('update', $notice);
        $this->noticeRepository->update($notice, $request->only(['content']));
        return redirect()->route('notices.index')->with('status', 'Notice Updated successfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notice $notice)
    {
        Gate::authorize('delete', $notice);
        $this->noticeRepository->delete($notice);
        return redirect()->route('notices.index')->with('status', 'Notice Deleted successfully !');
    }

    /**
     * prepare notices list for the datatable view
     *
     * @return void
     */
    public function getNotices()
    {
        $data = $this->noticeRepository->all();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('notices.actions', compact('row'));
            })
            ->editColumn('created_at', function ($data) {
                return $data->created_at ? with($data->created_at)->format('m/d/Y') : '';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
