<?php

namespace App\Http\Controllers\Front;

use App\Models\Resource;
use App\Models\ResourceType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class SearchController
 * @package App\Http\Controllers\Front
 * Permet de gérer toutes les recherches côté front
 */
class SearchController extends Controller
{

    /**
     * Initialiser la recherche puis renvoie d'une vue
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     */
    public function index(Request $request)
    {
        $query = Resource::query();
        $this->_addFiltersToQuery($query, $request);
        $resources = $query->paginate(10);

        return view('front.listing', compact('resources', 'query'));
    }

    /**
     * Ajouter des filtre à la query en fonction des inputs user
     *
     * @param Builder $query
     * @param Request $request
     */
    public function _addFiltersToQuery (Builder $query, Request $request)
    {
        $query->with(['user', 'category', 'resourceType', 'relation', 'subscribers', 'favoriters'])
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
    }
}
