<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Resource;
use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;
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

        $coms = Comment::where('user_id','=',Auth::user()->id)->count();
        $subs = $user->subscriptions(Resource::class)->count();
        $favs = $user->getFavoriteItems(Resource::class)->count();
        $res = Resource::where('user_id','=',Auth::user()->id)->count();
        $sum = $coms+$subs+$favs+$res;

        if ($sum>0) {
            $percoms = round((100*$coms)/$sum,0);
            $persubs = round((100*$subs)/$sum,0);
            $perfavs = round((100*$favs)/$sum,0);
            $perres = round((100*$res)/$sum,0);
        } else {
            $percoms = 0;
            $persubs = 0;
            $perfavs = 0;
            $perres = 0;
        }

        $userchart = (new LarapexChart)
            ->setDataset([
                $percoms,
                $persubs,
                $perfavs,
                $perres,
            ])
            ->setLabels([
                'Commentaires publiés',
                'Ressources mises de côté',
                'Ressources favorites',
                'Ressources publiées'
            ]);

        return view('front._partials.profile.welcome', [
            'user'=>$user,
            'percoms'=>$percoms,
            'persubs'=>$persubs,
            'perfavs'=>$perfavs,
            'perres'=>$perres,
            'userchart'=>$userchart
        ]);
    }

    public function resources ()
    {
        $user = Auth::user();
//        $resources = $user->resources();
        $resources = Resource::get();

        $coms = Comment::where('user_id','=',Auth::user()->id)->count();
        $subs = $user->subscriptions(Resource::class)->count();
        $favs = $user->getFavoriteItems(Resource::class)->count();
        $res = Resource::where('user_id','=',Auth::user()->id)->count();
        $sum = $coms+$subs+$favs+$res;

        if ($sum>0) {
            $percoms = round((100*$coms)/$sum,0);
            $persubs = round((100*$subs)/$sum,0);
            $perfavs = round((100*$favs)/$sum,0);
            $perres = round((100*$res)/$sum,0);
        } else {
            $percoms = 0;
            $persubs = 0;
            $perfavs = 0;
            $perres = 0;
        }

        $userchart = (new LarapexChart)
            ->setDataset([
                $percoms,
                $persubs,
                $perfavs,
                $perres,
            ])
            ->setLabels([
                'Commentaires publiés',
                'Ressources mises de côté',
                'Ressources favorites',
                'Ressources publiées'
            ]);

        return view('front._partials.profile.resources', [
            'user'=>$user,
            'resources'=>$resources,
            'percoms'=>$percoms,
            'persubs'=>$persubs,
            'perfavs'=>$perfavs,
            'perres'=>$perres,
            'userchart'=>$userchart
        ]);
    }

    public function favorites()
    {
        $user = Auth::user();
        $favorites = $user->getFavoriteItems(Resource::class)->get();

        $coms = Comment::where('user_id','=',Auth::user()->id)->count();
        $subs = $user->subscriptions(Resource::class)->count();
        $favs = $user->getFavoriteItems(Resource::class)->count();
        $res = Resource::where('user_id','=',Auth::user()->id)->count();
        $sum = $coms+$subs+$favs+$res;

        if ($sum>0) {
            $percoms = round((100*$coms)/$sum,0);
            $persubs = round((100*$subs)/$sum,0);
            $perfavs = round((100*$favs)/$sum,0);
            $perres = round((100*$res)/$sum,0);
        } else {
            $percoms = 0;
            $persubs = 0;
            $perfavs = 0;
            $perres = 0;
        }

        $userchart = (new LarapexChart)
            ->setDataset([
                $percoms,
                $persubs,
                $perfavs,
                $perres,
            ])
            ->setLabels([
                'Commentaires publiés',
                'Ressources mises de côté',
                'Ressources favorites',
                'Ressources publiées'
            ]);

        return view('front._partials.profile.favorites', [
            'user'=>$user,
            'favorites'=>$favorites,
            'percoms'=>$percoms,
            'persubs'=>$persubs,
            'perfavs'=>$perfavs,
            'perres'=>$perres,
            'userchart'=>$userchart
        ]);
    }

    public function subscribes()
    {
        $user = Auth::user();
        $subscriptions = $user->subscriptions(Resource::class)->get();

        $coms = Comment::where('user_id','=',Auth::user()->id)->count();
        $subs = $user->subscriptions(Resource::class)->count();
        $favs = $user->getFavoriteItems(Resource::class)->count();
        $res = Resource::where('user_id','=',Auth::user()->id)->count();
        $sum = $coms+$subs+$favs+$res;

        if ($sum>0) {
            $percoms = round((100*$coms)/$sum,0);
            $persubs = round((100*$subs)/$sum,0);
            $perfavs = round((100*$favs)/$sum,0);
            $perres = round((100*$res)/$sum,0);
        } else {
            $percoms = 0;
            $persubs = 0;
            $perfavs = 0;
            $perres = 0;
        }

        $userchart = (new LarapexChart)
            ->setDataset([
                $percoms,
                $persubs,
                $perfavs,
                $perres,
            ])
            ->setLabels([
                'Commentaires publiés',
                'Ressources mises de côté',
                'Ressources favorites',
                'Ressources publiées'
            ]);

        return view('front._partials.profile.subscribes', [
            'user'=>$user,
            'subscriptions'=>$subscriptions,
            'percoms'=>$percoms,
            'persubs'=>$persubs,
            'perfavs'=>$perfavs,
            'perres'=>$perres,
            'userchart'=>$userchart
        ]);
    }
}
