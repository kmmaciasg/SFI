<?php
function obtenerDatosPDF($numero_orden) {
    // Conectar a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "lachila");

    // Consulta para obtener los datos del número de orden ingresado
    $query = "SELECT * FROM pdf WHERE numero_orden = $numero_orden";
    $resultado = mysqli_query($conexion, $query);
    $fila = mysqli_fetch_assoc($resultado);

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);

    // Retornar los datos encontrados
    return $fila;
}
?>
