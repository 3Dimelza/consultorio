<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Inicio</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Tablero</a></li>
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
	
	<th>Acciones</th>

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
        <td class="text-center">
                      <div class="btn-group">
                        <?php echo form_open_multipart("Administrador/modificar"); ?>
                          <input type="hidden" name="idUsuario" value="<?php echo $row->idUsuario; ?>">
                          <button type="submit" class="btn btn-morado"><i class="fas fa-edit"></i></button>
                        <?php echo form_close(); ?>
                                
                        <?php echo form_open_multipart("Administrador/eliminarbd"); ?>
                          <input type="hidden" name="idUsuario" value="<?php echo $row->idUsuario; ?>">
                          <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        <?php echo form_close(); ?>
                      </div>
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
