<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Notifications\NotifyNewUserAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | FRONT OFFICE
    |--------------------------------------------------------------------------
    */
    /**
     * Lister
     */
    public function listCategory()
    {
        $categoryList = DB::table('categories')
            ->select('label')
            ->orderBy('label','asc')
            ->paginate('25');

        return view('front.resource', ['category' => $categoryList]);
    }

    /*
    |--------------------------------------------------------------------------
    | BACK OFFICE
    |--------------------------------------------------------------------------
    */
    /**
     * Lister
     */
    public function list()
    {
        return view('back.category.list', [
            'categories' => Category::with('resource')->paginate(25),
        ]);
    }
    /**
     * Afficher le formulaire
     */
    public function form(Category $category = null)
    {
        return view('back.category.form', [
            'category' => $category,
        ]);
    }
    /**
     * Submit du formulaire
     *
     * @param Request $request
     */
    public function save(Request $request, Category $category = null)
    {
        $this->_validator($request, $category);

        if ($category === null) {
            $category = $this->_create($request);
        } else {
            $this->_update($category, $request);
        }

        return redirect()->route('back.category.list')
            ->with('successNotif', __('notifications.common.saved'));
    }
    /**
     * Valider le formulaire
     */
    protected function _validator(Request $request, Category $model = null)
    {
        $rules = [
            'label' => ['required', 'max:150'],
        ];

        if ($model === null) {
            $rules['label'][] = 'unique:categories';
        } else {
            $rules['label'][] = 'unique:categories,label,' . $model->id;
        }

        $this->validate($request, $rules);
    }
    /**
     * Créer
     */
    protected function _create(Request $request)
    {
        $category = Category::create($request->all());
        $category->save();
        return redirect()->route('back.category.list')
            ->with('successNotif', __('notifications.common.saved'));
    }
    /**
     * Modifier
     */
    protected function _update(Category $category, Request $request)
    {
        $category->update(['label' => $request->label]);
        return redirect()->route('back.category.list')
                ->with('successNotif', __('notifications.common.saved'));
    }
    /**
     * Supprimer
     */
    public function delete(Category $category)
    {
        $category->delete();

        return redirect()->route('back.category.list')
            ->with('WarningNotif', "Catégorie supprimée avec succès !");
    }
    /**
     * Désactiver la catégorie
     */
    public function disable(Category $category)
    {
        $category->active = 0;
        $category->save();

        return redirect()->back()
            ->with('infoNotif', 'Catégorie désactivée');
    }
    /**
     * Réactiver la catégorie
     */
    public function enable(Category $category)
    {
        $category->active = 1;
        $category->save();

        return redirect()->back()
            ->with('infoNotif', 'Catégorie réactivée');
    }
}
