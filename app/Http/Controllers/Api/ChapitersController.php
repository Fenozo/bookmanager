<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use App\Models\Chapiter;

class ChapitersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = [];
        
        if (isset( $_GET['search']) && $_GET['search'] != null ){
           
            $name = $_GET['search'];
            $chapiters = Chapiter::where('name','like', '%'.$name.'%')->get(['id', 'name']);
        } else if (isset( $_GET['book_id']) && $_GET['book_id'] != null ){
            $book_id = $_GET['book_id'];
            $chapiters = Chapiter::where('book_id','like', '%'.$book_id.'%')->get(['id', 'name']);
        }else {
            $chapiters = Chapiter::all();
        }
       
        $data = 
        [
            'page' => count($chapiters),
            'items' => $chapiters
            
        ];

        return new Response(\json_encode($data, false));
        return $data;
    }

    /**
    *
    * @param Request $request
    *
    */
    public function show_with_book($book_id) {  

    
        if ($book_id) {
            $books = Chapiter::where("book_id", $book_id)->limit(7)->get();
            return [
                        "count" => count($books)
                        ,"items" => $books
                    ];
        }else{
                return new Response(json_encode(["items" =>array()]));
            }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id) {
            return ["item" => Chapiter::where("id", $id)->limit(7)->first()];
        }else{
                return new Response(json_encode(["item" =>array()]));
            }
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
