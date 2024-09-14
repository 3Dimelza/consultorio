<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Modificar Paciente</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Administración de Pacientes</a></li>
                            <li class="breadcrumb-item"><a href="#!">Modificar Paciente</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Modificar Paciente</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        foreach($infoPaciente->result() as $row)
                        {
                        ?>
                        <?php echo form_open('Paciente/modificarbd'); ?>
                            <input type="hidden" name="idPaciente" value="<?php echo $row->idUsuario; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" value="<?php echo $row->nombre; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido">Apellido</label>
                                        <input type="text" class="form-control" name="apellido" value="<?php echo $row->apellido; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fechaNacimiento">Fecha de Nacimiento</label>
                                        <input type="date" class="form-control" name="fechaNacimiento" value="<?php echo $row->fechaNacimiento; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" class="form-control" name="telefono" value="<?php echo $row->telefono; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <input type="text" class="form-control" name="direccion" value="<?php echo $row->direccion; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Correo Electrónico</label>
                                        <input type="email" class="form-control" name="email" value="<?php echo $row->email; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="contrasenia">Contraseña</label>
                                        <input type="password" class="form-control" name="contrasenia" value="<?php echo $row->contrasenia; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="alergias">Alergias</label>
                                        <input type="text" class="form-control" name="alergias" value="<?php echo $row->alergias; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="tipoSangre">Tipo de Sangre</label>
                                        <select class="form-control" name="tipoSangre">
                                            <option value="A+" <?php echo ($row->tipoSangre == 'A+') ? 'selected' : ''; ?>>A+</option>
                                            <option value="A-" <?php echo ($row->tipoSangre == 'A-') ? 'selected' : ''; ?>>A-</option>
                                            <option value="B+" <?php echo ($row->tipoSangre == 'B+') ? 'selected' : ''; ?>>B+</option>
                                            <option value="B-" <?php echo ($row->tipoSangre == 'B-') ? 'selected' : ''; ?>>B-</option>
                                            <option value="AB+" <?php echo ($row->tipoSangre == 'AB+') ? 'selected' : ''; ?>>AB+</option>
                                            <option value="AB-" <?php echo ($row->tipoSangre == 'AB-') ? 'selected' : ''; ?>>AB-</option>
                                            <option value="O+" <?php echo ($row->tipoSangre == 'O+') ? 'selected' : ''; ?>>O+</option>
                                            <option value="O-" <?php echo ($row->tipoSangre == 'O-') ? 'selected' : ''; ?>>O-</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="historial_medico">Historial Médico</label>
                                        <textarea class="form-control" name="historial_medico" rows="3"><?php echo $row->historial_medico; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Modificar Paciente</button>
                        <?php echo form_close(); ?>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>