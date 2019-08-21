<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Helpers\Str;
use DB;
class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // header ( 'content-type:text/html; charset=utf-8') ;

        $elements = [];
        
        if (isset($_GET['argument']))
        {
            $elements ['count'] = 0;
            $search = $_GET['argument'];
            // Recherche à partir du titre
            
            $elements ['count'] = Page::where('title', 'like', "%".$search."%")->count('id');
            
            if ($elements ['count']>0)
            {
                $page_title = Page::where('title', 'like', "%".$search."%")->limit(10)->pluck('title');
                // print_r($page_title);exit;
                foreach ($page_title as $k => &$title) {
                    $elements ['list'][] = Str::replaceToStrong($search, $title);
                }
            }
            // Cherche et retourne le compte des éléments trouvé
            $count_content = Page::where('content', 'like', "%".$search."%")->count('id');
            $elements ['count'] += $count_content;

            if ($count_content > 0) {
                // recherche à partir du contenu de la page
                $page_content = Page::where('content', 'like', "%".$search."%")->limit(10)->pluck('content');

                foreach ($page_content as $k => &$content) {
                    // Limité l'affichage de caractère à 150 sur le champ content
                    $content = htmlentities( $content, ENT_QUOTES, 'UTF-8') ;
                    $content = Str::replaceToStrong($search, $content);
                    // $strlen = strlen($content);
                    $court_text = substr( $content,0, 150);
                    $court_text = strlen($content) > 150 ? $court_text.' [...]' : $court_text ;
                    $elements ['list'][]  = $court_text;
                }
            }
        }

        return $elements;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {
         $chapiter_id = $request->input('chapiter_id') ;
 
         $data_page = [
             'title'         => $request->input('title'),
             'content'       => $request->input('content'),
             'book_id'       => $request->input('book_id', 1),
         ];
 
         
         $errors = [];
         $validated = [];
 
         $validations_fields = new \App\Helpers\ValidationFields();
        
         $validate = $validations_fields->handle($data_page,  [
             'title'     => [
                 'required'  =>['message' => sprintf('erreur, le %s ne doit pas être vide !', 'titre')],
                 'min:4'    =>['message' => sprintf("erreur, le %s ne doit pas être inférieur à %d", 'titre', 4)]
                 ],
             'content'   => ['required', 'message' => sprintf("erreur, le %s ne doit pas être vide !", 'contenue')],
             'book_id'   => ['required', 'message' => sprintf("erreur, le %s ne doit pas être vide !", 'book_id')],
         ]);
 
         $errors = $validate['errors'];
 
         $message_list = [
             "nbValidated"       => count($validated),
             'list_validated'    => $validated, 
             "nbError"           => count($errors),
             'list_errors'       => $errors,
         ];
 
         if (count($errors) > 0)
         {
             $message_list = array_merge($message_list, ['message'=>'error']);
 
         } else {
             $message_list = array_merge($message_list, ['message'=>'validated']);
         }
 
         if (count($errors) == 0) { // si l'erreur est égale à zéro
 
             if ($request->get('chapiter') != null)
             {
                 $chapiter = \App\Models\Chapiter::create([
                    'name' => $request->get('chapiter'),
                    'book_id' => $data_page['book_id']
                ]);
                 $chapiter_id = $chapiter->id;
             }
 
             $data_page = array_merge($data_page, ['chapiter_id'   => $chapiter_id,]);
 
             // Création de la page après les différentes actions éffectué.
             $page = \App\Models\Page::create($data_page);
         }
             
         return new Response(json_encode($message_list, false));
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
