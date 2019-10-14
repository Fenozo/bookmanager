<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Flashy;
class LivresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        // dd('Hello word');
        $livres = DB::table('livres')
                ->paginate(5)
                ;

        return view('frontOffice.livres.index', compact('livres'));
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
            'description'   =>  $livre['description'],
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
