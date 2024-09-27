<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>Agregar Médico</h5>
                        </div>
                        <div class="card-body">
                            <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                            <?php if($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                            <?php endif; ?>
                            <?php if($this->session->flashdata('mensaje')): ?>
                                <div class="alert alert-success"><?php echo $this->session->flashdata('mensaje'); ?></div>
                            <?php endif; ?>
                            <?php echo form_open('Medico/agregarbd'); ?>
                                <input type="hidden" name="nombre_completo" id="nombre_completo" value="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo set_value('nombre'); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="apellido">Apellido</label>
                                            <input type="text" class="form-control" name="apellido" id="apellido" value="<?php echo set_value('apellido'); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="fechaNacimiento">Fecha de Nacimiento</label>
                                            <input type="date" class="form-control" name="fechaNacimiento" value="<?php echo set_value('fechaNacimiento'); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="telefono">Teléfono</label>
                                            <input type="text" class="form-control" name="telefono" value="<?php echo set_value('telefono'); ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="direccion">Dirección</label>
                                            <input type="text" class="form-control" name="direccion" value="<?php echo set_value('direccion'); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Correo Electrónico</label>
                                            <input type="email" class="form-control" name="email" value="<?php echo set_value('email'); ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="contrasenia">Contraseña</label>
                                            <input type="password" class="form-control" name="contrasenia" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="especialidad">Especialidad</label>
                                            <input type="text" class="form-control" name="especialidad" value="<?php echo set_value('especialidad'); ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Agregar Médico</button>
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
