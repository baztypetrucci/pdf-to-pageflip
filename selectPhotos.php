<?php
require_once 'uploader.php';
$delpath = "uploads/cropped";
$ancho = (float)$_POST["ancho"];
$alto = (float)$_POST["alto"];
$paginas_dobles = $_POST["paginas_dobles"];

if($ancho<=0 && $alto<=0){
	$ancho = 1200;
	$alto = 432;
}
foreach ($archivosSubidos as $k => $v) {
	$archivo = $v;

	$imageFileName = pathinfo($archivo,PATHINFO_FILENAME);
	$original_name = $imageFileName;
	$imageFileType = pathinfo($archivo,PATHINFO_EXTENSION);

	//Se crea la carpeta donde se iran las imagenes
	$finalFolderImages = "$delpath/$original_name/originales";
	mkdir("$finalFolderImages",0755,true);

	$im = new Imagick();
	//PRIMERA PÁGINA
	// DPI
	$im->setResolution(100,100);
	$im->readImage($archivo);
	$im->setImageFormat("jpg");
	$im->setImageBackgroundColor('white');
	$num_pages = $im->getNumberImages();
	//Tamaño final, true es para no deformar la imagen
	for ($i=0; $i < $num_pagesi; $i++) {
		$im->previousImage();
		$im->scaleImage($ancho, $alto, true);
		//Primer corte de 600 de ancho por 432 de alto en la posicion x=0, y=0
		if(!isset($paginas_dobles)){
			$im->cropImage($ancho/2,$alto,0,0);
		}
		//Se crean y guardan las imagenes para este corte
		$im->writeImage($finalFolderImages.'/'.$original_name.'-'.$num_pages.'1.jpg');
		$num_pages--;
	}
	//SE LIMPIA EL OBJETO
	$im->clear();
	//SEGUNDA PÁGINA
	// DPI
	$im->setResolution(100,100);
	$im->readImage($archivo);
	$im->setImageFormat("jpg");
	$im->setImageBackgroundColor('white');
	//$num_pages = $im->getNumberImages();
	//Tamaño final, true es para no deformar la imagen
	for ($i=0; $i < num_pages; $i++) {
		$im->previousImage();
		$im->scaleImage($ancho, $alto, true);
		//Primer corte de 600 de ancho por 432 de alto en la posicion x=0, y=0
		if(!isset($paginas_dobles)){
			$im->cropImage($ancho/2,$alto,0,0);
		}
		//Se crean y guardan las imagenes para este corte
		$im->writeImage($finalFolderImages.'/'.$original_name.'-'.$num_pages.'2.jpg');
		$num_pages--;
	}
	$im->clear();

	if(isset($_POST["primera_pagina"])){
		$directorio = scandir($finalFolderImages);
		$archivofinal = end($directorio);
		$archivofinal = explode(".",$archivofinal);
		foreach ($directorio as $k => $v) {
			if($v == '.' || $v == '..'){
				continue;
			}
			rename("$finalFolderImages/$v", "$finalFolderImages/$archivofinal[0]1.jpg");
			break;
		}
	}
	function recurse_copy($src,$dst) {
		$dir = opendir($src);
		@mkdir($dst);
		while(false !== ( $file = readdir($dir)) ) {
			if (( $file != '.' ) && ( $file != '..' )) {
				if ( is_dir($src . '/' . $file) ) {
					recurse_copy($src . '/' . $file,$dst . '/' . $file);
				}
				else {
					copy($src . '/' . $file,$dst . '/' . $file);
				}
			}
		}
		closedir($dir);
	}
	//Copiando la base del pageflip a la carpeta
	recurse_copy("base-pageflip/", "$delpath/$original_name");


	//ZipArchive
	// Get real path for our folder
	$rootPath = realpath("$delpath/$original_name");

	// Initialize archive object
	$zip = new ZipArchive();
	$zip->open("completed/".$original_name.'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

	// Create recursive directory iterator
	/** @var SplFileInfo[] $files */
	$files = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator($rootPath),
		RecursiveIteratorIterator::LEAVES_ONLY
	);
	foreach ($files as $name => $file)
	{
		if($file->getFilename() != 'index.php'){
			// Skip directories (they would be added automatically)
			if (!$file->isDir())
			{
				// Get real and relative path for current file
				$filePath = $file->getRealPath();
				$relativePath = substr($filePath, strlen($rootPath) + 1);

				// Add current file to archive
				$zip->addFile($filePath, $relativePath);
			}
		}
	}


	ob_start();
	include($rootPath.'/index.php');
	$htmlStr = ob_get_contents();
	ob_end_clean();
	//$contenido = file_put_contents($fileName, $htmlStr);
	$rutaArchivo = "$delpath/$original_name/$original_name.html";
	$outputHtml = fopen($rutaArchivo, "x+");
	fwrite($outputHtml, $htmlStr);
	fclose($outputHtml);
	$zip->addFile($rutaArchivo, 'Pageflip.html');

	// Zip archive will be created only after closing object
	$zip->close();

}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/docs.css">
	<link rel="stylesheet" href="assets/css/styles.css">
	<script	src="assets/js/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="	crossorigin="anonymous"></script>
	<script src="assets/js/baztyFooter.min.js"></script>
	<script src="assets/js/scripts.js"></script>
</head>
<body class="bs-docs-home">

	<div class="bs-docs-header">
		<div class="container">
			<h1>PDF-to-Pageflip</h1>
			<p class="lead">Herramienta para transformar PDFs en Pageflips</p>
		</div>
	</div>
	<div class="bs-docs-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<h1>¡Excelente!</h1>
					<p>Descarga el pageflip acá</p>
					<a href="<?php echo "completed/".$original_name.".zip" ?>" class="btn btn-primary">Descargar</a>
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<h2>¿Necesitas crear otro Pageflip?</h2>
					<p><a href="/pdf-to-pageflip">Si, crear otro por favor</a></p>
				</div>
			</div>
		</div>
	</div>
	<div class="spaceFooter"></div>
	<footer class="bs-docs-footer">
		<div class="container">
			<p>Hecho por Bastián Hidalgo</p>
			<p class="version">1 de Diciembre, V.0.0.1</p>
		</div>
	</footer>

</body>
</html>
