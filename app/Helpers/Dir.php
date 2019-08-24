<?php

/**
 * manipulation des dossiers
 */
class Dir
{
	
    /**
     * Création de dossier dynamiquement
     * 
     * 
     * @param $dir ARRAY
     * @param $path
     */
    public static function create_dir($dir = ['/'] ,$path)
    {
        $arr = [];
        $d = "";
        $i = 0;
        while(count($dir) != $i)
        {
            $arr[] = $dir[$i];
            $d = implode(DS,$arr); // assemble le tableau aubtenu 
            $i++;
            if (!is_dir($path.DS.$d))
            {
                mkdir ($path.DS.$d, 0755);
            }
        }
    }
}