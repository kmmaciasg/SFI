
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Administrador</title>
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
session_start(); // Iniciar sesión
    if(isset($_SESSION['nombre_usuario'])){ // Comprobar si se ha iniciado sesión
        $nombre_usuario = $_SESSION['nombre_usuario']; // Obtener el nombre de usuario guardado en la sesión
        $apellido_usuario = $_SESSION['apellido_usuario']; // Obtener el apellido de usuario guardado en la sesión
       
		
// Concatenar el nombre y apellido en una sola cadena de texto
$nombre_completo = $nombre_usuario . " " . $apellido_usuario;
    } else {
        header("Location: index.php"); // Si no se ha iniciado sesión, redirigir al inicio de sesión
    }
	
	// código para procesar los permisos
	
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
	

// Consulta SQL para obtener los datos
$sql = "SELECT tipo FROM usuarios";

// Ejecutar la consulta
$resultado = mysqli_query($conexion, $sql);



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
        <a href="#" class="Notification" id="notifation-unread-1">
            <div class="Notification-icon"><i class="zmdi zmdi-alert-triangle bg-info"></i></div>
            <div class="Notification-text">
                <?php
                // Crear una consulta SQL para seleccionar los productos con cantidad menor a 250
                $sql4 = "SELECT * FROM productos WHERE Cantidad < 250";

                // Ejecutar la consulta
                $resultado4 = $conexion->query($sql4);

                // Verificar si hay resultados
                if ($resultado4->num_rows > 0) {
                  // Si hay resultados, imprimir el mensaje en negrita y aumentar el número de notificaciones no leídas
                  echo '<p><strong>Productos terminados con stock menor a 250</strong></p>';
                  $num_notificaciones++;
                } else {
                  // Si no hay resultados, no imprimir nada
                }
                ?>
            </div>
            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-1">Notification no leida</div> 
        </a>  
		<a href="#" class="Notification" id="notifation-unread-2">
            <div class="Notification-icon"><i class="zmdi zmdi-alert-triangle bg-info"></i></div>
            <div class="Notification-text">
                <?php
                // Crear una consulta SQL para seleccionar los productos con cantidad menor a 250
                $sql5 = "SELECT * FROM bandas WHERE cant < 250";

                // Ejecutar la consulta
                $resultado5 = $conexion->query($sql5);

                // Verificar si hay resultados
                if ($resultado5->num_rows > 0) {
                  // Si hay resultados, imprimir el mensaje en negrita y aumentar el número de notificaciones no leídas
                  echo '<p><strong>Bandas de seguridad con stock menor a 250</strong></p>';
                  $num_notificaciones++;
                } else {
                  // Si no hay resultados, no imprimir nada
                }
                ?>
            </div>
            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-2">Notification no leida</div> 
        </a>       
		<a href="#" class="Notification" id="notifation-unread-3">
            <div class="Notification-icon"><i class="zmdi zmdi-alert-triangle bg-info"></i></div>
            <div class="Notification-text">
                <?php
                // Crear una consulta SQL para seleccionar los productos con cantidad menor a 250
                $sql6 = "SELECT * FROM colgantes WHERE cant < 250";

                // Ejecutar la consulta
                $resultado6 = $conexion->query($sql6);

                // Verificar si hay resultados
                if ($resultado6->num_rows > 0) {
                  // Si hay resultados, imprimir el mensaje en negrita y aumentar el número de notificaciones no leídas
                  echo '<p><strong>Colgantes con stock menor a 250</strong></p>';
                  $num_notificaciones++;
                } else {
                  // Si no hay resultados, no imprimir nada
                }
                ?>
            </div>
            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-3">Notification no leida</div> 
        </a> 
		<a href="#" class="Notification" id="notifation-unread-4">
            <div class="Notification-icon"><i class="zmdi zmdi-alert-triangle bg-info"></i></div>
            <div class="Notification-text">
                <?php
                // Crear una consulta SQL para seleccionar los productos con cantidad menor a 250
                $sql7 = "SELECT * FROM embalaje WHERE cant < 100";

                // Ejecutar la consulta
                $resultado7 = $conexion->query($sql7);

                // Verificar si hay resultados
                if ($resultado7->num_rows > 0) {
                  // Si hay resultados, imprimir el mensaje en negrita y aumentar el número de notificaciones no leídas
                  echo '<p><strong>Embalajes con stock menor a 100</strong></p>';
                  $num_notificaciones++;
                } else {
                  // Si no hay resultados, no imprimir nada
                }
                ?>
            </div>
            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-4">Notification no leida</div> 
        </a>
		<a href="#" class="Notification" id="notifation-unread-5">
            <div class="Notification-icon"><i class="zmdi zmdi-alert-triangle bg-info"></i></div>
            <div class="Notification-text">
                <?php
                // Crear una consulta SQL para seleccionar los productos con cantidad menor a 250
                $sql8 = "SELECT * FROM etiquetas WHERE cant < 250";

                // Ejecutar la consulta
                $resultado8 = $conexion->query($sql8);

                // Verificar si hay resultados
                if ($resultado8->num_rows > 0) {
                  // Si hay resultados, imprimir el mensaje en negrita y aumentar el número de notificaciones no leídas
                  echo '<p><strong>Etiquetas con stock menor a 250</strong></p>';
                  $num_notificaciones++;
                } else {
                  // Si no hay resultados, no imprimir nada
                }
                ?>
            </div>
            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-5">Notification no leida</div> 
        </a>  
		<a href="#" class="Notification" id="notifation-unread-6">
            <div class="Notification-icon"><i class="zmdi zmdi-alert-triangle bg-info"></i></div>
            <div class="Notification-text">
                <?php
                // Crear una consulta SQL para seleccionar los productos con cantidad menor a 250
                $sql9 = "SELECT * FROM envases WHERE Cantidad < 250";

                // Ejecutar la consulta
                $resultado9 = $conexion->query($sql9);

                // Verificar si hay resultados
                if ($resultado9->num_rows > 0) {
                  // Si hay resultados, imprimir el mensaje en negrita y aumentar el número de notificaciones no leídas
                  echo '<p><strong>Envases con stock menor a 250</strong></p>';
                  $num_notificaciones++;
                } else {
                  // Si no hay resultados, no imprimir nada
                }
                ?>
            </div>
            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-6">Notification no leida</div> 
        </a> 
		<a href="#" class="Notification" id="notifation-unread-7">
            <div class="Notification-icon"><i class="zmdi zmdi-alert-triangle bg-info"></i></div>
            <div class="Notification-text">
                <?php
                // Crear una consulta SQL para seleccionar los productos con cantidad menor a 250
                $sqll = "SELECT * FROM tapas WHERE cantidad < 250";

                // Ejecutar la consulta
                $resultadol = $conexion->query($sqll);

                // Verificar si hay resultados
                if ($resultadol->num_rows > 0) {
                  // Si hay resultados, imprimir el mensaje en negrita y aumentar el número de notificaciones no leídas
                  echo '<p><strong>Tapas con stock menor a 250</strong></p>';
                  $num_notificaciones++;
                } else {
                  // Si no hay resultados, no imprimir nada
                }
                ?>
            </div>
            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-7">Notification no leida</div> 
        </a>                                
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

	<!-- pageContent -->
	<section class="full-width pageContent">
		<section class="full-width header-well">
			<div class="full-width header-well-icon">
				<figure class="full-width">
						<img src="assets/img/nuevologo.jpeg" alt="LOGO" class="img-responsive">
				</figure>
				<div class="full-width header-well-text">
				<p class="text-condensedLight">
					 ADMINISTRACION
				</p>
			</div>						
	</section>
		<div class="mdl-tabs mdl-js-tabs mdl-js-ripple-effect">
			<div class="mdl-tabs__tab-bar">
				<a href="#tabNewAdmin" class="mdl-tabs__tab is-active">CREAR USUARIO</a>
				<a href="#tabListAdmin" class="mdl-tabs__tab">ASIGNAR TAREAS</a>
			</div>
			<div class="mdl-tabs__panel is-active" id="tabNewAdmin">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-primary text-center tittles">
								Nuevo Usuario
							</div>
							<div class="full-width panel-content">
								<form action= "crearusuario.php" method="POST">
									<div class="mdl-grid">
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" name="Nom" id="Nom">
												<label class="mdl-textfield__label" for="Nom">Nombres</label>
												<span class="mdl-textfield__error">Nombre Invalido</span>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="text" pattern="-?[A-Za-záéíóúÁÉÍÓÚ ]*(\.[0-9]+)?" name="Ape"id="Ape">
												<label class="mdl-textfield__label" for="Ape">Apellidos</label>
												<span class="mdl-textfield__error">Nombre Invalido</span>
											</div>
											
										
												<h6 class="text-condensedLight">Fecha Nacimiento
													
												<input class="mdl-textfield__input" type="Date" name="FechaNacimiento" id="FechaNacimiento">
												<label class="mdl-textfield__label" for="FechaNacimiento"></label>
												<span class="mdl-textfield__error">Fecha Invalida</span>
												</h6>
											
										</div>
										<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="tel" pattern="-?[0-9+()- ]*(\.[0-9]+)?" name="Cel" id="Cel">
												<label class="mdl-textfield__label" for="Cel">Numero Celular</label>
												<span class="mdl-textfield__error">Numero Invalido</span>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="Number" name="DI" id="DI">
												<label class="mdl-textfield__label" for="DI">Documento de Identidad</label>
												<span class="mdl-textfield__error">Numero Invalido</span>
											</div>
											<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
												<input class="mdl-textfield__input" type="password" name="passwordAdmin" id="passwordAdmin">
												<label class="mdl-textfield__label" for="passwordAdmin">Contraseña</label>
												<span class="mdl-textfield__error">Invalid password</span>
											</div>
											
										</div>
									</div>
									<p class="text-center">
										<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" type="submit" id="NuevoUsuario">
											<i class="zmdi zmdi-plus"></i>
										</button>
										<div class="mdl-tooltip" for="NuevoUsuario">Agregar Usuario</div>
									</p>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="mdl-tabs__panel" id="tabListAdmin">
				<div class="mdl-grid">
					<div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--8-col-desktop mdl-cell--2-offset-desktop">
						<div class="full-width panel mdl-shadow--2dp">
							<div class="full-width panel-tittle bg-success text-center tittles">
								Asignar Permisos
							</div>
							<div class="full-width panel-content">
							
  
  <form action="procesar_permisos.php" method="post">
    <label for="usuario">Seleccione un usuario:</label>
    <select id="usuario" name="usuario">
      <?php
        // código PHP para obtener la lista de usuarios desde la base de datos
        $usuarios = obtener_usuarios();
       // generar opciones de selección para cada usuario con nombre y apellido
  foreach ($usuarios as $usuario) {
    echo '<option value="' . $usuario['num_documento'] . '">' . $usuario['nombres'] . ' ' . $usuario['apellidos'] . '</option>';
  }
  
 
      ?>
    </select>
	<br>
	<br>
    <label >Seleccione una acción:</label>
    
    <input type="radio" id="agregar" name="accion" value="agregar">
    <label for="agregar">Agregar permisos</label>
    
    <input type="radio" id="eliminar" name="accion" value="eliminar">
    <label for="eliminar">Eliminar permisos</label>
    
    <div id="permisos_agregar" style="display: none;">
	<br>
      <p>Seleccione los permisos que desea agregar:</p>
      <?php
        // código PHP para generar las opciones de selección de permisos
        $permisos = obtener_permisos();

        foreach ($permisos as $permiso) {
          echo '<input type="checkbox" id="permiso_' . $permiso['id'] . '" name="permisos[]" value="' . $permiso['id'] . '">';
          echo '<label for="permiso_' . $permiso['id'] . '">' . $permiso['nombre'] . '</label><br>';
        }
      ?>
    </div>
    
    <div id="permisos_eliminar" style="display: none;">
	
	<br>
      <p>Seleccione los permisos que desea eliminar:</p>
	  
    
    </div>
    
	<br>
	<br>
	
	<p class="text-center">
   <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" id="guardar" type="submit">
   <i class="zmdi zmdi-check"></i>
   <div class="mdl-tooltip" for="guardar">Editar Permiso</div>
   </button>
	</p>
  </form>
  <script>
  const selectUsuario = document.getElementById('usuario');
  const radioEliminar = document.getElementById('eliminar');
radioEliminar.addEventListener('change', function () {
  const valorSeleccionado = selectUsuario.value;
  const xhr = new XMLHttpRequest();
  xhr.open('GET', 'buscar_permisos.php?usuario=' + valorSeleccionado);
  xhr.onload = function () {
    if (xhr.status === 200) {
      const permisos = JSON.parse(xhr.responseText);
      // Mostramos la sección permisos_eliminar
      document.getElementById('permisos_eliminar').style.display = 'block';

      // Generamos las opciones de selección de permisos
      let opciones = '';
      permisos.forEach(function (permiso) {
        opciones += '<input type="checkbox" id="permiso_' + permiso.id + '" name="permisos[]" value="' + permiso.id + '">';
        opciones += '<label for="permiso_' + permiso.id + '">' + permiso.nombre + '</label><br>';
      });

      // Actualizamos la sección permisos_eliminar con las opciones generadas
      document.getElementById('permisos_eliminar').innerHTML = opciones;
      console.log(xhr.responseText);
    }
  };
  xhr.send();
});


</script>
  <script>
    // mostrar/ocultar las opciones de selección de permisos según la acción seleccionada
    var agregar = document.getElementById('agregar');
    var eliminar = document.getElementById('eliminar');
    var permisos_agregar = document.getElementById('permisos_agregar');
    var permisos_eliminar = document.getElementById('permisos_eliminar');
    
    agregar.addEventListener('click', function() {
      permisos_agregar.style.display = 'block';
      permisos_eliminar.style.display = 'none';
    });
    
    eliminar.addEventListener('click', function() {
      permisos_agregar.style.display = 'none';
      permisos_eliminar.style.display = 'block';
    });
  </script>
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
function obtener_usuarios() {
  $conexion = conectar_bd();
  
  $query = "SELECT nombres, apellidos, num_documento FROM usuarios";
  $resultado = mysqli_query($conexion, $query);
  
  $usuarios = array();
  
  while ($fila = mysqli_fetch_assoc($resultado)) {
    $usuarios[] = $fila;
  }
  
  mysqli_free_result($resultado);
  mysqli_close($conexion);
  
  return $usuarios;
}

// función para obtener la lista de permisos desde la base de datos
function obtener_permisos() {
  $conexion = conectar_bd();
  
  $query = "SELECT id, nombre FROM permisos";
  $resultado = mysqli_query($conexion, $query);
  
  $permisos = array();
  
  while ($fila = mysqli_fetch_assoc($resultado)) {
    $permisos[] = $fila;
  }
  
  mysqli_free_result($resultado);
  mysqli_close($conexion);
  
  return $permisos;
}

// función para obtener los permisos de un usuario desde la base de datos

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
</body>
</html>
