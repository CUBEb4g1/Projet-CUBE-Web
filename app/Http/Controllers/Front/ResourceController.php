<?php

namespace App\Http\Controllers\Front;

use App\Models\Resource;
use App\Http\Controllers\Controller;
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
                'relation_id' => '1',
                'category_id' => '1',
                'resource_type_id' => '1',
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

    public function getFullResource(Resource $resource)
    {
        return view('front.account.getfullresource', ['resource' => $resource->with('user')->where('id',$resource->id)->firstOrFail()]);
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
}
