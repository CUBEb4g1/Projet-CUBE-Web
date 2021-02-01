<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller

{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::with(['comments','favorites','subscriptions'])->findOrFail(Auth::user()->id);
        return view('front._partials.profile.welcome', compact('user'));
    }

    public function resources ()
    {
        $user = Auth::user();
//        $resources = $user->resources();
        $resources = Resource::get();
        return view('front._partials.profile.resources', compact('user', 'resources'));
    }

    public function favorites()
    {
        $user = Auth::user();
        $favorites = $user->getFavoriteItems(Resource::class)->get();

        return view('front._partials.profile.favorites', compact('user', 'favorites'));
    }

    public function subscribes()
    {
        $user = Auth::user();
        $subscriptions = $user->getSubItems(Resource::class)->get();

        return view('front._partials.profile.subscribes', compact('user', 'subscriptions'));
    }
}
