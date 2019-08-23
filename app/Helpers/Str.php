<?php
namespace App\Helpers;

class Str 
{

    // $subject = str_replace($search, '[b]'.$search.'[/b]' , $subject );
    // $content = preg_replace('/\[b\]/', '<strong style="font-size:19px;">', $subject);
    // $text = preg_replace('/\[\/b\]/', '</strong>', $content);
   
    public static function replaceToStrong($search, $subject)
    {
    	$tmp_search 	= self::split($search, ['/','/']);
    	$tmp_subject 	= $subject;

        $text = preg_replace_callback(
        	$tmp_search['list'],
        	function($rearch){

				return isset($rearch[0]) ? '<strong style="font-size:19px;">'.$rearch[0].'</strong>' : '';

			}, $subject );

        return $text;
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
        $tab = str_split(strtolower($string));

        $total   = [];
        $changed = [];

        $l1 = $limite[0];
        $l2 = $limite[1];

        $total [] = $l1.strtolower($string).$l2;

        foreach ($tab as $key => $value)
        {

            $string = '';
            $c      = 0;

            for($i=0; $i<count($tab); $i++ ) 
            {

                if (!in_array($tab[$i],  $changed)&&$value == $tab[$i] && $c === 0) {
                    $changed [$i] = $value;
                    $string .= strtoupper($value);
                    $c +=1;
                } else 
                    {
                        $string .= $tab[$i];
                    }
            }

            $total [] = $l1.$string.$l2;

        }

        return ['list' =>$total, 'changed' => $changed];
    }

    public static function decode_str($string)
    {
       $conversion = array(
           "\\351"   => "&eacute;"
           ,"\\222"  => "'"
           ,"\\347"  => "&ccedi;"
           ,"\\340"  => "&agrave;"
           ,"\\350"  => "&egrave;"
           ,"\\253"  => "\""
           ,"\\273"  => "\""
           ,"\\205"  => "..."
           ,"\\"     => ""
           ,"&eg<"   => "&egrave;s"
           ,"\u00e8s"=> "&egrave;s"
           ,"\""     => "&quot;"
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
}

?>