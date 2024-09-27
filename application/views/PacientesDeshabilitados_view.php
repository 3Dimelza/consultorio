<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Pacientes Deshabilitados</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Administración</a></li>
                            <li class="breadcrumb-item"><a href="#!">Pacientes Deshabilitados</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Lista de Pacientes Deshabilitados</h5>
                        <a href="<?php echo base_url(); ?>index.php/Paciente/index" class="btn btn-primary float-right">
                            Volver a Pacientes Activos
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
                                        <th>Email</th>
                                        <th>Teléfono</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 1;
                                    foreach($pacientes->result() as $paciente) {
                                    ?>
                                        <tr>
                                            <td><?php echo $contador?></td>
                                            <td><?php echo $paciente->nombre; ?></td>
                                            <td><?php echo $paciente->apellido;?></td>
                                            <td><?php echo $paciente->email;?></td>
                                            <td><?php echo $paciente->telefono;?></td>
                                            <td>
                                                <a href="<?php echo base_url('index.php/Paciente/cambiarEstado/'.$paciente->idUsuario.'/1'); ?>" class="btn btn-success btn-sm">Habilitar</a>
                                                
                                                <?php echo form_open('Paciente/eliminarbd', ['style' => 'display:inline;']); ?>
                                                    <input type="hidden" name="idPaciente" value="<?php echo $paciente->idUsuario; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de que desea eliminar este paciente permanentemente? Esta acción no se puede deshacer.');">Eliminar</button>
                                                <?php echo form_close(); ?>
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