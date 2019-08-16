<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         // dd('Hello word');
         return view('pages.index');
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
                'min:10'    =>['message' => sprintf("erreur, le %s ne doit pas être inférieur à %d", 'titre', 10)]
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
                $chapiter = \App\Models\Chapiter::create(['name' => $request->get('chapiter')]);
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
