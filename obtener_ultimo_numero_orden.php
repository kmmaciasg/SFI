<?php
function obtenerUltimoNumeroOrden() {
    // Conectar a la base de datos
    $conexion = mysqli_connect("localhost", "root", "", "lachila");

    // Consulta para obtener el último número de orden ingresado
    $query = "SELECT MAX(numero_orden) AS ultimo_numero FROM o_despacho";
    $resultado = mysqli_query($conexion, $query);
    $fila = mysqli_fetch_assoc($resultado);

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);

    // Retornar el último número de orden encontrado
    return $fila["ultimo_numero"];
}
?>
