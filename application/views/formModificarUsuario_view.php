<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard Analytics</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Dashboard Analytics</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">


<body>

<div id="container">
<h1>Modificar Usuario</h1>
<br>

<?php
    $contador=1;
    foreach($infoUsuario->result() as $row)
    {
	?>

<?php
echo form_open_multipart("Administrador/modificarbd");
?>

<br>

<input type="hidden" class="form-control" name="idUsuario" placeholder="Escribe el nombre" value="<?php echo $row->idUsuario;?>">


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

<button type="submit"  class="btn btn success">Modificar Usuario</button>


<?php 
echo form_close();
}
?>
	
</body>
</div>
                    </div>
                </div>
            </div>
            <!-- [ stiped-table ] end -->    

 
<!-- Latest Customers end -->
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
