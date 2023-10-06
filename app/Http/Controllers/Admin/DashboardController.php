<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    

    public function dashboard()
    {
        return Inertia::render('Dashboard',[
            
        ]);
    }
}
