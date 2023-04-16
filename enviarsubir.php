<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "lachila");

// Verificar conexión
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Recibir el dato del campo "numero_orden"
$numero_orden = $_POST["numero_orden"];
$cliente = $_POST["opciones"];
$fecha = $_POST["fecha"];
$cajas = $_POST["cajas"];
$pago = $_POST["pago"];
$embalaje = $_POST["embalaje"];
$creador = $_POST["creador"];
$responsable = $_POST["responsable"];
$transportadora = $_POST["transportadora"];
$notas = $_POST["notas"];



// Consulta SQL para insertar el dato en la tabla "o_subir"
$sql = "INSERT INTO `o_reparto` (numero_orden) VALUES ('$numero_orden')";

if (mysqli_query($conexion, $sql)) {
    echo "Número de orden guardado correctamente";
} else {
    echo "Error al guardar el número de orden en la tabla o_subir: " . mysqli_error($conexion) . "<br>";
}

// Consulta SQL para borrar el dato de la tabla "o_despacho"
$sql2 = "DELETE FROM o_despacho WHERE numero_orden = '$numero_orden'";

if (mysqli_query($conexion, $sql2)) {
    echo "";
} else {
    echo "Error al eliminar el número de orden de la tabla o_despacho: " . mysqli_error($conexion) . "<br>";
}

// Consulta SQL para insertar el dato en la tabla "o_nofacturada"
$sql3 = "INSERT INTO o_nofacturada (numero_orden) VALUES ('$numero_orden')";

if (mysqli_query($conexion, $sql3)) {
} else {
    echo "Error al guardar el número de orden en la tabla o_nofacturada: " . mysqli_error($conexion) . "<br>";
}
$sql4 = "INSERT INTO pdf( numero_orden, cliente,fecha,cajas,pago,embalaje,creador,responsable,transportadora,notas) VALUES ('$numero_orden','$cliente','$fecha','$cajas','$pago','$embalaje','$creador','$responsable','$transportadora','$notas')";

if (mysqli_query($conexion, $sql4)) {
    echo '
    <script>
    alert("Los datos fueron grabados correctamente")
    window.location= "../sfi/generarpdf.php"; 
    </script>
    '; 
} else {
    echo "Error al guardar el número de orden en la tabla o_nofacturada: " . mysqli_error($conexion) . "<br>";
}

// Cerrar conexión a la base de datos
mysqli_close($conexion);
?>

