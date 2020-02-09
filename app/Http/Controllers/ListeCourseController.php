<?php

namespace App\Http\Controllers;

use App\LC_List;
use App\LC_Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListeCourseController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
    }



    /**
     * Retourne la vue listant toutes les listes de courses publiques.
     *
     * @return void
     */
    public function showHome()
    {
        return view('listeCourse.showHome');
    }



    /**
     * Retourne la vue listant les articles d'une liste
     *
     * @return void
     */
    public function showList()
    {
        return view('listeCourse.showList');
    }



    /**
     * Retourne les listes de course publiques
     *
     * @return void
     */
    public function getPublicLists()
    {
        return json_encode(LC_List::where('is_private', 0)->get());
    }



    /**
     * Retourne les listes de course privées
     *
     * @return void
     */
    public function getPrivateLists()
    {
        return json_encode(LC_List::where([['is_private', 1], ['user_id', Auth::id()]])->get());
    }



    /**
     * Retourne la liste avec l'ID passée en parametre
     *
     * @param LC_List $LC_List
     * @return void
     */
    public function getList(LC_List $LC_List)
    {
        return json_encode(['list' => $LC_List, 'articles' => $LC_List->articles()->orderBy('is_buyed')->orderBy('updated_at')->get()]);
    }



    /**
     * Retourne les listes de l'utilisateur connecté
     *
     * @return void
     */
    public function getUserLists()
    {
        return json_encode(LC_List::where('user_id', Auth::id())->get());
    }



    /**
     * Effectue le traitement de la création d'une liste
     *
     * @param Request $request
     * @return void
     */
    public function createList(Request $request)
    {
        $u = Auth::user();
        $d = $request->validate(['name' => 'required']);
        return json_encode($u->listes()->create($d));
    }



    /**
     * Effectue le traitement de la suppression une liste et toutes ses relations
     *
     * @param LC_List $LC_List
     * @return void
     */
    public function deleteList(LC_List $LC_List)
    {
        return [[$LC_List->articles()->delete()], [$LC_List->delete()]];
    }



    /**
     * Effectue le traitement de la modification la visibilitée d'une liste
     *
     * @param LC_List $LC_List
     * @return void
     */
    public function toggleListPrivacy(LC_List $LC_List)
    {
        $LC_List->is_private = !$LC_List->is_private;
        return json_encode($LC_List->save());
    }



    /** 
     * Effectue le traitement de la création d'un article
     */
    public function createArticle(Request $request, LC_List $LC_List)
    {
        $d = $request->validate(['name' => 'required']);

        return json_encode($LC_List->articles()->create($d));
    }



    /**
     * Effectue le traitement de la suppression d'un article
     *
     * @param LC_Article $LC_Article
     * @return void
     */
    public function deleteArticle(LC_Article $LC_Article)
    {
        return json_encode($LC_Article->delete());
    }



    /**
     * Effectue le traitement de la modification de l'état d'achat d'un article
     *
     * @param LC_Article $LC_Article
     * @return void
     */
    public function toggleArticleState(LC_Article $LC_Article)
    {
        $LC_Article->is_buyed = !$LC_Article->is_buyed;
        return json_encode($LC_Article->save());
    }
}
