<?php
namespace App\Helpers;

class Slug {

    /**
     * Création d'un moteur de création de slug
     * @param $slug
     * @param $object
     */
    public static function create($slug, $object) 
    {   
        static $increment = 1;

        $slug = str_slug($slug);
        if ($object::whereSlug($slug)->first()) {

            $str_count = strlen($slug);
            $char = substr($slug, $str_count-1, $str_count);

            if (preg_match('#^[0-9]+#', $char)) {
                $increment = intval($char) + 1;
            }
            
            $char = substr($slug, 0, $str_count-1);
            $slug = self::create($char.'-'.$increment, $object);
        }
        return $slug ;
    }
}

?>