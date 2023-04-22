<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lachila";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Error de conexión a la base de datos: " . $conn->connect_error);
}

// Obtener el número de lote seleccionado
$lote = $_POST["lote"];

// Obtener la materia prima del lote desde la base de datos
$sql = "SELECT Materia, loteagua FROM lotes WHERE id = '" . $lote . "'";
$resultado = $conn->query($sql);

// Comprobar si se encontró la materia prima del lote
if ($resultado->num_rows > 0) {
	$fila = $resultado->fetch_assoc();
	$materiaPrima = $fila["Materia"];
	$loteagua = $fila["loteagua"];
	echo json_encode(array("materiaPrima" => $materiaPrima, "loteagua" => $loteagua));

} else {
	echo json_encode(array("materiaPrima" => "Materia prima no encontrada","loteagua" => "Lote no encontrado"));
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
