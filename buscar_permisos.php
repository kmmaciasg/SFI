<?php
// función para conectarse a la base de datos
$usuario_seleccionado = $_GET['usuario'];

// Realizamos la conexión a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'lachila');

// Verificamos si hubo un error en la conexión
if ($conexion->connect_error) {
  die('Error en la conexión: ' . $conexion->connect_error);
}

// Realizamos la consulta a la base de datos para obtener los permisos del usuario seleccionado
$query = "SELECT p.id, p.nombre FROM permisos p 
INNER JOIN usuarios_permisos u ON p.id = u.permiso_id
WHERE u.usuario_documento = '$usuario_seleccionado'";
$resultado = mysqli_query($conexion, $query);

// Creamos un arreglo con los permisos del usuario
$permisos = array();

while ($fila = mysqli_fetch_assoc($resultado)) {
  $permisos[] = $fila;
}

// Enviamos los permisos del usuario como respuesta en formato JSON
header('Content-Type: application/json');
echo json_encode($permisos);

// Liberamos la memoria del resultado y cerramos la conexión a la base de datos
mysqli_free_result($resultado);
$conexion->close();

  
