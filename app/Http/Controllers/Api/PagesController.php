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

        return \App\Helpers\FinderPage::like(Page::class);
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
        
        // Ceci est utile pour faire les tests de validation
        $pages = $request->input('page');
        if(isset($pages['content'])) {
            $content = (isset($pages['content'][0])) ? $pages['content'][0] : "";
        } else {
            $content = "";
        }
        
        $data_page = [
            'title'         => $request->input('title'),
            'content'       => $content,
            'book_id'       => $request->input('book_id', 1),
        ];


        $errors = [];
        $validated = [];
 
        $validations_fields = new \App\Helpers\ValidationFields();
        
        $validate = $validations_fields->handle($data_page,  [
            'title'     => [
                'required'  =>['message' => sprintf('erreur, le %s ne doit pas être vide !', 'titre')],
                'min:4'     =>['message' => sprintf("erreur, le %s ne doit pas être inférieur à %d", 'titre', 4)]
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
 
        }else{
                $message_list = array_merge($message_list, ['message'=>'validated']);
            }

        $list_new_page = [];


        if (count($errors) == 0) { // si l'erreur est égale à zéro
 
            if ($request->get('chapiter') != null) {
                $chapiter = \App\Models\Chapiter::where('name', $request->get('chapiter'))->first();
                if ($chapiter == null) {
                    $chapiter = \App\Models\Chapiter::create([
                        'name'    => $request->get('chapiter'),
                        'book_id' => $data_page['book_id']
                    ]);
                    $chapiter_id = $chapiter->id;
                } else {
                    $chapiter_id = $chapiter->id;
                }
            }

            // Création de la page après les différentes actions éffectué.
              

            for($i=0; $i<count($pages['code']); $i++) {
     
                $list_new_page[] =\App\Models\Page::create([
                        'title'     => $data_page['title'],
                        "content"   => $pages['content'][$i],
                        "code"      => htmlentities($pages['code'][$i], ENT_NOQUOTES,"UTF-8"),
                        'book_id'   => $data_page['book_id'],
                        'chapiter_id'   => $chapiter_id
                    ]);
            }
        }
             
        return new Response(json_encode(array_merge($message_list, ["new_pages" => $list_new_page]), false));
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

       $page =  Page::where("id","=", $id)->first();

       if ($page) {

           \App\Models\Story::create([
                "index_object" => $page->id,
                "table_name"   => Page::class,
                "action_type"  => "show"
           ]);
       }

        array_walk_recursive($page, function(&$item, $index) {
            $item = strtr($item, array(
                "<?php" => "[php]",
                "?>"    => "[/php]",
                "{"     => "<br/>[acolade]<br/>",
                "}"     => "<br/>[/acolade]<br/>",
                "<"     => "&lt;",
                ">"     => "&gt;",
                "//"    => "<br/>//",
                "\n"    => "<br/>"
            ));           
        });

       return $page;
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
