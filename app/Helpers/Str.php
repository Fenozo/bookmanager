<?php
namespace App\Helpers;
use Symfony\Polyfill\Mbstring\Mbstring;

class Str 
{

    // $subject = str_replace($search, '[b]'.$search.'[/b]' , $subject );
    // $content = preg_replace('/\[b\]/', '<strong style="font-size:19px;">', $subject);
    // $text = preg_replace('/\[\/b\]/', '</strong>', $content);
   
    public static function replaceToStrong($search, $subject)
    {
        if (!defined("HELPERS"))
            define("HELPERS", __DIR__);
    	$tmp_search 	= self::split($search, ['/','/']);
        $search_list    = $tmp_search ['list'];
    	$tmp_subject 	= $subject;
        $text = "";

        $search_list [] = "/".self::decode_str($search)."/";

        $fichier = fopen(HELPERS.'/demo.txt', "a+");
        fwrite($fichier, self::decode_str($search)."\n");
        fwrite($fichier, "###################################################\n");
        fwrite($fichier, json_encode($search_list)."\n");
        fwrite($fichier, $subject."\n");
        fclose($fichier);


        $text = preg_replace_callback(
            $search_list,
            function($rearch){
 
                return isset($rearch[0]) ? '<strong>'.$rearch[0].'</strong>' : '';

            }, $subject );

        return self::decode_str($text);
    }

    static function _($arg, $object = '-') {
      $c = 0;
      $tire = '';
      $limit = is_array($arg) ? count($arg) : strlen($arg);
      while($c < $limit){
        $c++;
        $tire .= $object;
      }
      return $tire;
    }
    /**
    * prend un chaine et retourne deux tableaux
    * le principal et la list
    * 
    * @param $string
    * @return $array['list']
    */
    public static function split($string, $limite = ['[',']']) 
    {
        $tab = str_split($string);

        $total   = [];
        $changed = [];

        $l1 = $limite[0];
        $l2 = $limite[1];

        $total [] = $l1.Mbstring::mb_strtolower(self::decode_str($string)).$l2;

        foreach ($tab as $key => $value)
        {

            $string = '';
            $c      = 0;

            for($i=0; $i<count($tab); $i++ ) 
            {

                if (!in_array($tab[$i],  $changed) && $value == $tab[$i] && $c === 0)
                {
                    $changed [$i] = self::decode_str($value);
                    $string .= self::decode_str($value);
                    $c +=1;
                }else{
                        $string .= $tab[$i];
                    }
            }

            $total [] = $l1.Mbstring::mb_convert_encoding($string, 'UTF8').$l2;

        }

        // print_r($total);exit;

        return ['list' =>$total, 'changed' => $changed];
    }

    public static function decode_str($string)
    {
       $conversion = array(
            "è"      => "&agrave;"
           ,"é"      => "&eacute;"
           ,"\\351"  => "&eacute;"
           ,"\\222"  => "'"
           ,"\\347"  => "&ccedi;"
           ,"\\340"  => "&agrave;"
           ,"\\350"  => "&egrave;"
           ,"\\253"  => "\""
           ,"\\273"  => "\""
           ,"\\205"  => "..."
           ,"\u00e8s"=> "&egrave;s"
           ,"\""     => "&quot;"
           ,"'"      => "&#039;"
       );
       return strtr($string, $conversion);
    }
    public static function encode_str($string)
    {
        $conversion = array(
            "&agrave;"  => "è"
            ,"&eacute;" => "é"
            ,"&ccedi;"  => "ç"
            ,"quot"     => "\""
            ,"&#039;"   => "'"
        );
        return strtr($string, $conversion);
    }



    public static function palindrum($palindrum, $text) {
        if ($palindrum == strrev($text))
            return true;
        return false;
    }
    public static function cleanNonUnicodeSupport($pattern)
    {
        if (!defined('PREG_BAD_UTF8_OFFSET')) 
        {
            return $pattern;
        }
        return preg_replace('/\\\[px]\{[a-z]{1,2}\}|(\/[a-z]*)u([a-z]*)$/i', '$1$2', $pattern);
    }
    public static function isEmail($email)
    {
        return !empty($email) && preg_match(self::cleanNonUnicodeSupport('/^[a-z\p{L}0-9!#$%&\'*+\/=?^`{}|~_-]+[.a-z\p{L}0-9!#$%&\'*+\/=?^`{}|~_-]*@[a-z\p{L}0-9]+(?:[.]?[_a-z\p{L}0-9-])*\.[a-z\p{L}0-9]+$/ui'), $email);
    }


    public static function htmlEntities($string) {

        return htmlentities($string, ENT_QUOTES, "UTF-8");
    }
    public static function htmlEntitiesDecode($string) {
        return html_entity_decode($string, ENT_QUOTES, "UTF-8");
    }
}

?>