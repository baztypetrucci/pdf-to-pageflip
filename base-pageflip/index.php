<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="es" class="no-js"> <!--<![endif]--><head>
<script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
<meta charset="utf-8">
<style>
.js #features {
	margin-left: -12000px; width: 100%;
}

</style>
<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
Remove this if you use the .htaccess -->
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title>Catálogo Diciembre 2016 | Feliz Navidad </title>
<meta name="description" content="">
<meta name="author" content="Marcio Aguiar">

<!--  Mobile viewport optimized: j.mp/bplateviewport -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- CSS : implied media="all" -->
<link href="css/style.css?v=2" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="wow_book/wow_book.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="css/preview.css">
<script src="js/mylibs/less-1.0.41.min.js" type="text/javascript"></script>

<!-- Uncomment if you are specifically targeting less enabled mobile browsers
<link rel="stylesheet" media="handheld" href="css/handheld.css?v=2">  -->

<link href='http://fonts.googleapis.com/css?family=News+Cycle' rel='stylesheet' type='text/css'>
<!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->

<script src="js/libs/modernizr-1.6.min.js"></script>

</head>
<body>
	<div id="container">
		<nav>
			<ul>
				<li><a id='first'     href="#" title='Ir a la página primera'   >First page</a></li>
				<li><a id='back'      href="#" title='Retroceder una página'  	>Back</a></li>
				<li><a id='next'      href="#" title='Ir a la página siguiente'	>Next</a></li>
				<li><a id='last'      href="#" title='Ir a la última página'    >last page</a></li>
				<li><a id='zoomin'    href="#" title='Zoom [+]'           		>Zoom In</a></li>
				<li><a id='zoomout'   href="#" title='Zoom [-]'          		>Zoom Out</a></li>
				<li><a id='slideshow' href="#" title='Comenzar la presentación' >Slide Show</a></li>
			</ul>

		</nav>

		&nbsp;

		<div id="main">
			<img id='click_to_open' src="images/click_para_abrir.png" alt='click to open' />
			<div id='features'>
				<?php
				if(isset($rootPath)){
					$dir = "$rootPath/originales/";
				}else{
					$dir = "originales/";
				}
				$count = 0;
				$arrayImg = array();
				// Abre un directorio conocido, y procede a leer el contenido
				if (is_dir($dir)) {
					if ($dh = opendir($dir)) {
						$contador = 0;
						while (($file = readdir($dh)) !== false) {
							//echo "nombre archivo: $file : tipo archivo: " . filetype($dir . $file) . "\n";
							if ($file =="." || $file==".." || $file==".DS_Store"){
								continue;
							}
							array_push($arrayImg,$file);
						}
						sort($arrayImg);
						//print_r($arrayImg);
						closedir($dh);
					}
				}
				foreach ($arrayImg as $k => $v) {
					if($k === 0){
						echo "<div id='cover' style=\"background-image:url(originales/".$v.")\"></div>";
					}else{
						echo "<div class='feature pag".$k."' style=\"background-image:url(originales/".$v.")\"></div>\n";
					}
				}
				?>

			</div> <!-- features -->

		</div>
		<footer>

		</footer>
	</div> <!--! end of #container -->
</div>


<!-- Javascript at the bottom for fast page loading -->

<!-- Grab Google CDN's jQuery. fall back to local if necessary -->
<script type="text/javascript" src="js/libs/jquery-1.7.1.min.js"></script>

<sscript src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.js"></sscript>
<script>// !window.jQuery && document.write(unescape('%3Cscript src="js/libs/jquery-1.7.1.min.js"%3E%3C/script%3E'))</script>
<script type="text/javascript" src="wow_book/wow_book.min.js"></script>
<style>
</style>
<?php echo
"<script type=\"text/javascript\">
$(document).ready(function() {
	$('#features').wowBook({
		height :  ".$alto."
		,width  :  ".$ancho."
		,centeredWhenClosed : true
		,hardcovers : true
		,turnPageDuration : 1000
		,numberedPages : [1,-2]
		,transparentPages : true
		,controls : {
			zoomIn    : '#zoomin',
			zoomOut   : '#zoomout',
			next      : '#next',
			back      : '#back',
			first     : '#first',
			last      : '#last',
			slideShow : '#slideshow'
		},
	}).css({'display':'none', 'margin':'auto'}).fadeIn(1000);

	$(\"#cover\").click(function(){
		$.wowBook(\"#features\").advance();
	});
});
</script>";
?>

<!-- scripts concatenated and minified via ant build script-->

<script src="js/plugins.js"></script>
<script src="js/script.js"></script>
<!-- end concatenated and minified scripts-->

<!--[if lt IE 7 ]>
<script src="js/libs/dd_belatedpng.js"></script>
<script> DD_belatedPNG.fix('img, .png_bg'); //fix any <img> or .png_bg background-images </script>
<![endif]-->
</body>
</html>
