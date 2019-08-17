<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
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
                    $elements ['list'][]  = Str::replaceToStrong($search, $content);
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
