<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;
use App\Http\Resources\NoticeCollection;
use App\Http\Resources\NoticeResource;
use App\Repositories\NoticeRepositoryInterface;
use Illuminate\Support\Facades\Gate;
use App\Models\Notice;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $this->noticeRepository = $noticeRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return NoticeResource::collection($this->noticeRepository->all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoticeRequest $request)
    {
        $notice = $this->noticeRepository->create([
            'content' => $request['content'],
            'user_id' => auth()->user()->id
        ]);

        return (new NoticeResource($notice))
            ->setStatusCode(Response::HTTP_CREATED)->response();
    }

    /**
     * Display the specified resource.
     */
    public function show(Notice $notice)
    {
        Gate::authorize('view', $notice);

        return (new NoticeResource($notice))
            ->setStatusCode(Response::HTTP_OK)->response();
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoticeRequest $request, Notice $notice)
    {
        Gate::authorize('update', $notice);
        $this->noticeRepository->update($notice, $request->only(['content']));

        return (new NoticeResource($notice))
            ->setStatusCode(Response::HTTP_OK)->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notice $notice)
    {
        Gate::authorize('delete', $notice);
        $this->noticeRepository->delete($notice);

        return response()->json([
            'success' => 'true', 'status_code' => Response::HTTP_OK,
            'data' => ['message' => 'Successfully Deleted ']
        ])->setStatusCode(Response::HTTP_OK);
    }
}
