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
	/**
	*	Retourne le chemin du repértoir du travail
	*/
	public function getWorkPath()
	{
		return getcwd();
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
			$h 		= getallheaders();
			

			$file   = $_FILES['file'];
			$o		= new \stdClass();
			$o->file= $file;
			$types 	=  array('image/png','image/jpg','image/jpeg');



			if(!in_array($h['x-file-type'], $types) || $h['x-file-type'] == "") // si l'extension du fichier n'est pas pris en compte
			{
				$o->error = 505;
				$o->message = "Format non supporté";

			}else{ 	// si l'extension du fichier est pris en compte
		
				 if(isset($_POST['x-file-value']))
			        {
			            $o->value = $_POST['x-file-value'];

						if(file_exists($this->path.'/'.$_POST['x-file-value']))
						{
							unlink($this->path.'/'.$_POST['x-file-value']);
						}	
						
			        }

					if(move_uploaded_file($file['tmp_name'], $this->path.'/'.$file['name']))
				   	{
						if (is_file($this->path.'/'.$file['name'])) // si le fichier existe
						{
					       	$o->message = "L'upload s'est bien passé";
					       	$o->content = '<img src="'.asset($image_path.'/'.$h['x-file-name']).'"  />';
					       	$o->name    = $file['name'];
						}else{
								$o->erreur = "505";
								$o->message = "Une erreur s'est survenue ";
							}
				   	}else{
				   			$o->erreur = "505";
				   			$o->message = "Une erreur s'est survenue ";
				   		}
				}
			echo json_encode($o);
		}

	}
}