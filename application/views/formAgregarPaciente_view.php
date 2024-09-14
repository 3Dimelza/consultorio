<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Agregar Paciente</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Administración de Pacientes</a></li>
                            <li class="breadcrumb-item"><a href="#!">Agregar Paciente</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Agregar Paciente</h5>
                    </div>
                    <div class="card-body">
                        <?php echo form_open('Paciente/agregarbd'); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido">Apellido</label>
                                        <input type="text" class="form-control" name="apellido" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fechaNacimiento">Fecha de Nacimiento</label>
                                        <input type="date" class="form-control" name="fechaNacimiento" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" class="form-control" name="telefono" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <input type="text" class="form-control" name="direccion" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Correo Electrónico</label>
                                        <input type="email" class="form-control" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="contrasenia">Contraseña</label>
                                        <input type="password" class="form-control" name="contrasenia" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="alergias">Alergias</label>
                                        <input type="text" class="form-control" name="alergias">
                                    </div>
                                    <div class="form-group">
                                        <label for="tipoSangre">Tipo de Sangre</label>
                                        <select class="form-control" name="tipoSangre">
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="historial_medico">Historial Médico</label>
                                        <textarea class="form-control" name="historial_medico" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Agregar Paciente</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>