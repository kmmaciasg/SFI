<?php

$conexion = mysqli_connect ("localhost", "root", "", "lachila" ); 
session_start(); // Iniciar sesión
    if(isset($_SESSION['nombre_usuario'])){ // Comprobar si se ha iniciado sesión
        $nombre_usuario = $_SESSION['nombre_usuario']; // Obtener el nombre de usuario guardado en la sesión
        $apellido_usuario = $_SESSION['apellido_usuario']; // Obtener el apellido de usuario guardado en la sesión
       
		
// Concatenar el nombre y apellido en una sola cadena de texto
$nombre_completo = $nombre_usuario . " " . $apellido_usuario;
    } else {
        header("Location: index.php"); // Si no se ha iniciado sesión, redirigir al inicio de sesión
    }

	// verificar si el usuario tiene permiso para acceder a esta página
	$permiso = 'administracion';
	$permisos_usuariop = obtener_permisos_usuariop($nombre_completo);
	if (!in_array($permiso, $permisos_usuariop)) {
	  // el usuario no tiene permiso, redirigir a la página de inicio y mostrar mensaje de error
	  // Imprimir mensaje
  echo "Para realizar esta accion se requieren permisos especiales ";

  header("refresh:3;url=home.php");

  // Redirigir al usuario a la página de inicio
  exit;
	}
	
?>

<?php
// función para conectarse a la base de datos
function conectar_bd() {
  $servidor = 'localhost';
  $usuario = 'root';
  $password = '';
  $bd = 'lachila';
  
  $conexion = mysqli_connect($servidor, $usuario, $password, $bd);
  
  if (!$conexion) {
    die('Error al conectar a la base de datos: ' . mysqli_connect_error());
  }
  
  return $conexion;
}	

function obtener_permisos_usuariop($nombre_completo) {

	
$conexion = conectar_bd();
$query = "SELECT p.id, p.nombre FROM permisos p 
INNER JOIN usuarios_permisos u ON p.id = permiso_id
WHERE u.usuario_nombre = '$nombre_completo'";
$resultado = mysqli_query($conexion, $query);
$permisos = array();
while ($fila = mysqli_fetch_assoc($resultado)) {
  $permisos[] = $fila["nombre"];
}
mysqli_free_result($resultado);
mysqli_close($conexion);
return $permisos;
}
?>
<?php
// Archivo buscar_lote.php

// Conectamos con la base de datos
$conexion = mysqli_connect("localhost", "root", "", "lachila");

// Obtenemos el ID del lote a buscar
$usuario = $_POST["id_lote"];

// Realizamos la consulta a la base de datos
$query = "SELECT * FROM usuarios WHERE num_documento = '$usuario'";
$resultado = mysqli_query($conexion, $query);

// Cerramos la conexión con la base de datos
mysqli_close($conexion);

// Devolvemos los resultados de la consulta
echo json_encode(mysqli_fetch_assoc($resultado));
?>