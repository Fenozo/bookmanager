<?php
namespace App\Helpers;

class Str 
{
    public static function replaceToStrong($search, $subject)
    {
        $subject = str_replace($search, '[b]'.$search.'[/b]' , $subject );
        $content = preg_replace('/\[b\]/', '<strong style="font-size:19px;">', $subject);
        return preg_replace('/\[\/b\]/', '</strong>', $content);
    }
}

?>