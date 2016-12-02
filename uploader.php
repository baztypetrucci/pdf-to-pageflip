<?php
////////// Uploader
$target_dir = "uploads";
$archivosSubidos = array();
foreach ($_FILES as $k => $v) {
	$target_file = $target_dir.'/' . basename($v["name"]);
	$uploadOk = 1;

	$imageFileName = pathinfo($target_file,PATHINFO_FILENAME);
	$tmp_name = $v["tmp_name"];

	$original_name = $imageFileName;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$uploadOk = 1;
	}
	// Check if file already exists
	$i = 1;
	while(file_exists($target_dir.'/'.$imageFileName.".".$imageFileType)){
		$imageFileName = (string)$original_name.'-'.$i;
		$name = $imageFileName.".".$imageFileType;
		$i++;
	}
	// Check file size
	// if ($v["size"] > 500000) {
	// 	//echo "Archivo demasiado grande.";
	// 	$uploadOk = 0;
	// }
	// Allow certain file formats
	if($imageFileType != "pdf") {
		//echo "Solo se admiten archivos excell";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		//echo "El archivo no pudo ser procesado";
		// if everything is ok, try to upload file
	} else {
		$textSearch = array('ñ','á','é','í','ó','ú','Á','É','Í','Ó','Ú','Ñ',' ');
		$arrayReplace = array('n','a','e','i','o','u','A','E','I','O','U','N','-');
		$nuevoNombre = str_replace($textSearch,$arrayReplace,$imageFileName);
		if (move_uploaded_file($tmp_name, "$target_dir/$nuevoNombre.$imageFileType")) {
			//echo "El archivo ". basename( $v["name"]). " fue cargado.";
			$archivosSubidos[$k] = "$target_dir/$nuevoNombre.$imageFileType";
		} else {
			//echo "Hubo un eror al subir el archivo";
		}
	}
}


///// -- -- -- -- END uploader
?>
