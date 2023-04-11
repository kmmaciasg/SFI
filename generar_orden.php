<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lachila";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar la conexión
if (!$conn) {
	die("Conexión fallida: " . mysqli_connect_error());
}

// Procesar los datos ingresados por el usuario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$producto = $_POST["producto"];
	$cantidad = $_POST["cantidad"];
	$numero_orden = $_POST["numero_orden"];

    $sql = "SELECT codigo FROM productos WHERE Descripcion = '$producto'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $codigo_producto = $row["codigo"];
    } else {
        echo "No se encontró el producto en la tabla de productos.";
    }
	// Insertar los datos en la tabla de órdenes de despacho
	$sql = "INSERT INTO ordenes_despacho (numero_orden, producto, codigo, cantidad) VALUES ('$numero_orden','$producto','$codigo_producto', $cantidad)";

	

	mysqli_close($conn);
}
?>
