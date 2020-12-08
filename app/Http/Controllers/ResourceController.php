<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | FRONT OFFICE
    |--------------------------------------------------------------------------
    */

    public function addRessource(Request $addRequest)
    {
        $resource = new Resource;

        $resource->title = $addRequest->title;
        $resource->content = $addRequest->content;
        $resource->user_id = Auth::User()->id;
        $resource->visibility = $addRequest->visibility;
        $resource->validated = 0;
        $resource->deleted = 0;
        $resource->views = 0;

        $resource->save();

        return redirect()->back()->with('successNotif', "Ressource ajoutée avec succès !");
    }

    public function getValidatedlist()
    {
        $ressourceList = Resource::with('user', 'comments')
            ->where('validated', 1)
            ->where('deleted', 0)
            ->paginate('25');

        dd($ressourceList);

        return view('front.resource', ['resources' => $ressourceList]);
    }

    public function changeVisibility(Request $request) {
        return redirect()->back()->with('successNotif', "Visibilité de la ressource modifiée !");
    }

    /*
    |--------------------------------------------------------------------------
    | BACK OFFICE
    |--------------------------------------------------------------------------
    */

    public function getPendingValidationResources() {
        $getResources = Resource::with('user')->where('validated', 0)
            ->where('deleted', 0)
            ->paginate(25);

        $totalResourcescount = $getResources->total();

        dd($totalResourcescount, $getResources);

        return view('back.getPendingResources', ['ressourceList' => $getResources, 'totalCount' => $totalResourcescount]);
    }

    public function validateResource(Resource $resource)
    {
        $resource->validated = 1;
        $resource->save();

        return redirect()->back()->with('successNotif', "Ressource approuvée !");
    }

    public function refuseResource(Resource $resource)
    {
        $resource->validated = 0;
        $resource->save();

        return redirect()->back()->with('WarningNotif', "Ressource refusée !");
    }

    public function deleteResource(Resource $resource)
    {
        $resource->deleted = 1;
        $resource->save();

        return redirect()->back()->with('WarningNotif', "Ressource supprimée !");
    }

}
