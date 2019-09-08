<?php
namespace App\Helpers;

use App\Models\Image;
use App\Helpers\Str;

/**
 * 
 */
class Images
{
	protected static $file = false;
	protected $path;
	protected $specified_dirs ;

	protected $name;
	protected $size;
	protected $type;

	function __construct($dir = ['/../','img'])
	{
		$this->specified_dirs = implode(DIRECTORY_SEPARATOR, $dir);
		$this->path = \App\Helpers\Dir::create_dir($dir);
	}
	/**
	*	Retourne le chemin du repértoir du travail
	*/
	public function getWorkPath()
	{
		return getcwd();
	}

	public function list() 
	{
		$glob = glob($this->path.'/*');
		$list_files = [];


		foreach (glob($this->path.'/*') as $key => $file) 
		{
			$file = str_replace(__DIR__, '', $file);
			$list_files []= str_replace($this->specified_dirs, '', $file);
		}

		return $list_files;
	}

	public function move($filename, $source) 
	{
		file_put_contents($this->path.'/'.$filename, $source);
	}

	public function delete ($file, $o) {
		if(isset($_POST['x-file-value']))
	        {
	            $o->value = $_POST['x-file-value'];

	            $image = Image::where("cripted_name","=", $_POST['x-file-value'])->first();

	            if ($image) {
		            
					if(file_exists($this->path.'/'.$image->cripted_name)) {
						// Supprimé un fichier
						unlink($this->path.'/'.$image->cripted_name);

						}

					Image::where("cripted_name", "=", $image->cripted_name)->delete();
				}
	        }

        foreach(glob($this->path.'/*') as $each_files) 
	        {
	        	if ($file["name"] === $each_files) {
	        		self::$file = $each_files;
	        		break;
	        	} else {
	        		self::$file = false;
	        	}

	        }
	}

	/**
	* Permet d'uploader un fichier ou des fichiers images
	*
	* @param $image_path
	*/
	public function uploaded($image_path= 'img') 
	{

		header('content-type:application/json');
		

		if (isset($_FILES['file']))
		{
			$h 		 = getallheaders();

			$this->getFile();
			
			$file    = $_FILES['file'];

			$o		 = new \stdClass();

			$o->error= null;

			$o->file = $file;

			$types 	 =  array('image/png','image/jpg','image/jpeg');

			$cripted_name =  $this->getCriptedName();


			if(!in_array($h['x-file-type'], $types) || $h['x-file-type'] == "") // si l'extension du fichier n'est pas pris en compte
			{
				$o->error = 505;
				$o->message = "Format non supporté";

			}else{ 	// si l'extension du fichier est pris en compte
		
					$this->delete($file, $o);

			        if (self::$file === false)
			        {

			        	// Enregisté les fichiers dans un dosseir
						if(move_uploaded_file($file['tmp_name'], $this->path.'/'.$cripted_name ))
					   	{
							if (file_exists($this->path.'/'. $cripted_name )) // si le fichier existe
							{
								Image::create([
					   				"name" 			=> $this->name, 
					   				"size" 			=> $this->size,
					   				"type" 			=> $this->type,
					   				"cripted_name" 	=> $cripted_name,
					   			]);

						       	$o->message = "L'upload s'est bien passé";
						       	$o->content = '<img src="'.asset($image_path.'/'. $cripted_name).'"  />';
						       	$o->name    =  $cripted_name;

							}else{
									// echo "Voici une test";
									// exit;
									$o->error = "505";		
								}
					   	}else{

					   			$o->error = "505";
					   		}
				   	}else{
				   			$o->error = "505";
				   		}
				}

			$o->message = ($o->error === "505") ? "Une erreur s'est survenue " : null;

			echo json_encode($o);
		}

	}

	private function getFile() {

		if (isset($_FILES['file'])) {

			$file = $_FILES['file'];

			$this->name = $file['name'];
			$this->size = $file['size'];
			$this->type = $file['type'];
		}
	}

	public function getCriptedName() {
		
		$cripted_name = date("Ymd.hms").".".filename_in_path($this->name, ".");

			if (Image::where("cripted_name", "=", $cripted_name)->first()) {
				return $this->getCriptedName();
			}

		return $cripted_name;
	}
}