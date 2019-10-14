<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Livre;
use DB;

class LivresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Livre::get(['id', 'name', 'slug']);

        $lists = [];
        $unity_book = [];

        foreach ($books  as $key => $unity_book) {
            // $unity_book['book'] = $unity_book;
            $lists[] = [
                            'id' => $unity_book->id,
                            'name' => $unity_book->name,
                            'slug' => $unity_book->slug,
                            // 'pages' => $unity_book->pages
                        ];

        }
        
        return $lists;

    }

    public function where () 
    {
        $data = [];


        if (isset( $_GET['search']) && empty($_GET['search'])){
            $books = Livre::get(['id','name']);
        } else
            if (isset( $_GET['search'] ) && $_GET['search'] != null ){
                $books = Livre::where('name','like', '%'.$_GET['search'].'%')->get(['id','name']);
            } 

        $data = 
        [
            'page' => count($books),
            'items' => $books
            
        ];

        return new Response(\json_encode($data, false));
        return $data;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $livres = Livre::orderBy('id', 'desc')->paginate(3, ['id','name','slug','author','description','date_publication'], 'livrepage');
        
        return view('frontOffice.livres.api.index',[
            'livres' => $livres
        ]);
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
         $retoure = [];
 
         $livre = $request->input('livre');
 
         $livre = \App\Models\Livre::create([
             'name'          =>  $livre['name'],
             'author'        =>  $livre['author'],
             'description'   =>  strip_tags($livre['description']),
             'date_publication'   =>  new \Datetime($livre['date_publication']),
         ]);
 
         if ($livre) 
         {
             // Flashy::message("Le livre a été créer avec succé");
             $retoure['notify'] = 1;
             $retoure['type'] = 'success';
             $retoure['message'] = 'Le livre a été créer avec succé';
         } else 
         {
             $retoure['notify'] = 0;
             $retoure['type'] = 'error';
             $retoure['message'] = 'Erreur';
             // Flashy::message("Erreur");
             }
         
         // return new Response(json_encode($livre, false));
         return $retoure;
 
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request = $request->all();
        $id = $request['livre']['id'];
        $livre = $request['livre'];
        unset($livre['id']);


        $livre = \App\Models\Livre::where('id', $id)->update([
            'name'              =>  $livre['name'],
            'author'            =>  $livre['author'],
            'description'       =>   $livre['description'],
            'date_publication'  =>  new \Datetime($livre['date_publication']),
        ]);

        if ($livre) {
                $response = [
                        'message'   => 'Les données sont bien enregistré avec successé',
                        'id'        => $id,
                    ];
        } else 
            {
                $response = [];
            }

        return $response;
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
