<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Afficher la page d'a propos
     */
    public function aboutus()
    {
        return view('front._layouts.aboutus');
    }
}
