<?php

namespace App\Http\Controllers\Back;

use App\Models\Resource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class ManageResourcesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | BACK OFFICE
    |--------------------------------------------------------------------------
    */

    public function listPending(Request $Input)
    {
        $search = $Input::get('query');

        $getResources = Resource::with('user')
            ->whereNull('validated')
            ->where(function($query) use ($search){
                $query->orWhere('deleted', 0)
                    ->Orwhere('title', 'LIKE', "%$search%")
                    ->OrwhereHas('user', function ($query) use ($search){
                        $query->Orwhere('username', 'LIKE', "%$search%");
                    })
                    ->orWhere('created_at', 'LIKE', "%$search");
            })
            ->paginate(25);

        $totalResourcescount = $getResources->total();

        return view('back.resources.list', ['ressourceList' => $getResources, 'totalCount' => $totalResourcescount, 'search' => $search]);
    }

    public function listAll(Request $Input)
    {
        $search = $Input::get('query');

        $getResources = Resource::with('user')
            ->withoutGlobalScope('no_deleted')
            ->where(function($query) use ($search){
                $query->orWhere('deleted', 0)
                    ->Orwhere('title', 'LIKE', "%$search%")
                    ->OrwhereHas('user', function ($query) use ($search){
                        $query->Orwhere('username', 'LIKE', "%$search%");
                    })
                    ->orWhere('created_at', 'LIKE', "%$search");
            })
            ->paginate(25);


        $totalResourcescount = $getResources->total();


        return view('back.resources.list', ['ressourceList' => $getResources, 'totalCount' => $totalResourcescount, 'search' => $search]);
    }

    public function listValidated(Request $Input)
    {
        $search = $Input::get('query');

        $getResources = Resource::with('user')
            ->where('validated', 1)
            ->where(function($query) use ($search){
                $query->orWhere('deleted', 0)
                    ->Orwhere('title', 'LIKE', "%$search%")
                    ->OrwhereHas('user', function ($query) use ($search){
                        $query->Orwhere('username', 'LIKE', "%$search%");
                    })
                    ->orWhere('created_at', 'LIKE', "%$search");
            })
            ->paginate(25);

        $totalResourcescount = $getResources->total();

        return view('back.resources.list', ['ressourceList' => $getResources, 'totalCount' => $totalResourcescount, 'search' => $search]);
    }

    public function listRejected(Request $Input)
    {
        $search = $Input::get('query');

        $getResources = Resource::with('user')
            ->where('validated', 0)
            ->where(function($query) use ($search){
                $query->orWhere('deleted', 0)
                    ->Orwhere('title', 'LIKE', "%$search%")
                    ->OrwhereHas('user', function ($query) use ($search){
                        $query->Orwhere('username', 'LIKE', "%$search%");
                    })
                    ->orWhere('created_at', 'LIKE', "%$search");
            })
            ->paginate(25);

        $totalResourcescount = $getResources->total();

        return view('back.resources.list', ['ressourceList' => $getResources, 'totalCount' => $totalResourcescount, 'search' => $search]);
    }

    public function listDeleted(Request $Input)
    {
        $search = $Input::get('query');

        $getResources = Resource::with('user')
            ->withoutGlobalScope('no_deleted')
            ->where('deleted', '=',1)
            ->where(function($query) use ($search){
                $query->orWhere('deleted', 0)
                    ->Orwhere('title', 'LIKE', "%$search%")
                    ->OrwhereHas('user', function ($query) use ($search){
                        $query->Orwhere('username', 'LIKE', "%$search%");
                    })
                    ->orWhere('created_at', 'LIKE', "%$search");
            })
            ->paginate(25);

        $totalResourcescount = $getResources->total();

        return view('back.resources.list', ['ressourceList' => $getResources, 'totalCount' => $totalResourcescount, 'search' => $search]);
    }

    public function form($resource)
    {
        return view('back.resources.form', [
            'resource' => Resource::withoutGlobalScope('no_deleted')->where('id', $resource)->firstOrFail(),
        ]);
    }

    public function validateResource(Resource $resource)
    {
        $resource->validated = 1;
        $resource->save();

        return redirect()->route('back.resources.list')->with('successNotif', "Ressource approuvée !");
    }

    public function refuseResource(Resource $resource)
    {
        $resource->validated = 0;
        $resource->save();

        return redirect()->route('back.resources.list')->with('WarningNotif', "Ressource refusée !");
    }

    public function restoreResource($resource)
    {
        $update = Resource::withoutGlobalScope('no_deleted')->where('deleted', 1)->orWhere('validated', 0)->find($resource);
        $update->validated = 1;
        $update->deleted = 0;
        $update->save();

        return redirect()->route('back.resources.list')->with('successNotif', "Ressource restaurer !");
    }

    public function delete(Resource $resource)
    {
        $resource->deleted = 1;
        $resource->save();

        return redirect()->route('back.resources.list')
            ->with('warningNotif', "Ressource supprimée avec succès !");
    }
}
