<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

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
}
