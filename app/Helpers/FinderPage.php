<?php
namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Page;
use App\Helpers\Str;

class FinderPage
{


	public static function like($table) {

		$elements = [];
        $elements ['list'] = [];
        
        if (isset($_GET['argument']))
        {
            $elements ['count'] = 0;
            $search = $_GET['argument'];
            // Recherche à partir du titre
            
            $elements ['count'] = $table::where('title', 'like', "%".$search."%")->count('id');
            
            if ($elements ['count']>0)
            {
                $page_title = $table::where('title', 'like', "%".$search."%")->limit(10)->get(['id','title','content']);
                
                foreach ($page_title as $k => $data) 
                {
                    if (! isset($elements ['list'][$data->id]))
                    {
                        $title = Str::replaceToStrong($search, $data->title);
                        $elements ['list'][] = [
                            'id'        => $data->id
                            ,'text'      => Str::decode_str($title)
                            ,'title'     => Str::decode_str($data->title)
                            ,'content'   => Str::decode_str($data->content)
                        ];
                    }
                    // $elements ['id'][$data->id] = $data->id; 
                }
            }
            // Cherche et retourne le compte des éléments trouvé
            $count_content = $table::where('content', 'like', "%".$search."%")->count('id');
            $elements ['count'] += $count_content;

            if ($count_content > 0) 
            {
                // recherche à partir du contenu de la page
                $page_content = $table::where('content', 'like', "%".$search."%")->limit(10)->get(['id','title','content']);

                foreach ($page_content as $k => $data) 
                {
                    // Limité l'affichage de caractère à 150 sur le champ content
                    $content = $data->content;
                    
                    $content_htmlentities = htmlentities( $content, ENT_QUOTES, 'UTF-8') ;
                    $content = Str::replaceToStrong($search, $content_htmlentities);
                    $count_search = strlen($search);

                    $strpos = !empty($search)? strpos($data->content, $search) : 0;
 
                    $court_text = substr( $content, ( $strpos >8 ? $strpos - 9 : 0), ($strpos>8 ? $strpos+150 : 151) );

                    if($strpos > 9 &&  strlen($court_text) < 150) {
                        $content = substr($content, ( $strpos>8 ? $strpos - 9 : 0));
                    }
                    
                    $court_text = strlen($court_text) > 150 ? $court_text.' [...]' : $content ;

                    // $court_text = $content;
                    
                    if (! isset($elements ['list'][$data->id]))
                    {

                        $elements ['list'][]  
                                    = [
                                        'id'         => $data->id
                                        ,'text'      => Str::decode_str($court_text)
                                        ,'title'     => Str::decode_str($data->title)
                                        ,'content'   => $content
                            ];
                    }
                    
                }
            }
        }

        

        return new Response(json_encode($elements));
	}

}



?>