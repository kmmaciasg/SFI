<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lachila";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

// Obtener los datos del nuevo producto
// Procesar los datos ingresados por el usuario
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
	$sql2 = "INSERT INTO `ordenes_despacho` (numero_orden, producto, codigo, cantidad) VALUES ('$numero_orden','$producto','$codigo_producto', $cantidad)";

	if (mysqli_query($conn, $sql2)) {
    
        echo '
        <script>
        alert("el producto fue agregado correctamente")
        window.close();
        </script>
        '; 
    } else {
        echo "Error al eliminar el registro: " . mysqli_error($conn);
    }

    
	mysqli_close($conn);

?>