
<?php
include 'conexion_db.php';


$usuario = $_POST['userName'];
$pasword = $_POST['pass'];

$validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE  num_documento='$usuario' and clave='$pasword'");
 if (mysqli_num_rows($validar_login)>0){
    header("location: ../SFI/home.php");
 exit;

 } else {
    echo '
    <script>
    alert("usuario no existe")
    window.location= "../sfi/index.php"; 
    </script>
    '; 
 }

?>
