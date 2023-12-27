<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\StatiticsRepository;
use App\Services\UserService;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __construct(
        protected StatiticsRepository $repository
    ){}

    public function dashboard()
    {
        $users =$this->repository->getTotalUsers();
        $admins =$this->repository->getTotalAdmins();
        $courses =$this->repository->getTotalCourses();
        $supports =$this->repository->getTotalSupports();
        return Inertia::render('Dashboard',[
            'users' => $users,
            'admins' => $admins,
            'courses' => $courses,
            'supports' => $supports,
        ]);
    }
}
