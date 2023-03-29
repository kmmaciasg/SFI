
<?php
include 'conexion_db.php';


$usuario = $_POST['userName'];
$pasword = $_POST['pass'];

$validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE  num_documento='$usuario' and clave='$pasword'");
 if (mysqli_num_rows($validar_login)>0){
    // El usuario es auténtico, redirigir al usuario a la página de inicio con el nombre de usuario como parámetro
  header("Location: ../SFI/home.php?userName=" . urlencode($usuario));
  exit;
} else {
  // El usuario no es auténtico, mostrar mensaje de error y redirigir al usuario de nuevo a la página de inicio de sesión
  echo '
    <script>
      alert("Usuario no existe.");
      window.location= "../sfi/index.php"; 
    </script>
  '; 
 }

?>
