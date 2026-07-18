<?php

use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'frontend.'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::get('contact', [HomeController::class, 'contact'])->name('contact');
    Route::get('blog', [HomeController::class, 'blog'])->name('blog');
    Route::get('blog-details', [HomeController::class, 'blogDetails'])->name('blog.details');
    Route::get('project', [HomeController::class, 'project'])->name('project');
    Route::get('project-details', [HomeController::class, 'projectDetails'])->name('project.details');
});

Auth::routes(['login' => false, 'register' => false]);

