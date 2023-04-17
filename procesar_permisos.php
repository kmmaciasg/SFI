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
  
  // función para obtener la lista de usuarios desde la base de datos

  
// procesar los datos enviados por el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $accion = $_POST['accion'];
    $permisos = $_POST['permisos'];
    
    $conexion = conectar_bd();
    
    if ($accion == 'agregar') {
      // agregar los permisos seleccionados al usuario
      foreach ($permisos as $permiso) {
        $query = "SELECT CONCAT(nombres, ' ', apellidos) AS nombre_completo FROM usuarios WHERE num_documento = '$usuario'";
        $resultado = mysqli_query($conexion, $query);
        $usuario_info = mysqli_fetch_assoc($resultado);
        $nombre_completo = $usuario_info['nombre_completo'];

// Insertar el permiso para el usuario
$query = "INSERT INTO usuarios_permisos (usuario_nombre, usuario_documento, permiso_id)
          VALUES ('$nombre_completo', '$usuario', '$permiso')";
mysqli_query($conexion, $query);
echo '
    <script>
    alert("Los permisos fueron agregados correctamente")
    window.location= "../sfi/home.php"; 
    </script>
    '; 

      }
    } elseif ($accion == 'eliminar') {
      // eliminar los permisos seleccionados del usuario
      foreach ($permisos as $permiso) {
        $query = "DELETE FROM usuarios_permisos WHERE usuario_documento = '$usuario' AND permiso_id = $permiso";
        mysqli_query($conexion, $query);
      }
    }
    echo '
    <script>
    alert("Los permisos fueron eliminados correctamente")
    window.location= "../sfi/home.php"; 
    </script>
    '; 
    
    mysqli_close($conexion);
  }
?>