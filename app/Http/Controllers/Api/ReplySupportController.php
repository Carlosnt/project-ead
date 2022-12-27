<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReplySupportRequest;
use App\Http\Requests\SupportRequest;
use App\Http\Resources\ReplySupportResource;
use App\Http\Resources\SupportResource;
use App\Models\ReplySupport;
use App\Models\Support;
use App\Repositories\SupportRepository;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    protected $repository;

    public function __construct(SupportRepository $supportRepository)
    {
        $this->repository = $supportRepository;
    }

    public function index(Request $request){

        return SupportResource::collection($this->repository->getSupports($request->all()));
    }

    public function show($id){
        return new CourseResource($this->repository->getCourse($id));
    }

    public function createReply(ReplySupportRequest $request, $supportId)
    {
        $reply = $this->repository->createReplyToSupportId($supportId, $request->validated());

        return new ReplySupportResource($reply);
    }

    public function store(SupportRequest $request)
    {
        $support = $this->repository->createNewSupport($request->validated());

        return new SupportResource($support);
    }
}
