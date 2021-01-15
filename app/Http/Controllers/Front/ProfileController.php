<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class ProfileController extends Controller

{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('front.profile');
    }
}