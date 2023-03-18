
<!DOCTYPE html>
<html lang="es">
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
<body>
<?php
include 'conexion_db.php';

// Consulta SQL para obtener los datos
$sql = "SELECT nombre FROM clientes";

// Ejecutar la consulta
$resultado = mysqli_query($conexion, $sql);

// Consulta SQL para obtener los datos
$sql1 = "SELECT descripcion, codigo FROM productos";

// Ejecutar la consulta
$resultado1 = mysqli_query($conexion, $sql1);

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
					<li class="text-condensedLight noLink" ><small>Nombre de Usuario</small></li>
					<li class="noLink">
						<figure>
							<img src="assets/img/avatar-male.png" alt="Avatar" class="img-responsive">
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
                <li class="text-condensedLight noLink" ><small>Nombre de Usuario</small></li>
                <li class="noLink">
                    <figure>
                        <img src="assets/img/avatar-male.png" alt="Avatar" class="img-responsive">
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
						nombre usuario<br>
						<small>tipo usuario</small>
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
                    <div class="full-width panel-tittle bg-primary text-center tittles">
                       ORDEN DE DESPACHO NO.
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input text-center" type="number" pattern="-?[0-9- ]*(\.[0-9]+)?" id="#ORDEN">
                        <label class="mdl-textfield__label text-center" for="#ORDEN"></label>
                        <span class="mdl-textfield__error">Número de orden invalido</span>
                    </div>
                    <div class="full-width panel-content">
                        <form>
                            <div class="mdl-grid">
                                <div class="mdl-cell mdl-cell--4-col-phone mdl-cell--8-col-tablet mdl-cell--6-col-desktop">
                                    <h5 class="text-condensedLight text-center">Cite-Barbosa-Santander-Colombia</h5>
                                    <h5 class="text-condensedLight text-center">Tel: 3212287588</h5>
                                    
                                    <div class="mdl-textfield mdl-js-textfield">
                                        
										<label for="fecha">Fecha : </label>
										
                                        <input type="date" id="fecha" value="<?php echo date('Y-m-d'); ?>" />
										

										<h6 class="text-condensedLight">Cliente</h6>
												<?php
												echo "<select nombre='opciones'>";
												while ($fila = mysqli_fetch_assoc($resultado)) {
													echo "<option value='".$fila['nombre']."'>".$fila['nombre']."</option>";
												}
												echo "</select>";
												?>

                                        <h6 class="text-condensedLight">Direccion
                                            <input class="mdl-textfield__input" type="text"  id="Direccion">
                                        <span class="mdl-textfield__error">Nombre Invalio</span>
                                        </h6>
                                        <h6 class="text-condensedLight">Ciudad
                                            <input class="mdl-textfield__input" type="text"  id="Ciudad">
                                        <span class="mdl-textfield__error">Nombre Invalio</span>
                                        </h6>

                                        <h6 class="text-condensedLight"># de Cajas
                                            <input class="mdl-textfield__input" type="number" step="0.0000001"  id="cajas">
                                        <span class="mdl-textfield__error">Numero Invalio</span>
                                        </h6>
                                        <h6 class="text-condensedLight">Modo de Pago
                                            <select class="mdl-textfield__input">
                                                <option value="" disabled="" selected="">...</option>
                                                <option value="">Contra Entrega</option>
                                                <option value="">Realizar Pago</option>
                                            </select>
                                            </h6>
                                            <h6 class="text-condensedLight">Embalaje
                                                <select class="mdl-textfield__input">
                                                    <option value="" disabled="" selected="">...</option>
                                                    <option value="">Libre</option>
                                                    <option value="">Cabulla</option>
                                                    <option value="">Otros</option>
                                                    <option value="">Zuncho</option>
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
                                            <input class="mdl-textfield__input" type="number" step="0.0000001"  id="Cedula">
                                        <span class="mdl-textfield__error">Numero Invalio</span>
                                        </h6>
                                        <h6 class="text-condensedLight">Celular
                                            <input class="mdl-textfield__input" type="number" step="0.0000001"  id="Celular">
                                        <span class="mdl-textfield__error">Numero Invalio</span>
                                        </h6>

                                        <h6 class="text-condensedLight">Creador
                                            <input class="mdl-textfield__input" type="text"  id="Creador">
                                        <span class="mdl-textfield__error">Nombre Invalio</span>
                                        </h6>
                                        <h6 class="text-condensedLight">Responsable
                                            <input class="mdl-textfield__input" type="text"  id="Ciudad">
                                        <span class="mdl-textfield__error">Nombre Invalio</span>
                                        </h6>
                                        <h6 class="text-condensedLight">Transportadora
                                            <select class="mdl-textfield__input">
                                                <option value="" disabled="" selected="">...</option>
                                                <option value="">Interrapidisimo</option>
                                                <option value="">Servientrega</option>
                                                <option value="">RedeTrans</option>
                                                <option value="">Otros</option>
                                                <option value="">Envia</option>
                                            </select>
                                            </h6>
                                            <h6 class="text-condensedLight">Notas
                                                <input class="mdl-textfield__input" type="text"  id="Notas">
                                            <span class="mdl-textfield__error">Texto Invalio</span>
                                            </h6>
                                    </div>
                                </div>
                            </div>
                            <div class="mdl-grid">
							<div class="mdl-cell mdl-cell--1-col-phone mdl-cell--4-col-tablet mdl-cell--2-col-desktop">
                                    <h6 class="text-condensedLight">Codigo
                                        <input class="mdl-textfield__input" type="number" step="0.0000001"  id="Cantidad">
                                    <span class="mdl-textfield__error">Numero Invalio</span>
                                    </h6>
                                </div>
                                <div class="mdl-cell mdl-cell--1-col-phone mdl-cell--4-col-tablet mdl-cell--2-col-desktop">
                                    <h6 class="text-condensedLight">Cantidad
                                        <input class="mdl-textfield__input" type="number" step="0.0000001"  id="Cantidad">
                                    <span class="mdl-textfield__error">Numero Invalio</span>
                                    </h6>
                                </div>
                                <div class="mdl-cell mdl-cell--1-col-phone mdl-cell--4-col-tablet mdl-cell--3-col-desktop">
								<h6 class="text-condensedLight">Producto</h6>
												<?php
												echo "<select descripcion='opciones'>";
												while ($fila = mysqli_fetch_assoc($resultado1)) {
													echo "<option value='".$fila['descripcion']."'>".$fila['descripcion']."</option>";
												}
												echo "</select>";
												?>
                                </div>
                                <div class="mdl-cell mdl-cell--1-col-phone mdl-cell--4-col-tablet mdl-cell--2-col-desktop">
                                    <h6 class="text-condensedLight">LV
                                        <input class="mdl-textfield__input" type="number" step="0.0000001"  id="Cantidad">
                                    <span class="mdl-textfield__error">Numero Invalio</span>
                                    </h6>
                                </div>
                                <div class="mdl-cell mdl-cell--1-col-phone mdl-cell--4-col-tablet mdl-cell--2-col-desktop">
                                    <h6 class="text-condensedLight">LC
                                        <input class="mdl-textfield__input" type="number" step="0.0000001"  id="Cantidad">
                                    <span class="mdl-textfield__error">Numero Invalio</span>
                                    </h6>
                                </div>
                            </div>
                           
                            
                            <p class="text-center">
                                <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary"  id="btn-addProduct">
                                    <i class="zmdi zmdi-plus"></i>
                                    <div class="mdl-tooltip" for="btn-addProduct">Agregar Producto</div>
                                </button>
                             
                                <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary"  id="btn-generar">
                                    <i class="zmdi zmdi-check-all"></i>
                                    <div class="mdl-tooltip" for="btn-generar">Generar Orden</div>
                                </button>
                                <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary"  id="btn-guia">
                                    <i class="zmdi zmdi-collection-text"></i>
                                    <div class="mdl-tooltip" for="btn-guia">Crear Guia</div>
                                </button>
								<button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored bg-primary" id="CrearProducto">
										<i class="zmdi zmdi-account-add"></i>
										<div class="mdl-tooltip" for="CrearProducto">Crear Nuevo Cliente</div>
									</button>
                               
                            </p>
                        </form>
                    </div>
                </div>
            </div>
</div>
    