<?php
namespace App\Helpers;


/**
 * manipulation des dossiers
 */
class Dir
{
	
    /**
     * Création de dossier dynamiquement
     * $dir les dossiers a créer; les noms cites dans un tableau
     * 
     * @param $dir ARRAY
     * @param $path __DIR__
     */
    public static function create_dir($dir = ['/'] ,$path = __DIR__)
    {

    	if(!defined('DS')) { define('DS', DIRECTORY_SEPARATOR ); }
    	if (!is_array($dir)) 
    	{
    		$dir = explode('/', $dir);
    	}

        $arr = [];
        $d = "";
        $i = 0;
        while(count($dir) != $i) // si on atteint pas encore la longueur du dossier
        {
            $arr[] = $dir[$i];
            $d = implode(DS,$arr); // assemble le tableau aubtenu 
            $i++;
            if (!is_dir($path.DS.$d)) // si le dossier n'existe pas
            {
                mkdir ($path.DS.$d, 0755); // on cré le dossier
            }
        }
    }
}