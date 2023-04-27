<?php
    include 'conexion_db.php';

    $usuario = $_POST['userName'];
    $pasword = $_POST['pass'];

    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE num_documento='$usuario' and clave='$pasword'");
    if (mysqli_num_rows($validar_login)>0){
        $row = mysqli_fetch_assoc($validar_login);
        $nombre_usuario = $row['nombres']; // Obtener el nombre del usuario de la base de datos
        $apellido_usuario = $row['apellidos']; // Obtener el apellido del usuario de la base de datos
        session_start(); // Iniciar sesión
        $_SESSION['nombre_usuario'] = $nombre_usuario; // Guardar el nombre del usuario en una variable de sesión
        $_SESSION['apellido_usuario'] = $apellido_usuario; // Guardar el apellido del usuario en una variable de sesión
        header("location: ../SFI/home.php");
        exit;

    } else {
        echo '
        <script>
        alert("Clave o usuario incorrectos")
        window.location= "../sfi/index.php"; 
        </script>
        '; 
    }
?>
