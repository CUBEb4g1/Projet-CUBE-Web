<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\User;
use http\Env\Response;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ResourceApiController extends Controller
{

    public function show($id)
    {
        $resource = Resource::with(['user',])
            ->where('visibility', 3)
            ->where('id', $id)
            ->where('validated', 1)->firstOrFail();

        $resource->increment('views');

        return response()->json($resource, 200);
    }

    public function topViews()
    {
        $resource = Resource::orderByDesc('views')->limit(10)->get();

        return response()->json($resource, 200);

    }

    public function topLike()
    {
        $resource = Resource::withCount('favoriters')->orderBy('favoriters_count', 'desc')->limit(5)->get();

        return response()->json($resource, 200);
    }

    public function search(Request $request)
    {
        $query = Resource::query();
        $this->_addFiltersToQuery($query, $request);
        $resources = $query->get();
        return response()->json($resources, 200);
    }

    public function _addFiltersToQuery (Builder $query, Request $request)
    {
        $query->with(['user', 'category', 'resourceType'])
            ->where('title', 'LIKE', '%'.$request->title.'%');

        if ($request->filled('relation')) {
            $query
                ->where('relation_id', $request->relation);
        }

        if ($request->filled('category')) {
            $query
                ->where('category_id', $request->category);
        }

        if ($request->filled('type')) {
            $query
                ->where('resource_type_id', $request->type);
        }

        if ($request->filled('limit')) {
            $query
                ->limit($request->limit);
        }
    }

    public function post (Request $request)
    {
        if (!empty($request->input('content'))) {
            $resource = new Resource([
                'title' => $request->input('title'),
                'content' => clean($request->input('content')),
                'user_id' => 2,
                'visibility' => 1,
                'relation_id' => 1,
                'category_id' => 1,
                'resource_type_id' => 1,
            ]);

            $user = User::findOrFail(2)->resources()->save($resource);
            return response()->json([
                'message' => 'Ressource créer !'
            ], 201);
        }
        else
        {
            return response()->json([
                'message' => 'Erreur lors de la création'
            ], 400);
        }
    }
}
