<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
		text-decoration: none;
	}

	a:hover {
		color: #97310e;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
		min-height: 96px;
	}

	p {
		margin: 0 0 10px;
		padding:0;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
<h1>Modificar Medico</h1>
<br>

<?php
    $contador=1;
    foreach($infoMedico->result() as $row)
    {
	?>

<?php
echo form_open_multipart("Medico/modificarbd");
?>

<br>

<input type="hidden" class="form-control" name="idMedico" placeholder="Escribe el nombre" value="<?php echo $row->idMedico;?>">


<!-- Campo para el nombre -->
<input type="text" class="form-control" name="nombre" placeholder="Escribe el nombre" value="<?php echo $row->nombre;?>" required>

<!-- Campo para el apellido -->
<input type="text" class="form-control" name="apellido" placeholder="Escribe el apellido" value="<?php echo $row->apellido;?>" required>

<!-- Campo para la fecha de nacimiento -->
<input type="date" class="form-control" name="fechaNacimiento" placeholder="Escribe la fecha de nacimiento" value="<?php echo $row->fechaNacimiento;?>" required>

<!-- Campo para el teléfono -->
<input type="text" class="form-control" name="telefono" placeholder="Escribe el teléfono" value="<?php echo $row->telefono;?>" required>

<!-- Campo para la dirección -->
<input type="text" class="form-control" name="direccion" placeholder="Escribe la dirección" value="<?php echo $row->direccion;?>" required>

<!-- Campo para el correo electrónico -->
<input type="email" class="form-control" name="email" placeholder="Escribe el correo electrónico" value="<?php echo $row->email;?>" required>

<!-- Campo para la contraseña -->
<input type="password" class="form-control" name="contrasenia" placeholder="Escribe la contraseña" value="<?php echo $row->contrasenia;?>" required>

<!-- Campo para el rol utilizando un combo box -->
<select class="form-control" name="rol">
    <option value="Administrador" <?php echo $row->rol == 'Administrador' ? 'selected' : ''; ?>>Administrador</option>
    <option value="Paciente" <?php echo $row->rol == 'Paciente' ? 'selected' : ''; ?>>Paciente</option>
    <option value="Medico" <?php echo $row->rol == 'Medico' ? 'selected' : ''; ?>>Medico</option>
</select>


<br>

<button type="submit"  class="btn btn success">Modificar Medico</button>


<?php 
echo form_close();
}
?>

