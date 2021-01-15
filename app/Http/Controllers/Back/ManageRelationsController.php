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
        $relations=Relation::paginate(25);
        return view('back.relation.list',['relations'=>$relations]);


    }

    public function form()
    {

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
    public function destroy(Relation $relation)
    {
        // $relation->destroyed = 1;
        // $relation->save();

        // return redirect()->
    }

}



