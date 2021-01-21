<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Relation;
use App\Models\ResourceType;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::where('active', '=', '1')->get();
        $relations = Relation::where('deleted', '=', '0')->get();
        $types = ResourceType::get();
        return view('front.home', compact('categories', 'relations', 'types'));
    }
}
