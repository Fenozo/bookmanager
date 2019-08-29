<?php
header('content-type:application/json');

if (isset($_FILES['file']))
{
	$file   = $_FILES['file'];
	$h 		= getallheaders();
	$o		= new stdClass();
	$types 	=  array('image/png','image/jpg','image/jpeg');

	if(!in_array($h['x-file-type'], $types)) // si l'extension du fichier n'est pas pris en compte
	{
		$o->error = "Format non supporté";

	}else{ // si l'extension du fichier est pris en compte
			if(move_uploaded_file($file['tmp_name'], '../../public/img/'.$file['name']))
		   	{
		       	$o->message = "L'upload s'est bien passé";
		       	$o->content = '<img src="'.$h['x-file-name'].'"  />';
		   	}else{
		   		$o->message = "Une erreur s'est survenue ";
		   		}
		}
	echo json_encode($o);
}


exit;

// print_r($h );

?>