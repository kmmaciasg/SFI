<!DOCTYPE html>
<html>
<head>
	<title>Formulario de productos</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/sweetalert2.css">
	<link rel="stylesheet" href="css/material.min.css">
	<link rel="stylesheet" href="css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="css/main.css">
</head>
<body>
	<?php
	// Obtener el número de orden desde la URL
	$numero_orden = $_GET['numero_orden'];
	// Conectar a la base de datos
	$conexion = mysqli_connect("localhost", "root", "", "lachila");
	// Consulta SQL para obtener los datos
	$sql = "SELECT producto, lv, lc FROM ordenes_despacho WHERE numero_orden = $numero_orden";
	// Ejecutar la consulta
	$resultado = mysqli_query($conexion, $sql);
	?>
	<div class="mdl-grid">
		<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
			<div class="full-width panel mdl-shadow--2dp">
				<form method="post" action="actualizar.php">
					<label class="text-condensedLight" for="producto">Producto:</label>
					<select name="producto" id="producto">
						<?php while ($fila = mysqli_fetch_assoc($resultado)) { ?>
							<option value="<?php echo $fila['producto']; ?>"><?php echo $fila['producto']; ?></option>
						<?php } ?>
					</select><br></br>
					<label class="text-condensedLight" for="LV">LV:</label>
					<input type="number" name="LV" min="1" max="1000000000">
					<label class="text-condensedLight" for="LC">LC:</label>
					<input type="number" name="LC" min="1" max="1000000000"><br></br>
                    <label class="text-condensedLight" for="numero_orden">Numero Orden</label>
							<input type="text" readonly value="<?php echo $numero_orden; ?>"name="numero_orden" id="numero:orden">
                            <br></br>
					<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" style="margin-left: 140px;" id="CrearProducto">
						<i class="zmdi zmdi-refresh"></i>
						<div class="mdl-tooltip" for="CrearProducto">editar lotes</div>
					</button>
                    
				</form>
			</div>
		</div>
	</div>
	<script src="js/material.min.js"></script>
	<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
