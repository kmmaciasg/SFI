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
$query = "SELECT numero_orden FROM o_despacho ORDER BY id DESC LIMIT 1";
$resultorden = mysqli_query($conexion, $query);

// Consulta para seleccionar los datos de la tabla "ordenes_despacho"
$sql2 = "SELECT codigo, producto, cantidad, lv, lc FROM ordenes_despacho";
$result = $conexion->query($sql2);

?>
	<!-- Notifications area -->
	<section class="full-width container-notifications">
		<div class="full-width container-notifications-bg btn-Notification"></div>
	    <section class="NotificationArea">
	        <div class="full-width text-center NotificationArea-title tittles">Notifications <i class="zmdi zmdi-close btn-Notification"></i></div>
	        <a href="#" class="Notification" id="notifation-unread-1">
	            <div class="Notification-icon"><i class="zmdi zmdi-accounts-alt bg-info"></i></div>
	            <div class="Notification-text">
	                <p>
	                    <i class="zmdi zmdi-circle"></i>
	                    <strong>New User Registration</strong> 
	                    <br>
	                    <small>Just Now</small>
	                </p>
	            </div>
	        	<div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-1">Notification as UnRead</div> 
	        </a>
	        <a href="#" class="Notification" id="notifation-read-1">
	            <div class="Notification-icon"><i class="zmdi zmdi-cloud-download bg-primary"></i></div>
	            <div class="Notification-text">
	                <p>
	                    <i class="zmdi zmdi-circle-o"></i>
	                    <strong>New Updates</strong> 
	                    <br>
	                    <small>30 Mins Ago</small>
	                </p>
	            </div>
	            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-read-1">Notification as Read</div>
	        </a>
	        <a href="#" class="Notification" id="notifation-unread-2">
	            <div class="Notification-icon"><i class="zmdi zmdi-upload bg-success"></i></div>
	            <div class="Notification-text">
	                <p>
	                    <i class="zmdi zmdi-circle"></i>
	                    <strong>Archive uploaded</strong> 
	                    <br>
	                    <small>31 Mins Ago</small>
	                </p>
	            </div>
	            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-unread-2">Notification as UnRead</div>
	        </a> 
	        <a href="#" class="Notification" id="notifation-read-2">
	            <div class="Notification-icon"><i class="zmdi zmdi-mail-send bg-danger"></i></div>
	            <div class="Notification-text">
	                <p>
	                    <i class="zmdi zmdi-circle-o"></i>
	                    <strong>New Mail</strong> 
	                    <br>
	                    <small>37 Mins Ago</small>
	                </p>
	            </div>
	            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-read-2">Notification as Read</div>
	        </a>
	        <a href="#" class="Notification" id="notifation-read-3">
	            <div class="Notification-icon"><i class="zmdi zmdi-folder bg-primary"></i></div>
	            <div class="Notification-text">
	                <p>
	                    <i class="zmdi zmdi-circle-o"></i>
	                    <strong>Folder delete</strong> 
	                    <br>
	                    <small>1 hours Ago</small>
	                </p>
	            </div>
	            <div class="mdl-tooltip mdl-tooltip--left" for="notifation-read-3">Notification as Read</div>
	        </a>  
	    </section>
	</section>
	<!-- navBar -->
	<!-- navLateral -->
	<div class="full-width navBar">
		<div class="full-width navBar-options">
			<i class="zmdi zmdi-more-vert btn-menu" id="btn-menu"></i>	
			<div class="mdl-tooltip" for="btn-menu">Menu</div>
			<nav class="navBar-options-list">
				<ul class="list-unstyle">
					<li class="btn-Notification" id="notifications">
						<i class="zmdi zmdi-notifications"></i>
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
							<img src="assets/img/avatar-male2.png" alt="Avatar" class="img-responsive">
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
					<img src="assets/img/avatar-male.png" alt="Avatar" class="img-responsive">
				</div>
				<figcaption class="navLateral-body-cr hide-on-tablet">
					<span>
					<span>Usuario: <?php echo htmlspecialchars($nombre_completo); ?><br>
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
						<?php
						if (mysqli_num_rows($resultorden) > 0) {
							$row = mysqli_fetch_assoc($resultorden);
							$last_order_number = $row["numero_orden"];
						  } else {
							// Si no hay ninguna orden en la tabla, establecer el número de orden en 0
							$last_order_number = 0;
						  }
						  
						  // Generar el siguiente número de orden
						  $new_order_number = $last_order_number + 1;
						?>

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
                                                <input class="mdl-textfield__input" type="text"  id="Notas">
                                            <span class="mdl-textfield__error">Texto Invalio</span>
                                            </h6>
                                    </div>
                                </div>
                            </div>
							<?php
							if ($result->num_rows > 0) {
  echo "<table><tr><th>Código</th><th>Producto</th><th>Cantidad</th><th>LV</th><th>LC</th></tr>";
  // Salida de datos de cada fila
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>" . $row["codigo"]. "</td><td>" . $row["producto"]. "</td><td>" . $row["cantidad"]. "</td><td>" . $row["lv"]. "</td><td>" . $row["lc"]. "</td></tr>";
  }echo "</table>";
} else {
  echo "No se encontraron resultados";
}

  ?>
                            <p class="text-center">
                                <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" type="submit" onclick="agregarProducto()" id="btn-addProduct">
								<i class="zmdi zmdi-plus"></i>
                                    <div class="mdl-tooltip" for="btn-addProduct">Agregar Producto</div>
                                </button>
                             
                                <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" type="submit" id="btn-generar">
                                    <i class="zmdi zmdi-check-all"></i>
                                    <div class="mdl-tooltip" for="btn-generar">Generar Orden</div>
                                </button>
                                <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary"  id="btn-guia">
                                    <i class="zmdi zmdi-collection-text"></i>
                                    <div class="mdl-tooltip" for="btn-guia">Crear Guia</div>
                                </button>
								<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" type="submit" onclick="abrirVentana()" id="CrearProducto">
										<i class="zmdi zmdi-account-add"></i>
										<div class="mdl-tooltip" for="CrearProducto">Crear Nuevo Cliente</div>
									</button>
                               
                            </p>
                        </form>
						<!-- Agregar una sección para mostrar la información de la orden de despacho -->
<div id="orden-despacho"></div>
                    </div>
                </div>
            </div>
</div>



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
							<input class="mdl-textfield__input text-center" type="text" readonly value="<?php echo $new_order_number; ?>"name="numero_orden" id="numero:orden">
                        <label class="mdl-textfield__label text-center" for="numero_orden">Numero de Orden</label>
                        
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
}

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