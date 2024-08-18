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

<h1>LISTA DE USUARIOS</h1>


<a href="<?php echo base_url()?>index.php/Administrador/agregar">
<br>
<br>
<button type="button" class="btn btn-primary"> Agregar Usuario</button>
</a>
            <!-- [ stiped-table ] start -->
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Striped Table</h5>
                        <span class="d-block m-t-5">use class <code>table-striped</code> inside table element</span>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                
  <thead>
    <th>No.</th>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Fecha de Nacimiento</th>
    <th>Telefono</th>
    <th>Direccion</th>
    <th>Correo Electronico</th>
    <th>Rol</th>
    <th>Estado</th>
    <th>Fecha de Creacion</th>
    <th>Fecha de Actualizacion</th>
    <th>Id Auditoria</th>
	<th>Modificar</th>
	<th>Eliminar</th>

  </thead>
  <tbody>
    <?php
    $contador=1;
    foreach($usuarios->result() as $row)
    {
	?>
		<tr>
		<td><?php echo $contador?></td>
		<td><?php echo $row->nombre; ?></dh>
		<td> <?php echo $row->apellido;?> </td>
		<td> <?php echo $row->fechaNacimiento;?> </td>
		<td> <?php echo $row->telefono;?> </td>
		<td> <?php echo $row->direccion;?> </td>
		<td> <?php echo $row->email;?> </td>
		<td> <?php echo $row->rol;?> </td>
		<td> <?php echo $row->estado;?> </td>
		<td> <?php echo $row->fechaCreacion;?> </td>
		<td> <?php echo $row->ultimaActualizacion;?> </td>
		<td> <?php echo $row->idUsuario_auditoria;?> </td>
		<td>
	<?php
		echo form_open_multipart("Administrador/modificar");
	?>
	
	<input	type="hidden" name="idUsuario" value="<?php echo $row->idUsuario;?>">
	<button type="submit" class="btn btn-success">Modificar</button>

	
	<?php
		echo form_open_multipart("Administrador/eliminarbd");
	?>
	
	<input	type="hidden" name="idUsuario" value="<?php echo $row->idUsuario;?>">
	<button type="submit" class="btn btn-danger">Eliminar</button>
	
	<?php
    echo form_close(); // Cerrar el primer formulario
    ?>
	
	<?php 
	echo form_close();
	?>
		</td>
	</tr>

    <?php
    $contador++;
  } 
	?>
  </tbody>
 

 
  </table>
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
