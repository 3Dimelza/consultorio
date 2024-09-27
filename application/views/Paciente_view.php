<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Lista de Pacientes</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Administración de Pacientes</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Lista de Pacientes</h5>
                        <a href="<?php echo base_url(); ?>index.php/Paciente/agregar" class="btn btn-primary float-right">
                            Agregar Paciente
                        </a>
                        <a href="<?php echo base_url(); ?>index.php/Paciente/pacientesDeshabilitados" class="btn btn-secondary float-right mr-2">
                            Ver Pacientes Deshabilitados
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
                                        <th>Alergias</th>
                                        <th>Tipo de Sangre</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $contador = 1;
                                    foreach($pacientes->result() as $row)
                                    {
                                    ?>
                                        <tr>
                                            <td><?php echo $contador; ?></td>
                                            <td><?php echo $row->nombre; ?></td>
                                            <td><?php echo $row->apellido; ?></td>
                                            <td><?php echo $row->fechaNacimiento; ?></td>
                                            <td><?php echo $row->telefono; ?></td>
                                            <td><?php echo $row->email; ?></td>
                                            <td><?php echo $row->alergias; ?></td>
                                            <td><?php echo $row->tipoSangre; ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="<?php echo base_url('index.php/Paciente/modificar/'.$row->idUsuario); ?>" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Modificar</a>
                                                    <a href="<?php echo base_url('index.php/Paciente/cambiarEstado/'.$row->idUsuario.'/0'); ?>" class="btn btn-warning btn-sm" onclick="return confirm('¿Está seguro de que desea deshabilitar este paciente?');"><i class="fas fa-ban"></i> Deshabilitar</a>
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
