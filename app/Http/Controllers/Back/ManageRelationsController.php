<?php

namespace App\Http\Controllers\Back;

use App\Models\Relation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class ManageRelationsController extends Controller

{

    public function index()
    {
        $relations=Relation::where('deleted', false)->paginate(25);
        return view('back.relation.list',['relations'=>$relations]);
    }

    public function indexdeleted()
    {
        $relations=Relation::where('deleted', true)->paginate(25);
        return view('back.relation.list',['relations'=>$relations]);
    }

    public function form(Relation $relation=null)
    {
        return view('back.relation.form',['relation'=>$relation]);
    }

        public function save(Request $request, Relation $relation = null)
    {
        $this->_validator($request, $relation);

        if ($relation=== null) {
            $this->_create($request);
        } else {
            $this->_update($relation, $request);
        }

        return redirect()->route('back.relation.list')
            ->with('successNotif', __('notifications.common.saved'));
    }
    /**
     * Valider le formulaire
     */
    protected function _validator(Request $request, Relation $model = null)
    {
        $rules = [
            'label' => ['required', 'max:150'],
        ];

        if ($model === null) {
            $rules['label'][] = 'unique:relations';
        } else {
            $rules['label'][] = 'unique:relations,label,' . $model->id;
        }

        $this->validate($request, $rules);
    }

    protected function _create(Request $request)
    {
        $relation = Relation::create($request->all());
        $relation->save();
        return redirect()->route('back.relation.list')
            ->with('successNotif', __('notifications.common.saved'));
    }
    /**
     * Modifier
     */
    protected function _update(Relation $relation, Request $request)
    {
        $relation->update(['label' => $request->label]);
        return redirect()->route('back.relation.list')
                ->with('successNotif', __('notifications.common.saved'));
    }

    public function delete(Relation $relation)
    {
        $relation->deleted = true;
        $relation->save();
        return redirect()->route('back.relation.list')->with('successNotif', 'Relation supprimée avec succès');
    }

       public function restore(Relation $relation)
    {
        $relation->deleted = false;
        $relation->save();
        return redirect()->route('back.relation.list')->with('successNotif', 'Relation restaurée avec succès');
    }

}



