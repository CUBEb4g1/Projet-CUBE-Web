<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | FRONT OFFICE
    |--------------------------------------------------------------------------
    */

    public function getValidatedlist()
    {
        $ressourceList = Resource::where('validated', 1)
            ->where('deleted', 0)
            ->paginate('25');

        return view('front.resource', ['resources' => $ressourceList]);
    }

    /*
    |--------------------------------------------------------------------------
    | BACK OFFICE
    |--------------------------------------------------------------------------
    */

    public function getPendingValidationResources() {
        $getResources = Resource::with('user')->where('validated', null)
            ->where('deleted', 0)
            ->paginate(25);

        $totalResourcescount = $getResources->total();

        return view('back.getPendingResources', ['ressourceList' => $getResources, 'totalCount' => $totalResourcescount]);
    }

    public function validateResource(Resource $resource)
    {
        $vResource= Resource::where('id', $resource->id)->first();
        $vResource->validated = 1;
        $vResource->save();

        return redirect()->back()->with('successNotif', "Ressource approuvée !");
    }

    public function refuseResource(Resource $resource)
    {
        $rResource= Resource::where('id', $resource->id)->first();
        $rResource->validated = 0;
        $rResource->save();

        return redirect()->back()->with('WarningNotif', "Ressource refusée !");
    }

    public function deleteResource(Resource $resource)
    {
        $dResource= Resource::where('id', $resource->id)->first();
        $dResource->deleted = 1;
        $dResource->save();

        return redirect()->back()->with('WarningNotif', "Ressource supprimée !");
    }

}
