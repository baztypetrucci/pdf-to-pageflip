<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/docs.css">
	<link rel="stylesheet" href="assets/css/styles.css">
	<script	src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="	crossorigin="anonymous"></script>
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
					<form action="selectPhotos.php" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label for="original">
										Selecciona un archivo PDF para transformarlo en Pageflip
									</label>
									<input type="file" name="original" id="original" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="number">
										Selecciona un ancho para el pageflip
									</label>
									<input type="number" name="ancho" id="ancho" class="form-control">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="alto">
										Selecciona un ancho para el pageflip
									</label>
									<input type="number" name="alto" id="alto" class="form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="checkbox">
									<label>
										<input type="checkbox" id="primera_pagina" name="primera_pagina"> ¿La primera cuartilla es la última página?
									</label>
								</div>
							</div>
						</div>
						<input type="submit" value="Cargar" class="btn btn-outline btn-lg" name="submit">
					</form>
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
