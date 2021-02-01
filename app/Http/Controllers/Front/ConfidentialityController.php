<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfidentialityController extends Controller
{
    /**
     * Afficher les termes et conditions de service et de confidentialite
     */
    public function confidentiality()
    {
        return view('front._layouts.confidentiality');
    }
}
