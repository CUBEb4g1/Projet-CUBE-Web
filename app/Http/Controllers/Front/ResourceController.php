<?php

namespace App\Http\Controllers\Front;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Relation;
use App\Models\Resource;
use App\Http\Controllers\Controller;
use App\Models\ResourceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        if (!empty($request->input('content'))) {
            $resource = new Resource([
                'title' => $request->input('title'),
                'content' => clean($request->input('content')),
                'user_id' => Auth::User()->id,
                'visibility' => $request->input('vType'),
                'relation_id' => $request->input('relation'),
                'category_id' => $request->input('category'),
                'resource_type_id' => $request->input('type'),
            ]);

            Auth::user()->resources()->save($resource);

            return redirect()->back()->with('warningNotif', "Nouveau post ajouté ! En attente de confirmation par un modérateur.");
        } else {
            return redirect()->back()->with('dangerNotif', "Veuillez remplir votre ressource !");
        }

    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getPreviewvalidatedlist()
    {
        $ressourceList = Resource::with('user')
            ->where('validated', 1)
            ->where('deleted', 0)
            ->paginate('25');

        return view('front.account.list', ['resources' => $ressourceList]);
    }

    /**
     * Display a resource
     *
     * @param Resource $resource
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getFullResource(Resource $resource)
    {
        $resource->with(['user', 'subscribers', 'favoriters'])
            ->where('visibility', 3)
            ->where('id', $resource->id)
            ->where('validated', 1)->firstOrFail();

        $resource->increment('views');

        $commentsFull = $resource->comments()->with(['user', 'replies.user'])->paginate(10);

        return view('front.account.getfullresource', compact('resource', 'commentsFull'));
    }

    /**
     * Change resource Visibility
     *
     * @param Request $resource
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeVisibility(Request $resource)
    {
        $updateResource = Resource::where('id', $resource->id)->update(array('visibility' => $resource->vType));
        if ($updateResource === 1) {
            return redirect()->back()->with('successNotif', "Visibilité de la ressource modifiée !");
        } else {
            return redirect()->back()->with('dangerNotif', "Erreur erreur est survenue !");
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::get();
        $relations = Relation::get();
        $types = ResourceType::get();
        return view("front.account.create", compact('categories', 'relations', 'types'));
    }

    /**
     * Toggle resource favorited for the authenticated user
     *
     * @param Request $request
     * @return array
     */
    public function toggleFavorite(Request $request)
    {
        $user = Auth::user();
        $resource = Resource::findOrFail($request->id);
        $user->toggleFavorite($resource);

        return ['success' => true, 'text' => 'ok'];
    }

    /**
     * Toggle resource subscribed for the authenticated user
     *
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function toggleSubscribe(Request $request)
    {
        $user = Auth::user();
        $resource = Resource::findOrFail($request->id);
        $user->toggleSubscribe($resource);

        return ['success' => true, 'text' => 'ok'];
    }
}
