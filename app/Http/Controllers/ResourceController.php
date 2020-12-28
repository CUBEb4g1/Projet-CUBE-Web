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

    public function add(Request $request)
    {
        if (!empty($request->input('content'))) {
            $resource = new Resource([
                'title' => $request->input('title'),
                'content' => clean($request->input('content')),
                'user_id' => Auth::User()->id,
                'visibility' => $request->input('vType'),
                'validated' => 0,
                'deleted' => 0,
                'views' => 0
            ]);

            Auth::user()->resources()->save($resource);

            return redirect()->back()->with('warningNotif', "Nouveau post ajouté ! En attente de confirmation par un modérateur.");
        } else {
            return redirect()->back()->with('dangerNotif', "Veuillez remplir votre ressource !");
        }

    }

    public function getPreviewvalidatedlist()
    {
        $ressourceList = Resource::with('user')
            ->where('validated', 1)
            ->where('deleted', 0)
            ->paginate('25');

        //dd($ressourceList);

        return view('front.account.list', ['resources' => $ressourceList]);
    }

    public function getFullResource(Resource $resource, $id)
    {
        $getResource = $resource->with('user')->where('id', $id)->firstOrFail();
        return view('front.account.getfullresource', ['resource' => $getResource]);
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


    public function create()
    {
        return view("front.account.create");
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
