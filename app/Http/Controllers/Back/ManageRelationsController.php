<?php

namespace App\Http\Controllers\Back;

use App\Models\Relation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ManageRelationsController extends Controller

{

    /**
        * Display a listing of the resource.
        *
        * @return Response
        */
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

    public function form(Relation $relation)
    {
        dd($resource);
        return view('back.relation.form',['relations'=>$relations]);
    }

    /**
        * Show the form for creating a new resource.
        *
        * @return Response
        */
    public function create(Relation $relation)
    {
        //
    }

    /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return Response
        */
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



