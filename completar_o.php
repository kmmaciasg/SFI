<?php
use Sabberworm\CSS\Value\Value;
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
	$permiso = 'completar orden';
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
<head>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Completar Orden</title>
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
<body>
	
	
<?php
include 'conexion_db.php';


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
	<form action="enviarsubir.php" method="post">
        <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
            <div class="full-width panel mdl-shadow--2dp">
                <div class="full-width panel-tittle bg-primary text-center tittles">
                   ORDEN DE DESPACHO NO.
                </div>
                <div class="mdl-textfield mdl-js-textfield ">
				<input class="mdl-textfield__input text-center" type="text" name="numero_orden" id="numero_orden" placeholder="Ingresa el número de orden"> </div>
				
                <div class="full-width panel-content">
                    
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                <h5 class="text-condensedLight text-center">Cite-Barbosa-Santander-Colombia</h5>
                                <h5 class="text-condensedLight text-center">Tel: 3212287588</h5>
                                
                                <div class="mdl-textfield mdl-js-textfield">
                                    <h6 class="text-condensedLight">Fecha
                                        <input type="date" name="fecha" id="fecha" class="mdl-textfield__input" readonly>
                                    </h6>

                                    <h6 class="text-condensedLight">Cliente
                                        <input class="mdl-textfield__input" type="text" name="opciones" id="opciones" readonly>
                                    <span class="mdl-textfield__error">Nombre Invalio</span>
                                    </h6>

                                    <h6 class="text-condensedLight">Direccion
                                        <input class="mdl-textfield__input" type="text"  name="dir" id="dir" readonly>
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
                                        <input class="mdl-textfield__input" type="number" step="0.0000001"  name="cajas" id="cajas">
                                    <span class="mdl-textfield__error">Numero Invalio</span>
									</h6>
                                        
                                        <h6 class="text-condensedLight">Modo de Pago
                                        <input class="mdl-textfield__input" type="text" name="pago" id="pago" readonly>
                                         <span class="mdl-textfield__error">Nombre Invalio</span>
                                    </h6>
                                    
                                        
                                    <h6 class="text-condensedLight">Embalaje
                                        <input class="mdl-textfield__input" type="text"  name="embalaje" id="embalaje" readonly>
                                     <span class="mdl-textfield__error">Nombre Invalio</span>
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
                                        <input class="mdl-textfield__input" type="number" step="0.0000001"  name="cel" id="cel" readonly>
                                    <span class="mdl-textfield__error">Numero Invalio</span>
                                    </h6>

                                    <h6 class="text-condensedLight">Creador
                                        <input class="mdl-textfield__input" type="text"  name="creador" id="creador" readonly>
                                    <span class="mdl-textfield__error">Nombre Invalio</span>
                                    </h6>
                                    <h6 class="text-condensedLight">Responsable
                                        <input class="mdl-textfield__input" type="text"  name="responsable" id="responsable" value="<?php echo $nombre_completo ?>">
                                    <span class="mdl-textfield__error">Nombre Invalio</span>
                                    </h6>
                                    <h6 class="text-condensedLight">Transportadora
                                        <input class="mdl-textfield__input" type="text"  name="transportadora" id="transportadora" readonly>
                                    <span class="mdl-textfield__error">Nombre Invalio</span>
                                    </h6>
                                        <h6 class="text-condensedLight">Notas
                                            <input class="mdl-textfield__input" type="text"  name="notas" id="notas" readonly>
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
						
						<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" id="generate-pdf" type="submit">
                                <i class="zmdi zmdi-check-all"></i>
								
								<div class="mdl-tooltip" for="generate-pdf">Finalizar Orden</div>
                            </button>
							<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" id="generate-producto" type="button" onclick="agregarProducto()">
                                <i class="zmdi zmdi-refresh"></i>
								
								<div class="mdl-tooltip" for="generate-producto">Editar Lotes</div>
                            </button>
                        </p>  
                </div>
            </div>
        </div>
	</form>
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
// Capturamos el input de texto
const inputNumeroOrden = document.getElementById('numero_orden');
inputNumeroOrden.addEventListener('keydown', function (event) {
  if (event.key === 'Enter') {
    event.preventDefault();
    const numeroOrden = inputNumeroOrden.value;
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'obtener_datos.php');
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function () {
      if (xhr.status === 200) {
        const datosOrden = JSON.parse(xhr.responseText);
        // Mostramos los datos correspondientes a la orden en los inputs de texto correspondientes
        document.getElementById('opciones').value = datosOrden.cliente;
        document.getElementById('fecha').value = datosOrden.fecha;
        document.getElementById('cajas').value = datosOrden.cajas;
        document.getElementById('pago').value = datosOrden.pago;
        document.getElementById('embalaje').value = datosOrden.embalaje;
        document.getElementById('creador').value = datosOrden.creador;
        document.getElementById('transportadora').value = datosOrden.transportadora;
        document.getElementById('notas').value = datosOrden.notas;
		 // Mostramos los datos correspondientes al cliente en los inputs de texto correspondientes
		 document.getElementById('cedula').value = datosOrden.cedula;
        document.getElementById('cel').value = datosOrden.cel;
        document.getElementById('email').value = datosOrden.email;
        document.getElementById('ciudad').value = datosOrden.ciudad;
        document.getElementById('dir').value = datosOrden.dir;
		actualizarTabla();
		
      } else {
        
      }
	  
    };
    xhr.onerror = function () {
    };
    xhr.send('numeroOrden=' + encodeURIComponent(numeroOrden));
  }
} );
</script>
<script>
		function agregarProducto() {
			event.preventDefault();
			var numero_orden = document.getElementById("numero_orden").value;
			var ventana = window.open("ventana_emergente.php?numero_orden=" + numero_orden, "Nueva ventana", "width=600,height=400");
			ventana.focus();
		}
	</script>


<script>
document.addEventListener("DOMContentLoaded", function() {
	
  var button = document.getElementById("generate-pdf"); 

  button.addEventListener('click', function(){
    notify();
  });

  function notify (){
	
	var numorden = document.getElementById("numero_orden").value;
    if (!("Notification" in window)){
      alert("Tu navegador no soporta notificaciones");
    } else if (Notification.permission === "granted"){
      var notification = new Notification("Nueva orden Completada: "+numorden);

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
</body>
</html> 

