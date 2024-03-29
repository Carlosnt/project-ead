<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReplySupportRequest;
use App\Http\Resources\ReplySupportResource;
use App\Repositories\Eloquent\ReplySupportRepository;

class ReplySupportController extends Controller
{
    protected $repository;

    public function __construct(ReplySupportRepository $supportRepository)
    {
        $this->repository = $supportRepository;
    }

    public function createReply(ReplySupportRequest $request)
    {
        $reply = $this->repository->createReplyToSupport($request->validated());

        return new ReplySupportResource($reply);
    }

}
