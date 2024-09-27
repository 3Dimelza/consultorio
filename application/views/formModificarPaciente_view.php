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
                        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                        <?php endif; ?>
                        <?php if($this->session->flashdata('mensaje')): ?>
                            <div class="alert alert-success"><?php echo $this->session->flashdata('mensaje'); ?></div>
                        <?php endif; ?>
                        <?php echo form_open('Paciente/modificarbd'); ?>
                            <input type="hidden" name="idPaciente" value="<?php echo $paciente->idUsuario; ?>">
                            <input type="hidden" name="nombre_completo" id="nombre_completo" value="<?php echo $paciente->nombre . ' ' . $paciente->apellido; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo set_value('nombre', $paciente->nombre); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido">Apellido</label>
                                        <input type="text" class="form-control" name="apellido" id="apellido" value="<?php echo set_value('apellido', $paciente->apellido); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fechaNacimiento">Fecha de Nacimiento</label>
                                        <input type="date" class="form-control" name="fechaNacimiento" value="<?php echo set_value('fechaNacimiento', $paciente->fechaNacimiento); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" class="form-control" name="telefono" value="<?php echo set_value('telefono', $paciente->telefono); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <input type="text" class="form-control" name="direccion" value="<?php echo set_value('direccion', $paciente->direccion); ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Correo Electrónico</label>
                                        <input type="email" class="form-control" name="email" value="<?php echo set_value('email', $paciente->email); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="contrasenia">Contraseña (dejar en blanco si no desea cambiarla)</label>
                                        <input type="password" class="form-control" name="contrasenia">
                                    </div>
                                    <div class="form-group">
                                        <label for="alergias">Alergias</label>
                                        <input type="text" class="form-control" name="alergias" value="<?php echo set_value('alergias', $paciente->alergias); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="tipoSangre">Tipo de Sangre</label>
                                        <select class="form-control" name="tipoSangre">
                                            <?php
                                            $tipos_sangre = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
                                            foreach ($tipos_sangre as $tipo) {
                                                $selected = ($paciente->tipoSangre == $tipo) ? 'selected' : '';
                                                echo "<option value='$tipo' ".set_select('tipoSangre', $tipo, $selected).">$tipo</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="historial_medico">Historial Médico</label>
                                        <textarea class="form-control" name="historial_medico" rows="3"><?php echo set_value('historial_medico', $paciente->historial_medico); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Modificar Paciente</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var nombreInput = document.getElementById('nombre');
    var apellidoInput = document.getElementById('apellido');
    var nombreCompletoInput = document.getElementById('nombre_completo');

    function actualizarNombreCompleto() {
        nombreCompletoInput.value = (nombreInput.value + ' ' + apellidoInput.value).trim();
    }

    nombreInput.addEventListener('input', actualizarNombreCompleto);
    apellidoInput.addEventListener('input', actualizarNombreCompleto);
});
</script>
