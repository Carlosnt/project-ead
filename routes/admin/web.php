<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ModuleController;
use App\Http\Controllers\Admin\SupportController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::group(['as' => 'admin.','prefix'=> 'admin'], function(){   
    Route::middleware('auth')->group(function () { 
        Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::post('/users/{id}/update-image', [UserController::class, 'uploadFile'])->name('users.update.image');
        Route::resource('/users', UserController::class);

        Route::post('/admins/{id}/update-image', [AdminController::class, 'uploadFile'])->name('admins.update.image');
        Route::resource('/admins', AdminController::class);

        Route::resource('/categories', CategoryController::class)->except(['shpw','edit','create']);

        Route::post('/courses/{id}/update-image', [CourseController::class, 'uploadFile'])->name('courses.update.image');
        Route::resource('/courses', CourseController::class);

        Route::resource('/modules', ModuleController::class);
        Route::resource('/supports', SupportController::class);

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
        
    });
});

