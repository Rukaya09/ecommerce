<?php

namespace App\Http\Controllers;

class AdminHomeController extends Controller
{
    /**
     * Show the admin home page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home');
    }
}