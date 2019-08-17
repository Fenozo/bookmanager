<?php
namespace App\Helpers;

class Str 
{
    public static function replaceToStrong($search, $subject)
    {
        $subject = str_replace(strtolower($search), '[b]-'.strtolower($search).'[/b]' , $subject);
        $content = preg_replace('/\[b\]/', '<strong style="font-size:22px;">', $subject);
        return preg_replace('/\[\/b\]/', '</strong>', $content);
    }
}

?>