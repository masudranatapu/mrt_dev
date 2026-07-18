<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        try {
            return view('frontend.pages.index');

        } catch (\Throwable $e) {
            return redirect()->back()->with([
                'message' => $e->getMessage(),
                'alert-type' => 'error',
            ]);
        }
    }

    public function contact()
    {
        try {
            return view('frontend.pages.contact');

        } catch (\Throwable $e) {
            return redirect()->back()->with([
                'message' => $e->getMessage(),
                'alert-type' => 'error',
            ]);
        }
    }

    public function blog()
    {
        try {
            return view('frontend.blog.index');

        } catch (\Throwable $e) {
            return redirect()->back()->with([
                'message' => $e->getMessage(),
                'alert-type' => 'error',
            ]);
        }
    }
    public function blogDetails()
    {
        try {
            return view('frontend.blog.details');

        } catch (\Throwable $e) {
            return redirect()->back()->with([
                'message' => $e->getMessage(),
                'alert-type' => 'error',
            ]);
        }
    }
    public function project()
    {
        try {
            return view('frontend.projects.index');

        } catch (\Throwable $e) {
            return redirect()->back()->with([
                'message' => $e->getMessage(),
                'alert-type' => 'error',
            ]);
        }
    }
    public function projectDetails()
    {
        try {
            return view('frontend.projects.details');

        } catch (\Throwable $e) {
            return redirect()->back()->with([
                'message' => $e->getMessage(),
                'alert-type' => 'error',
            ]);
        }
    }
}
