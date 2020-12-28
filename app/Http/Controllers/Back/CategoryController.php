<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FRONT OFFICE
    |--------------------------------------------------------------------------
    */
    public function listCategory()
    {
        $categoryList = DB::table('categories')
            ->select('label')
            ->orderBy('label','asc')
            ->paginate('25');

        dd($categoryList);

        return view('front.resource', ['category' => $categoryList]);
    }
    public function addCategory(Request $category)
    {
        $addCategory = new Category(array(
            ['label' => $category->label],
        ));

        if ($category === 1)
        {
            return redirect()->back()->with('successNotif', "Catégorie créée avec succès !");
        }else{
            return redirect()->back()->with('dangerNotif', "Une erreur est survenue !");
        }
    }

    /*
    |--------------------------------------------------------------------------
    | BACK OFFICE
    |--------------------------------------------------------------------------
    */
    public function changeCategory(Request $category)
    {
        $changeCategory = Category::where('id', $category->id)->update(array('label' => $category->vType));
        if ($changeCategory === 1) {
            return redirect()->back()->with('successNotif', "Nom de la catégorie modifié avec succès !");
        } else {
            return redirect()->back()->with('dangerNotif', "Une erreur est survenue !");
        }
    }
    public function deleteCategory(Request $category)
    {
        $category->deleted = 1;
        $category->save();

        return redirect()->back()->with('WarningNotif', "Catégorie supprimée avec succès !");
    }
}
