<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Lista de Médicos</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Administración de Médicos</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Lista de Médicos</h5>
                        <a href="<?php echo base_url(); ?>index.php/Medico/agregar" class="btn btn-primary float-right">
                            Agregar Médico
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
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <?php echo form_open('Medico/modificar'); ?>
                                                        <input type="hidden" name="idMedico" value="<?php echo $row->idUsuario; ?>">
                                                        <button type="submit" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Modificar</button>
                                                    <?php echo form_close(); ?>
                                                   
                                                    <?php echo form_open('Medico/eliminarbd'); ?>
                                                        <input type="hidden" name="idMedico" value="<?php echo $row->idUsuario; ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Eliminar</button>
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
        </div>
    </div>
</div>