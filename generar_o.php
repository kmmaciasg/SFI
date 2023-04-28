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
	$permiso = 'generar orden';
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
<!DOCTYPE html>
<html lang="es">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
		
			$(document).ready(function() {
      $("#opciones").change(function() {
        var nombre = $(this).val();
        $.ajax({
          url: "obtenerdatos.php",
          type: "POST",
          data: {nombre: nombre},
          dataType: "json",
          success: function(data) {
            $("#cedula").val(data.cedula);
            $("#cel").val(data.cel);
            $("#email").val(data.email);
            $("#ciudad").val(data.ciudad);
            $("#dir").val(data.dir);
          },
          error: function() {
            alert("Error al cargar los datos del cliente");
          }
        });
      });
    });
	</script>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Generar Orden</title>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/sweetalert2.css">
	<link rel="stylesheet" href="css/material.min.css">
	<link rel="stylesheet" href="css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="css/main.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>
	<script src="js/material.min.js" ></script>
	<script src="js/sweetalert2.min.js" ></script>
	<script src="js/jquery.mCustomScrollbar.concat.min.js" ></script>
	<script src="js/main.js" ></script>
</head>
<body >



<?php
include 'conexion_db.php';

// Consulta SQL para obtener los datos
$sql = "SELECT nombre FROM clientes";

// Ejecutar la consulta
$resultado = mysqli_query($conexion, $sql);

// Consulta SQL para obtener los datos
$sql1 = "SELECT Descripcion, codigo FROM productos";

// Ejecutar la consulta
$resultado1 = mysqli_query($conexion, $sql1);


// Obtener el último número de orden
$query = "SELECT numero_orden FROM ordenes_despacho ORDER BY id DESC LIMIT 1";
$resultorden = mysqli_query($conexion, $query);


if (mysqli_num_rows($resultorden) > 0) {
	$row = mysqli_fetch_assoc($resultorden);
	$last_order_number = $row["numero_orden"];
  } else {
	// Si no hay ninguna orden en la tabla, establecer el número de orden en 0
	$last_order_number = 0;
  }
  
  // Generar el siguiente número de orden
  $new_order_number = $last_order_number + 1;


// Consulta para seleccionar los datos de la tabla "ordenes_despacho"
$sql2 = "SELECT codigo, producto, cantidad, lv, lc FROM ordenes_despacho WHERE numero_orden = '$new_order_number'" ;
$result = $conexion->query($sql2);


$sql_usuario = "SELECT foto FROM usuarios WHERE nombres = '$nombre_usuario'";

$resultado_usuario = mysqli_query($conexion, $sql_usuario);

// Obtener la ruta de la imagen del usuario actual
$fila_usuario = mysqli_fetch_assoc($resultado_usuario);
$ruta_imagen = $fila_usuario['foto'];
// Variable para contar el número de notificaciones no leídas
$num_notificaciones = 0;
?>

<!-- Notifications area -->
<section class="full-width container-notifications">
	<div class="full-width container-notifications-bg btn-Notification">

	</div>

	<section class="NotificationArea">
		<div class="full-width text-center NotificationArea-title tittles">Notificaciones <i class="zmdi zmdi-close btn-Notification"></i></div>
		
		<?php
		// Crear una consulta SQL para seleccionar los productos con cantidad menor al stock límite
		$sql4 = "SELECT * FROM productos WHERE Cantidad < stock_limite";
		
		// Ejecutar la consulta
		$resultado4 = $conexion->query($sql4);
		
		// Verificar si hay resultados
		if ($resultado4->num_rows > 0) {
			// Si hay resultados, imprimir la notificación correspondiente para cada producto y aumentar el número de notificaciones no leídas
			while ($fila = $resultado4->fetch_assoc()) {
				echo '<a href="#" class="Notification" id="notifation-unread-'.$fila['id'].'">
					<div class="Notification-icon"><i class="zmdi zmdi-alert-triangle bg-info"></i></div>
					<div class="Notification-text">
						<p><strong>'.$fila['Descripcion'].' con stock menor a '.$fila['stock_limite'].'</strong></p>
					</div>
					<div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-'.$fila['id'].'">PRODUCTO TERMINADO</div> 
				</a>';
				$num_notificaciones++;
			}
		} else {
			// Si no hay resultados, no imprimir nada
		}
		?>
            
       
			<?php
		// Crear una consulta SQL para seleccionar los productos con cantidad menor al stock límite
		$sql5 = "SELECT * FROM envases WHERE Cantidad < stock_limite";
		
		// Ejecutar la consulta
		$resultado5 = $conexion->query($sql5);
		
		// Verificar si hay resultados
		if ($resultado5->num_rows > 0) {
			// Si hay resultados, imprimir la notificación correspondiente para cada producto y aumentar el número de notificaciones no leídas
			while ($fila = $resultado5->fetch_assoc()) {
				echo '<a href="#" class="Notification" id="notifation-unread-2'.$fila['id'].'">
					<div class="Notification-icon"><i class="zmdi zmdi-alert-triangle bg-info"></i></div>
					<div class="Notification-text">
						<p><strong>'.$fila['Descripcion'].' con stock menor a '.$fila['stock_limite'].'</strong></p>
					</div>
					<div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-2'.$fila['id'].'">ENVASES</div> 
				</a>';
				$num_notificaciones++;
			}
		} else {
			// Si no hay resultados, no imprimir nada
		}
		?>
            <?php
		// Crear una consulta SQL para seleccionar los productos con cantidad menor al stock límite
		$sql6 = "SELECT * FROM bandas WHERE cant < stock_limite";
		
		// Ejecutar la consulta
		$resultado6 = $conexion->query($sql6);
		
		// Verificar si hay resultados
		if ($resultado6->num_rows > 0) {
			// Si hay resultados, imprimir la notificación correspondiente para cada producto y aumentar el número de notificaciones no leídas
			while ($fila = $resultado6->fetch_assoc()) {
				echo '<a href="#" class="Notification" id="notifation-unread-3'.$fila['id'].'">
					<div class="Notification-icon"><i class="zmdi zmdi-alert-triangle bg-info"></i></div>
					<div class="Notification-text">
						<p><strong>'.$fila['Descripcion'].' con stock menor a '.$fila['stock_limite'].'</strong></p>
					</div>
					<div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-3'.$fila['id'].'">BANDAS</div> 
				</a>';
				$num_notificaciones++;
			}
		} else {
			// Si no hay resultados, no imprimir nada
		}
		?>
            
            <?php
		// Crear una consulta SQL para seleccionar los productos con cantidad menor al stock límite
		$sql7 = "SELECT * FROM tapas WHERE cantidad < stock_limite";
		
		// Ejecutar la consulta
		$resultado7 = $conexion->query($sql7);
		
		// Verificar si hay resultados
		if ($resultado7->num_rows > 0) {
			// Si hay resultados, imprimir la notificación correspondiente para cada producto y aumentar el número de notificaciones no leídas
			while ($fila = $resultado7->fetch_assoc()) {
				echo '<a href="#" class="Notification" id="notifation-unread-4'.$fila['id'].'">
					<div class="Notification-icon"><i class="zmdi zmdi-alert-triangle bg-info"></i></div>
					<div class="Notification-text">
						<p><strong>'.$fila['Descripcion'].' con stock menor a '.$fila['stock_limite'].'</strong></p>
					</div>
					<div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-4'.$fila['id'].'">TAPAS</div> 
				</a>';
				$num_notificaciones++;
			}
		} else {
			// Si no hay resultados, no imprimir nada
		}
		?>
         ?>
            
            <?php
		// Crear una consulta SQL para seleccionar los productos con cantidad menor al stock límite
		$sql8 = "SELECT * FROM embalaje WHERE cant < stock_limite";
		
		// Ejecutar la consulta
		$resultado8 = $conexion->query($sql8);
		
		// Verificar si hay resultados
		if ($resultado8->num_rows > 0) {
			// Si hay resultados, imprimir la notificación correspondiente para cada producto y aumentar el número de notificaciones no leídas
			while ($fila = $resultado8->fetch_assoc()) {
				echo '<a href="#" class="Notification" id="notifation-unread-5'.$fila['id'].'">
					<div class="Notification-icon"><i class="zmdi zmdi-alert-triangle bg-info"></i></div>
					<div class="Notification-text">
						<p><strong>'.$fila['Descripcion'].' con stock menor a '.$fila['stock_limite'].'</strong></p>
					</div>
					<div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-5'.$fila['id'].'">EMBALAJE</div> 
				</a>';
				$num_notificaciones++;
			}
		} else {
			// Si no hay resultados, no imprimir nada
		}
		?>
               <?php
		// Crear una consulta SQL para seleccionar los productos con cantidad menor al stock límite
		$sql9 = "SELECT * FROM etiquetas WHERE cant < stock_limite";
		
		// Ejecutar la consulta
		$resultado9 = $conexion->query($sql9);
		
		// Verificar si hay resultados
		if ($resultado9->num_rows > 0) {
			// Si hay resultados, imprimir la notificación correspondiente para cada producto y aumentar el número de notificaciones no leídas
			while ($fila = $resultado9->fetch_assoc()) {
				echo '<a href="#" class="Notification" id="notifation-unread-6'.$fila['id'].'">
					<div class="Notification-icon"><i class="zmdi zmdi-alert-triangle bg-info"></i></div>
					<div class="Notification-text">
						<p><strong>'.$fila['Descripcion'].' con stock menor a '.$fila['stock_limite'].'</strong></p>
					</div>
					<div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-6'.$fila['id'].'">ETIQUETAS</div> 
				</a>';
				$num_notificaciones++;
			}
		} else {
			// Si no hay resultados, no imprimir nada
		}
		?>
            
               <?php
		// Crear una consulta SQL para seleccionar los productos con cantidad menor al stock límite
		$sql10 = "SELECT * FROM colgantes WHERE cant < stock_limite";
		
		// Ejecutar la consulta
		$resultado10 = $conexion->query($sql10);
		
		// Verificar si hay resultados
		if ($resultado10->num_rows > 0) {
			// Si hay resultados, imprimir la notificación correspondiente para cada producto y aumentar el número de notificaciones no leídas
			while ($fila = $resultado10->fetch_assoc()) {
				echo '<a href="#" class="Notification" id="notifation-unread-7'.$fila['id'].'">
					<div class="Notification-icon"><i class="zmdi zmdi-alert-triangle bg-info"></i></div>
					<div class="Notification-text">
						<p><strong>'.$fila['Descripcion'].' con stock menor a '.$fila['stock_limite'].'</strong></p>
					</div>
					<div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-7'.$fila['id'].'">COLGANTES</div> 
				</a>';
				$num_notificaciones++;
			}
		} else {
			// Si no hay resultados, no imprimir nada
		}
		?>                            
    </section>
</section>

<!-- navLateral -->

<div class="full-width navBar">
		<div class="full-width navBar-options">
			<i class="zmdi zmdi-more-vert btn-menu" id="btn-menu"></i>	
			<div class="mdl-tooltip" for="btn-menu">Menu</div>
			<nav class="navBar-options-list">
				<ul class="list-unstyle">
					<li class="btn-Notification" id="notifications"> 
						<i class="zmdi zmdi-notifications"> <?php if ($num_notificaciones > 0) { ?>
    <span class="Notification-number"><?php echo $num_notificaciones; ?></span>
  <?php } ?></i>
						<!-- <i class="zmdi zmdi-notifications-active btn-Notification" id="notifications"></i> -->
						<div class="mdl-tooltip" for="notifications">Notificaciones</div>
					</li>
					<li class="btn-exit" id="btn-exit">
						<i class="zmdi zmdi-power"></i>
						<div class="mdl-tooltip" for="btn-exit">Salir</div>
					</li>
					<li class="text-condensedLight noLink" ><small> <?php echo htmlspecialchars($nombre_completo); ?></small></li>
					<li class="noLink">
						<figure>
						<img src="<?php echo $ruta_imagen; ?>" alt="Foto de perfil del usuario" class="img-responsive">

						</figure>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<!-- navLateral -->
	<section class="full-width navLateral">
		<div class="full-width navLateral-bg btn-menu"></div>
		<div class="full-width navLateral-body">
			<div class="full-width navLateral-body-logo text-center tittles">
				<i class="zmdi zmdi-close btn-menu"></i> Inventario
			</div>
			<figure class="full-width" style="height: 77px;">
				<div class="navLateral-body-cl">
				<img src="<?php echo $ruta_imagen; ?>" alt="Foto de perfil del usuario" class="img-responsive">
				</div>
				<figcaption class="navLateral-body-cr hide-on-tablet">
					<span>
					<span>Usuario: <?php echo htmlspecialchars($nombre_completo); ?> <br>
					</span>
				</figcaption>
			</figure>
			<nav class="full-width">
				<ul class="full-width list-unstyle menu-principal">
					<li class="full-width">
						<a href="home.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-home"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								INICIO
							</div>
						</a>
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-hospital-alt"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								PRODUCCION
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
							<li class="full-width">
								<a href="productnew.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-hospital-alt"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Nueva Produccion
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="product1.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-label"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Producciones en Fase 1
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="product2.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-label"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Producciones en Fase 2
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="product3.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-label"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Producciones en Envasado
									</div>
								</a>
							</li>
						</ul>
					</li>
					
					<li class="full-width divider-menu-h"></li>
					 <li class="full-width">
							 <a href="parametros.php" class="full-width">
							 <div class="navLateral-body-cl">
								<i class="zmdi zmdi-cocktail"></i>
							 </div>
							 <div class="navLateral-body-cr hide-on-tablet">
								PARAMETROS
							 </div>
						     </a>
					    </li>
                    </li>
					<li class="full-width divider-menu-h"></li>
					    <li class="full-width">
						    <a href="ADMIN.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-face"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								ADMINISTRACION
							</div>  
						    </a>
						</li>		
					</li>	
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-camera-switch"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								INGRESOS Y SALIDAS
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
							<li class="full-width">
						    <a href="producfin.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-assignment-check"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								Producto Terminado
							</div>
						    </a>
							</li>
							<li class="full-width">
						     <a href="envases.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-battery"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								Envases
							</div>
						    </a>
					        </li>
							<li class="full-width">
						    <a href="embalaje.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-card-giftcard"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								Embalaje
							</div>
						    </a>
					        </li>
							<li class="full-width">
						    <a href="etiquetas.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-file"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								Etiquetas
							</div>
						    </a>
					        </li>
							<li class="full-width">
						    <a href="colgantes.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-receipt"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								Colgantes
							</div>
						    </a>
					        </li>
							<li class="full-width">
						    <a href="tapas.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-album"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								Tapas
							</div>
						    </a>
					        </li>
							<li class="full-width">
						    <a href="bandas.php" class="full-width">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-check-all"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								Bandas de Seguridad
							</div>
						    </a>
					        </li>
						</ul>
					</li>
	
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-file-text"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								INVENTARIOS
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
							<li class="full-width">
								<a href="inventario_pt.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-file-text"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Producto Terminado
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="inventario_e.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-file-text"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Envases y Embalaje
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="inventario_ec.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-file-text"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Etiquetas y Colgantes
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="inventario_tb.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-file-text"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Tapas y Bandas
									</div>
								</a>
							</li>
						</ul>	
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-window-maximize"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								HISTORIAL
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
							<li class="full-width">
								<a href="historial_pl.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-window-maximize"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Producto Terminado y Lotes
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="historial_e.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-window-maximize"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Envases y Embalaje
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="Historial_ec.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-window-maximize"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Etiquetas y Colgantes
									</div>
								</a>
							</li>
							<li class="full-width">
                            <a href="Historial_tb.php" class="full-width">
                                <div class="navLateral-body-cl">
                                    <i class="zmdi zmdi-window-maximize"></i>
                                </div>
                                <div class="navLateral-body-cr hide-on-tablet">
                                    Tapas y Bandas
                                </div>
                            </a>
                        </li>
                        <li class="full-width">
                            <a href="Historial_ep.php" class="full-width">
                                <div class="navLateral-body-cl">
                                    <i class="zmdi zmdi-window-maximize"></i>
                                </div>
                                <div class="navLateral-body-cr hide-on-tablet">
                                    Envasado y Parametros
                                </div>
                            </a>
                        </li>
						</ul>	
					</li>
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-calendar-note"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								PEDIDOS
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
							<li class="full-width">
								<a href="generar_o.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-calendar-note"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Generar Orden Despacho
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="completar_o.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-calendar-note"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Completar Orden Despacho
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="reparto.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-calendar-note"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Pedidos en Reparto
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="historial_o.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-calendar-note"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Historial Orden Despacho
									</div>
								</a>
							</li>
						</ul>
					</li>
					
					<li class="full-width divider-menu-h"></li>
					<li class="full-width">
						<a href="#!" class="full-width btn-subMenu">
							<div class="navLateral-body-cl">
								<i class="zmdi zmdi-truck"></i>
							</div>
							<div class="navLateral-body-cr hide-on-tablet">
								RUTA
							</div>
							<span class="zmdi zmdi-chevron-left"></span>
						</a>
						<ul class="full-width menu-principal sub-menu-options">
							<li class="full-width">
								<a href="generar_r.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-truck"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Generar Ruta
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="completar_r.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-truck"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Completar Ruta
									</div>
								</a>
							</li>
							<li class="full-width">
								<a href="historial_r.php" class="full-width">
									<div class="navLateral-body-cl">
										<i class="zmdi zmdi-truck"></i>
									</div>
									<div class="navLateral-body-cr hide-on-tablet">
										Historial Rutas
									</div>
								</a>
							</li>
						</ul>
							
					<li class="full-width divider-menu-h"></li>
					 <li class="full-width">
							 <a href="Facturacion.php" class="full-width">
							 <div class="navLateral-body-cl">
								<i class="zmdi zmdi-assignment-check"></i>
							 </div>
							 <div class="navLateral-body-cr hide-on-tablet">
								FACTURACION
							 </div>
						     </a>
					    </li>
                    </li>
					</li>
				</ul>	
			</nav>
		</div>
	</section>


<section class="full-width pageContent">
    <section class="full-width header-well">
        <div class="full-width header-well-icon">
            <figure class="full-width">
                    <img src="assets/img/nuevologo.jpeg" alt="LOGO" class="img-responsive">
            </figure>
            <div class="full-width header-well-text">
            <p class="text-condensedLight">
                 GENERAR ORDEN
            </p>
        </div>						
</section>
<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
                <div class="full-width panel mdl-shadow--2dp">
					
				<form method="POST" action="guardarorden.php">
                    <div class="full-width panel-tittle bg-primary text-center tittles">
                       ORDEN DE DESPACHO NO.
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
					
                        <input class="mdl-textfield__input text-center" type="text" readonly value="<?php echo $new_order_number; ?>"name="numero_orden" id="numero_orden">
                        <label class="mdl-textfield__label text-center" for="numero_orden"></label>
                        <span class="mdl-textfield__error">Número de orden invalido</span>
					</div>
                    <div class="full-width panel-content">
                            <div class="mdl-grid">
                                <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                    <h5 class="text-condensedLight text-center">Cite-Barbosa-Santander-Colombia</h5>
                                    <h5 class="text-condensedLight text-center">Tel: 3212287588</h5>
                                    
                                    <div class="mdl-textfield mdl-js-textfield">
                                        
										<label for="fecha">Fecha : </label>
										
                                        <input type="date" name="fecha" id="fecha" value="<?php echo date('Y-m-d'); ?>" />
										

										<h6 class="text-condensedLight">Cliente</h6>
												<?php
												echo "<select name='opciones' id='opciones'>";
												while ($fila = mysqli_fetch_assoc($resultado)) {
													echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
												}
												echo "</select>";
												?>

                                        <h6 class="text-condensedLight">Direccion
                                            <input class="mdl-textfield__input" type="text" name="dir" id="dir" readonly>
                                        <span class="mdl-textfield__error">Nombre Invalio</span>
                                        </h6>
                                        <h6 class="text-condensedLight">Ciudad
                                            <input class="mdl-textfield__input" type="text"  name="ciudad" id="ciudad" readonly>
                                        <span class="mdl-textfield__error">Nombre Invalio</span>
                                        </h6>
										<h6 class="text-condensedLight">Email
                                            <input class="mdl-textfield__input" type="text" name="email" id="email" readonly>
                                        <span class="mdl-textfield__error">Nombre Invalio</span>
                                        </h6>
                                        <h6 class="text-condensedLight"># de Cajas
                                            <input class="mdl-textfield__input" type="number" step="0.0000001" name="cajas" id="cajas">
                                        <span class="mdl-textfield__error">Numero Invalio</span>
                                        </h6>
										<h6 class="text-condensedLight">Modo de Pago
    <select class="mdl-textfield__input" name="pago" id="pago">
        <option value="" disabled="" selected="">...</option>
        <option value="contra_entrega">Contra Entrega</option>
        <option value="realizar_pago">Realizar Pago</option>
    </select>
</h6>
<h6 class="text-condensedLight">Embalaje
    <select class="mdl-textfield__input" name="embalaje" id="embalaje">
        <option value="" disabled="" selected="">...</option>
        <option value="libre">Libre</option>
        <option value="cabulla">Cabulla</option>
        <option value="otros">Otros</option>
        <option value="zuncho">Zuncho</option>
    </select>
</h6>
                                    </div>
                                   
                                </div>
                                <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                    <figure class="full-width">
                                        <img src="assets/img/nuevologo.jpeg" alt="LOGO" class="img-responsive">
                                    </figure>
                                    <div class="mdl-textfield mdl-js-textfield">
                                        <h6 class="text-condensedLight">Cedula
                                            <input class="mdl-textfield__input" type="number" step="0.0000001" name="cedula" id="cedula" readonly>
                                        <span class="mdl-textfield__error">Numero Invalio</span>
                                        </h6>
                                        <h6 class="text-condensedLight">Celular
                                            <input class="mdl-textfield__input" type="number" step="0.0000001" name="cel" id="cel" readonly>
                                        <span class="mdl-textfield__error">Numero Invalio</span>
                                        </h6>

										<h6 class="text-condensedLight">Creador:  
											<input class="mdl-textfield__input" type="text" name="creador" id="creador" value="<?php echo $nombre_completo ?>" readonly>
											</h6>
                                        <h6 class="text-condensedLight">Responsable
                                            <input class="mdl-textfield__input" type="text"  id="Responsable">
                                        <span class="mdl-textfield__error">Nombre Invalio</span>
                                        </h6>
										<h6 class="text-condensedLight">Transportadora
    <select class="mdl-textfield__input" name="transportadora" id="transportadora">
        <option value="" disabled="" selected="">...</option>
        <option value="interrapidisimo">Interrapidisimo</option>
        <option value="servientrega">Servientrega</option>
        <option value="redetrans">RedeTrans</option>
        <option value="otros">Otros</option>
        <option value="envia">Envia</option>
    </select>
</h6>

                                            <h6 class="text-condensedLight">Notas
                                                <input class="mdl-textfield__input" type="text" name="Notas" id="Notas">
                                            <span class="mdl-textfield__error">Texto Invalio</span>
                                            </h6>
                                    </div>
                                </div>
                            </div>
							
							<table id="tabla-productos" class="mdl-data-table mdl-js-data-table mdl-shadow--2dp full-width table-responsive">
		<thead>
			<tr>
			</tr>
		</thead>
		<tbody>
			<!-- Aquí se mostrarán los productos -->
		</tbody>
	</table>
                            <p class="text-center">
                                <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" type="submit" onclick="agregarProducto()" id="btn-addProduct">
								<i class="zmdi zmdi-plus"></i>
                                    <div class="mdl-tooltip" for="btn-addProduct">Agregar Producto</div>
                                </button>
								<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" type="submit" onclick="eliminarProducto()" id="eliminar">
								<i class="zmdi zmdi-minus-circle"></i>
                                    <div class="mdl-tooltip" for="eliminar">Eliminar Producto</div>
                                </button>
                             
                             
                                <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" type="submit" id="btn-generar">
                                    <i class="zmdi zmdi-check-all"></i>
                                    <div class="mdl-tooltip" for="btn-generar">Generar Orden</div>
                                </button>
								<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" type="submit" onclick="generarGuia()" id="btn-guia">
    <i class="zmdi zmdi-collection-text"></i>
    <div class="mdl-tooltip" for="btn-guia">Crear Guia</div>
</button>
<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" type="submit" onclick="abrirVentana()" id="CrearProducto">
    <i class="zmdi zmdi-account-add"></i>
    <div class="mdl-tooltip" for="CrearProducto">Crear Nuevo Cliente</div>
</button>

                            </p>
                        </form>
                    </div>
                </div>
            </div>
</div>

<script>
function actualizarTabla() {
    const numeroOrden = document.getElementById("numero_orden").value; // Obtener el número de orden ingresado por el usuario
const url = `actualizar_tabla.php?numero_orden=${numeroOrden}`; // Agregar el número de orden como parámetro en la URL
fetch(url)
    .then(response => response.text())
    .then(data => {
        // actualizar la tabla con la respuesta recibida
        document.getElementById("tabla-productos").innerHTML = data;
    })
    .catch(error => console.error(error));

}
</script>
<script>
	function generarGuia() {
		event.preventDefault();
  // Mostrar prompt y obtener número de orden
  var numeroOrden = prompt("Ingrese el número de orden para generar la guía:");

  // Validar que se ingresó un número de orden
  if (numeroOrden != null && numeroOrden.trim() != "") {
    // Redirigir a la página de generación de guía con el número de orden como parámetro GET
    window.location.href = "generarguia.php?orden=" + encodeURIComponent(numeroOrden);
  }
}
</script>
<script>
	function agregarProducto() {
    // Bloquear el envío del formulario
    event.preventDefault();

    var ventana = window.open("", "Nueva ventana", "width=600,height=400");
  

    // Insertar HTML en la ventana
    ventana.document.write(`
        <head>
            <link rel="stylesheet" href="css/normalize.css">
            <link rel="stylesheet" href="css/sweetalert2.css">
            <link rel="stylesheet" href="css/material.min.css">
            <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
            <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
            <link rel="stylesheet" href="css/main.css">
        </head>
        <body>
            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
                    <div class="full-width panel mdl-shadow--2dp">
                        <form method="post" action="generar_orden.php">
                            <label class="text-condensedLight" for="producto">Producto:</label>
                            <?php
                                echo "<select name='producto' id='producto'>";
                                while ($fila = mysqli_fetch_assoc($resultado1)) {
                                    echo "<option value='".$fila['Descripcion']."'>".$fila['Descripcion']."</option>";
                                }
                                echo "</select>";
                            ?>

                            <label class="text-condensedLight" for="cantidad">Cantidad:</label>
                            <input type="number" name="cantidad" min="1" max="1000000000">
							 <label class="text-condensedLight" for="numero_orden">Numero Orden</label>
							<input type="text" readonly value="<?php echo $new_order_number; ?>"name="numero_orden" id="numero_orden">
                       
                        
                            <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" style="margin-left: 140px;" id="CrearProducto">
                                <i class="zmdi zmdi-shopping-cart-plus"></i>
                                <div class="mdl-tooltip" for="CrearProducto">Agregar Producto</div>
                            </button>
							
                        </form>
                    </div>
                </div>
            </div>
        </body>
    `);
	actualizarTabla();
}


</script>
<script>
 function eliminarProducto() {
    // Bloquear el envío del formulario
    event.preventDefault();

    var ventana = window.open("", "Nueva ventana", "width=600,height=400");

    // Obtener los datos del servidor usando AJAX
    fetch('consultasql.php')
        .then(response => response.json())
        .then(data => {
            var opciones = "";
            data.forEach(fila => {
                opciones += "<option value='" + fila.producto + "'>" + fila.producto + "</option>";
            });

            // Insertar el resultado en el elemento <select> en el documento HTML
            var select = ventana.document.getElementById("producto");
            select.innerHTML = opciones;

            // Esperar a que la ventana abierta haya cargado completamente
            ventana.addEventListener("load", function() {
                
            });
        });

    // Insertar HTML en la ventana
    ventana.document.write(`
        <head>
            <link rel="stylesheet" href="css/normalize.css">
            <link rel="stylesheet" href="css/sweetalert2.css">
            <link rel="stylesheet" href="css/material.min.css">
            <link rel="stylesheet" href="css/material-design-iconic-font.min.css">
            <link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
            <link rel="stylesheet" href="css/main.css">
        </head>
        <body>
            <div class="mdl-grid">
                <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
                    <div class="full-width panel mdl-shadow--2dp">
                        <form method="post" action="eliminarproducto.php">
                            <label class="text-condensedLight" for="producto">Producto:</label>
                            <select name='producto' id='producto'></select>
                            <label class="text-condensedLight" for="numero_orden">Numero Orden</label>
                            <input type="text" readonly value="<?php echo $new_order_number; ?>" name="numero_orden" id="numero_orden">
                            <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" style="margin-left: 140px;" id="eliminarProducto">
                                <i class="zmdi zmdi-minus-circle"></i>
                                <div class="mdl-tooltip" for="eliminarProducto">Eliminar Producto</div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </body>
    `);actualizarTabla();
}

</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
  var button = document.getElementById("btn-generar"); 

  button.addEventListener('click', function(){
    notify();
  });

  function notify (){
	
	var numorden = document.getElementById("numero_orden").value;
    if (!("Notification" in window)){
      alert("Tu navegador no soporta notificaciones");
    } else if (Notification.permission === "granted"){
      var notification = new Notification("Nueva orden Generada: "+numorden);

    } else if (Notification.permission === "denied"){
      Notification.requestPermission(function(permission){
        if (Notification.permission === "granted"){
          var notification = new Notification ("Hola mundo");
        }
      });
    }
  }
});

</script>
<script>
function abrirVentana() {
	
    // Bloquear el envío del formulario
    event.preventDefault()
  // Abrir ventana emergente
  var ventana = window.open("", "Nueva ventana", "width=400,height=400");
  

  // Insertar HTML en la ventana
  ventana.document.write(`
  
  <head>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/sweetalert2.css">
	<link rel="stylesheet" href="css/material.min.css">
	<link rel="stylesheet" href="css/material-design-iconic-font.min.css">
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="css/main.css">
</head>

<div class="mdl-grid">
				<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
					<div class="full-width panel mdl-shadow--2dp">

    <form method="post" action="insertar_cliente.php">

      <label>Nombre:</label>
      <input type="text" name="nombre"><br><br>
      <label>Cedula:</label>
      <input type="number" name="cedula"><br><br>
      <label>Celular:</label>
      <input type="number" name="cel"><br><br>
      <label>Email:</label>
      <input type="text" name="email"><br><br>
      <label>Ciudad:</label>
      <input type="text" name="ciudad"><br><br>
      <label>Direccion:</label>
      <input type="text" name="dir"><br><br>

	  <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" style="margin-left: 155px;" id="CrearProducto">
										<i class="zmdi zmdi-shopping-cart-plus"></i>
										<div class="mdl-tooltip" for="CrearProducto">Crear Nuevo Cliente</div>
									</button>
    </form>
	</div>
	</div>
	</div>

  `);
}
</script>
</body>
</html> 