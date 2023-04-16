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
					<li class="text-condensedLight noLink" ><small>Nombre de Usuario</small></li>
					<li class="noLink">
						<figure>
							<img src="assets/img/avatar-male2.png" alt="Avatar" class="img-responsive">
						</figure>
					</li>
				</ul>
			</nav>
		</div>
	</div>

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
                 COMPLETAR ORDEN
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
                                        <input class="mdl-textfield__input" type="number" step="0.0000001"  name="cajas" id="cajas" readonly>
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
                                            <input class="mdl-textfield__input" type="text"  name="notas" id="notas">
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
                            </button>
                            <div class="mdl-tooltip" for="generate-pdf">Finalizar Orden</div>
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
		 // Mostramos los datos correspondientes al cliente en los inputs de texto correspondientes
		 document.getElementById('cedula').value = datosOrden.cedula;
        document.getElementById('cel').value = datosOrden.cel;
        document.getElementById('email').value = datosOrden.email;
        document.getElementById('ciudad').value = datosOrden.ciudad;
        document.getElementById('dir').value = datosOrden.dir;
		actualizarTabla();
      } else {
        console.error(xhr.statusText);
      }
    };
    xhr.onerror = function () {
      console.error(xhr.statusText);
    };
    xhr.send('numeroOrden=' + encodeURIComponent(numeroOrden));
  }
});
</script>
</body>
</html> 

