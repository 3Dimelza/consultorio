<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Modificar Usuario</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Administración</a></li>
                            <li class="breadcrumb-item"><a href="#!">Modificar Usuario</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Modificar Usuario</h5>
                    </div>
                    <div class="card-body">
                        <?php echo form_open("Administrador/modificarbd"); ?>
                        <input type="hidden" name="idUsuario" value="<?php echo $usuario->idUsuario; ?>">
                        
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" name="nombre" value="<?php echo $usuario->nombre; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="apellido">Apellido</label>
                            <input type="text" class="form-control" name="apellido" value="<?php echo $usuario->apellido; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="fechaNacimiento">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" name="fechaNacimiento" value="<?php echo $usuario->fechaNacimiento; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="telefono">Teléfono</label>
                            <input type="text" class="form-control" name="telefono" value="<?php echo $usuario->telefono; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <input type="text" class="form-control" name="direccion" value="<?php echo $usuario->direccion; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Correo Electrónico</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $usuario->email; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="contrasenia">Contraseña (dejar en blanco para no cambiar)</label>
                            <input type="password" class="form-control" name="contrasenia">
                        </div>

                        <div class="form-group">
                            <label for="rol">Rol</label>
                            <select class="form-control" name="rol" id="rol" required onchange="mostrarCamposAdicionales()">
                                <option value="Administrador" <?php echo ($usuario->rol == 'Administrador') ? 'selected' : ''; ?>>Administrador</option>
                                <option value="Paciente" <?php echo ($usuario->rol == 'Paciente') ? 'selected' : ''; ?>>Paciente</option>
                                <option value="Medico" <?php echo ($usuario->rol == 'Medico') ? 'selected' : ''; ?>>Médico</option>
                            </select>
                        </div>

                        <div id="campos-paciente" style="display: <?php echo ($usuario->rol == 'Paciente') ? 'block' : 'none'; ?>;">
                            <div class="form-group">
                                <label for="alergias">Alergias</label>
                                <input type="text" class="form-control" name="alergias" value="<?php echo isset($paciente) ? $paciente->alergias : ''; ?>">
                            </div>
                            <div class="form-group">
                                <label for="tipoSangre">Tipo de Sangre</label>
                                <select class="form-control" name="tipoSangre">
                                    <?php
                                    $tipos_sangre = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
                                    foreach ($tipos_sangre as $tipo) {
                                        $selected = (isset($paciente) && $paciente->tipoSangre == $tipo) ? 'selected' : '';
                                        echo "<option value='$tipo' $selected>$tipo</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="historial_medico">Historial Médico</label>
                                <textarea class="form-control" name="historial_medico" rows="3"><?php echo isset($paciente) ? $paciente->historial_medico : ''; ?></textarea>
                            </div>
                        </div>

                        <div id="campos-medico" style="display: <?php echo ($usuario->rol == 'Medico') ? 'block' : 'none'; ?>;">
                            <div class="form-group">
                                <label for="especialidad">Especialidad</label>
                                <input type="text" class="form-control" name="especialidad" value="<?php echo isset($medico) ? $medico->especialidad : ''; ?>">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Modificar Usuario</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function mostrarCamposAdicionales() {
    var rol = document.getElementById('rol').value;
    var camposPaciente = document.getElementById('campos-paciente');
    var camposMedico = document.getElementById('campos-medico');

    if (rol === 'Paciente') {
        camposPaciente.style.display = 'block';
        camposMedico.style.display = 'none';
    } else if (rol === 'Medico') {
        camposPaciente.style.display = 'none';
        camposMedico.style.display = 'block';
    } else {
        camposPaciente.style.display = 'none';
        camposMedico.style.display = 'none';
    }
}

// Llamar a la función al cargar la página para asegurar que los campos correctos estén visibles
window.onload = mostrarCamposAdicionales;
</script>