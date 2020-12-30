<?php

namespace App\Http\Controllers\Back;

use App\Models\Resource;
use App\Http\Controllers\Controller;

class ManageResourcesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | BACK OFFICE
    |--------------------------------------------------------------------------
    */

    public function getPendingValidationResources()
    {
        $getResources = Resource::with('user')->where('validated', 0)
            ->where('deleted', 0)
            ->paginate(25);

        $totalResourcescount = $getResources->total();

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
