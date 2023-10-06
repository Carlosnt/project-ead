<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ViewRequest;
use App\Http\Resources\LessonResource;
use App\Repositories\Eloquent\LessonRepository;

class LessonController extends Controller
{
    protected $repository;

    public function __construct(LessonRepository $lessonRepository)
    {
        $this->repository = $lessonRepository;
    }

    public function index($lessonId){

        return LessonResource::collection($this->repository->getLessonsByModuleId($lessonId));
    }

    public function show($lessonId){
        return new LessonResource($this->repository->getLesson($lessonId));
    }

    public function viewed(ViewRequest $request){
        $this->repository->markLessonViewed($request->lesson);
        return response()->json(['success' => true]);
    }
}
