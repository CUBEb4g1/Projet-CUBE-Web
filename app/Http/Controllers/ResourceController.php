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

    public function addRessource(Request $resource)
    {
        $newresource = new Resource(array(
            ['title' => $resource->title],
            ['content' => $resource->content],
            ['user_id' => Auth::User()->id],
            ['visibility' => $resource->vType],
            ['validated' => 0],
            ['deleted' => 0],
            ['views' => 0],
        ));

        Auth::user()->resources()->save($newresource);

        if ($resource === 1)
        {
            return redirect()->back()->with('successNotif', "Ressource ajoutée avec succès !");
        }else{
            return redirect()->back()->with('dangerNotif', "Une erreur est survenue !");
        }


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

    public function changeVisibility(Request $resource)
    {
        $updateResource = Resource::where('id', $resource->id)->update(array('visibility' => $resource->vType));
        if ($updateResource === 1) {
            return redirect()->back()->with('successNotif', "Visibilité de la ressource modifiée !");
        } else {
            return redirect()->back()->with('dangerNotif', "Erreur erreur est survenue !");
        }

    }

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
