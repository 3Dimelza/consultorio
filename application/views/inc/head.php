<!DOCTYPE html>
<html lang="en">

<head>
    <title>Neurovertebral</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="<?php echo base_url(); ?>Template/dist/assets/images/favicon.ico" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>Template/dist/assets/css/style.css">
    

<!-- jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- FullCalendar CSS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css' rel='stylesheet' />

<!-- FullCalendar JS -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/locales/es.js'></script>



<!-- Script para navegación AJAX -->
<script>
$(document).ready(function() {
	function cargarContenido(url) {
		$.ajax({
			url: url,
			type: 'GET',
			dataType: 'html',
			success: function(data) {
				$('#contenido-principal').html(data);
				history.pushState(null, '', url);
			},
			error: function() {
				alert('Error al cargar el contenido');
			}
		});
	}

	$(document).on('click', 'a.ajax-link', function(e) {
		e.preventDefault();
		var url = $(this).attr('href');
		cargarContenido(url);
	});

	$(window).on('popstate', function() {
		cargarContenido(location.href);
	});
});
</script>
    

</head>
<body class="">
	<!-- [ Pre-loader ] start -->
	<div class="loader-bg">
		<div class="loader-track">
			<div class="loader-fill"></div>
		</div>
	</div>
	<!-- [ Pre-loader ] End -->
	<!-- [ navigation menu ] start -->
	<nav class="pcoded-navbar  ">
		<div class="navbar-wrapper  ">
			<div class="navbar-content scroll-div " >
				
				<div class="">
					<div class="main-menu-header">
						<img class="img-radius" src="<?php echo base_url(); ?>Template/dist/assets/images/user/avatar-2.jpg" alt="User-Profile-Image">
						<div class="user-details">
							<span>Dimelza</span>
							<div id="more-details">Administrador<i class="fa fa-chevron-down m-l-5"></i></div>
						</div>
					</div>
					<div class="collapse" id="nav-user-link">
						<ul class="list-unstyled">
							<li class="list-group-item"><a href="user-profile.html"><i class="feather icon-user m-r-5"></i>Vista Perfil</a></li>
							<li class="list-group-item"><a href="#!"><i class="feather icon-settings m-r-5"></i>Configuraciones</a></li>
							<li class="list-group-item"><a href="auth-normal-sign-in.html"><i class="feather icon-log-out m-r-5"></i>Logout</a></li>
						</ul>
					</div>
				</div>
				
				


				<ul class="nav pcoded-inner-navbar ">
					<li class="nav-item pcoded-menu-caption">
						<label>Navegacion</label>
					</li>
					
					<li class="nav-item">
						<a href="<?php echo base_url(); ?>index.php/Home/index" class="nav-link ajax-link">
							<span class="pcoded-micon"><i class="feather icon-home"></i></span>
							<span class="pcoded-mtext">Inicio</span>
						</a>
					</li>

					<li class="nav-item">
						<a href="<?php echo base_url(); ?>index.php/Administrador/index" class="nav-link ajax-link">
							<span class="pcoded-micon"><i class="feather icon-users"></i></span>
							<span class="pcoded-mtext">Usuarios</span>
						</a>
					</li>

					<li class="nav-item">
						<a href="<?php echo base_url(); ?>index.php/Paciente/index" class="nav-link ajax-link">
							<span class="pcoded-micon"><i class="feather icon-user"></i></span>
							<span class="pcoded-mtext">Paciente</span>
						</a>
					</li>

					<li class="nav-item">
						<a href="<?php echo base_url(); ?>index.php/Medico/index" class="nav-link ajax-link">
							<span class="pcoded-micon"><i class="feather icon-user-check"></i></span>
							<span class="pcoded-mtext">Medico</span>
						</a>
					</li>

					<li class="nav-item">
						<a href="<?php echo base_url(); ?>index.php/Cita/index" class="nav-link ajax-link">
							<span class="pcoded-micon"><i class="feather icon-calendar"></i></span>
							<span class="pcoded-mtext">Citas</span>
						</a>
					</li>

					<li class="nav-item">
						<a href="<?php echo base_url(); ?>index.php/Reporte/index" class="nav-link ajax-link">
							<span class="pcoded-micon"><i class="feather icon-file-text"></i></span>
							<span class="pcoded-mtext">Reportes</span>
						</a>
					</li>

					<li class="nav-item">
						<a href="<?php echo base_url(); ?>index.php/Cobro/index" class="nav-link ajax-link">
							<span class="pcoded-micon"><i class="feather icon-credit-card"></i></span>
							<span class="pcoded-mtext">Cobros</span>
						</a>
					</li>
				</ul>
	
				
			</div>
		</div>
	</nav>
	<!-- [ navigation menu ] end -->