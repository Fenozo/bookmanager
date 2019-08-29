<?php
namespace App\Helpers;


/**
 * 
 */
class Images
{
	protected $path;
	protected $specified_dirs ;

	function __construct($dir = ['/../','img'])
	{
		$this->specified_dirs = implode(DIRECTORY_SEPARATOR, $dir);
		$this->path = \App\Helpers\Dir::create_dir($dir);
	}

	public function list() {
		$glob = glob($this->path.'/*');
		$list_files = [];


		foreach (glob($this->path.'/*') as $key => $file) {
			$file = str_replace(__DIR__, '', $file);
			$list_files []= str_replace($this->specified_dirs, '', $file);
		}

		return $list_files;
	}

	public function move($filename, $source) {

		file_put_contents($this->path.'/'.$filename, $source);
	}

	public function uploaded($image_path= 'img') {

		header('content-type:application/json');

		if (isset($_FILES['file']))
		{
			$file   = $_FILES['file'];
			$h 		= getallheaders();
			$o		= new \stdClass();
			$types 	=  array('image/png','image/jpg','image/jpeg');

			if(!in_array($h['x-file-type'], $types)) // si l'extension du fichier n'est pas pris en compte
			{
				$o->error = "Format non supporté";

			}else{ // si l'extension du fichier est pris en compte
					if(move_uploaded_file($file['tmp_name'], $this->path.'/'.$file['name']))
				   	{
				       	$o->message = "L'upload s'est bien passé";
				       	$o->content = '<img src="'.asset($image_path.'/'.$h['x-file-name']).'"  />';
				   	}else{
				   		$o->message = "Une erreur s'est survenue ";
				   		}
				}
			echo json_encode($o);
		}

	}
}