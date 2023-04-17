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
	$permiso = 'agregar nueva produccion';
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
// Conectarse a la base de datos
  $conexion = mysqli_connect ("localhost", "root", "", "lachila" ); 

  $fecha = $_POST['fecha'];
  $pesoinicial = $_POST['PesoInicial'];
  $pesodesperdicio = $_POST['PesoDesperdicio'];
  $pesoneto = $_POST['PesoNeto'];
  $adiciones = $_POST['Adiciones'];
  $lote = $_POST['#lote'];
  $empleado = $_POST['Empleado'];
  $cantidad = $_POST['Cantidad'];
  $materia = $_POST['opciones'];
  

  // Insertar los datos en la base de datos
  $sql = "INSERT INTO lotes (id, materia, fecha_inicio, peso_inicial, peso_neto, adicion, cantidad, usuario) VALUES ('$lote','$materia','$fecha','$pesoinicial','$pesoneto','$adiciones','$cantidad', '$empleado')";

  $resultado = mysqli_query($conexion, $sql);

  if ($resultado) {echo '
    <script>
    alert("Los datos fueron grabados correctamente")
    window.location= "../sfi/home.php"; 
    </script>
    '; 
  } else {
      echo "Error al insertar los datos: " . mysqli_error($conexion);
  }
  
  // Cerrar la conexión con la base de datos
  mysqli_close($conexion);
  ?>
