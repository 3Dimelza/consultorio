<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Lista de Usuarios</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Administración</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Lista de Usuarios</h5>
                        <a href="<?php echo base_url()?>index.php/Administrador/agregar" class="btn btn-primary float-right mr-2">
                            Agregar Usuario
                        </a>
                        <a href="<?php echo base_url()?>index.php/Administrador/usuariosDeshabilitados" class="btn btn-secondary float-right">
                            Ver Usuarios Deshabilitados
                        </a>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Fecha Nacimiento</th>
                                        <th>Teléfono</th>
                                        <th>Dirección</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                        <th>Detalles</th>
                                        <th>Fecha Creación</th>
                                        <th>Última Actualización</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 1;
                                    foreach($usuarios->result() as $row) {
                                    ?>
                                        <tr>
                                            <td><?php echo $contador?></td>
                                            <td><?php echo $row->nombre; ?></td>
                                            <td><?php echo $row->apellido;?></td>
                                            <td><?php echo $row->fechaNacimiento;?></td>
                                            <td><?php echo $row->telefono;?></td>
                                            <td><?php echo $row->direccion;?></td>
                                            <td><?php echo $row->email;?></td>
                                            <td><?php echo $row->rol;?></td>
                                            <td>
                                                <?php 
                                                if ($row->rol == 'Paciente') {
                                                    echo "Alergias: " . $row->alergias . "<br>";
                                                    echo "Tipo de Sangre: " . $row->tipoSangre;
                                                } elseif ($row->rol == 'Medico') {
                                                    echo "Especialidad: " . $row->especialidad;
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $row->fechaCreacion;?></td>
                                            <td><?php echo $row->ultimaActualizacion;?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="<?php echo base_url('index.php/Administrador/modificar/'.$row->idUsuario); ?>" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Modificar</a>
                                                    <a href="<?php echo base_url('index.php/Administrador/cambiarEstado/'.$row->idUsuario.'/0'); ?>" class="btn btn-warning btn-sm" onclick="return confirm('¿Está seguro de que desea deshabilitar este usuario?');"><i class="fas fa-ban"></i> Deshabilitar</a>
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
        </div>
    </div>
</div>