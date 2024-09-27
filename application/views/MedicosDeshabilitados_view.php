<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Médicos Deshabilitados</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Administración de Médicos</a></li>
                            <li class="breadcrumb-item"><a href="#!">Médicos Deshabilitados</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Lista de Médicos Deshabilitados</h5>
                        <a href="<?php echo base_url(); ?>index.php/Medico/index" class="btn btn-primary float-right">
                            Ver Médicos Habilitados
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
                                        <th>Fecha de Nacimiento</th>
                                        <th>Teléfono</th>
                                        <th>Email</th>
                                        <th>Especialidad</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 1;
                                    foreach($medicos->result() as $row)
                                    {
                                    ?>
                                        <tr>
                                            <td><?php echo $contador; ?></td>
                                            <td><?php echo $row->nombre; ?></td>
                                            <td><?php echo $row->apellido; ?></td>
                                            <td><?php echo $row->fechaNacimiento; ?></td>
                                            <td><?php echo $row->telefono; ?></td>
                                            <td><?php echo $row->email; ?></td>
                                            <td><?php echo $row->especialidad; ?></td>
                                            <td>
                                                <a href="<?php echo base_url('index.php/Medico/cambiarEstado/'.$row->idUsuario.'/1'); ?>" class="btn btn-success btn-sm">Habilitar</a>
                                                
                                                <form method="POST" action="<?php echo base_url('index.php/Medico/eliminarbd'); ?>" style="display:inline;">
                                                    <input type="hidden" name="idMedico" value="<?php echo $row->idUsuario; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar este médico permanentemente? Esta acción no se puede deshacer.');">Eliminar</button>
                                                </form>
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