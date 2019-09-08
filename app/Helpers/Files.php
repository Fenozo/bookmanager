<?php  


class Files 
{

	public static function create_files($path = ['..','memo','textes'], $file = null) {

		if (!defined("HELPERS"))
            define("HELPERS", __DIR__);
        $join_path = join("/", $path);

        if ($file == null)
			$file = date('d-m-Y');

        \App\Helpers\Dir::create_dir($path);

        $fichier = fopen(HELPERS.$join_path.'-'.$file.'-.txt', "a+");
        fwrite($fichier, self::decode_str($search)."\n");
        fwrite($fichier, "###################################################\n");
        fwrite($fichier, json_encode($search_list)."\n");
        fwrite($fichier, $subject."\n");
        fclose($fichier);

	}

    public static function csv ($filename) {
        $datas = array();

        if (($handle = fopen($filename, "r")) !== false)  {
            
            while (($data = fgetcsv($handle, 1000, ";")) !== false) {
                $num = count($data);
                $row++;

                $list = strtoupper(trim(utf8_encode($data[4])));

                if(!in_array($list, $datas) && !empty($list)) {
                    $datas[] = $list;
                }
            }
            
            fclose($handle);
        }
        return $datas
    }
}

?>