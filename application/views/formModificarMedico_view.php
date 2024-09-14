<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Modificar Médico</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Administración de Médicos</a></li>
                            <li class="breadcrumb-item"><a href="#!">Modificar Médico</a></li>
						</ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Modificar Médico</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        $infoMedico = $infoMedico->row();
                        echo form_open('Medico/modificarbd');
                        ?>
                            <input type="hidden" name="idMedico" value="<?php echo $infoMedico->idUsuario; ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" value="<?php echo $infoMedico->nombre; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido">Apellido</label>
                                        <input type="text" class="form-control" name="apellido" value="<?php echo $infoMedico->apellido; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fechaNacimiento">Fecha de Nacimiento</label>
                                        <input type="date" class="form-control" name="fechaNacimiento" value="<?php echo $infoMedico->fechaNacimiento; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono">Teléfono</label>
                                        <input type="text" class="form-control" name="telefono" value="<?php echo $infoMedico->telefono; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="direccion">Dirección</label>
                                        <input type="text" class="form-control" name="direccion" value="<?php echo $infoMedico->direccion; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Correo Electrónico</label>
                                        <input type="email" class="form-control" name="email" value="<?php echo $infoMedico->email; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="contrasenia">Contraseña</label>
                                        <input type="password" class="form-control" name="contrasenia" placeholder="Dejar en blanco para mantener la contraseña actual">
                                    </div>
                                    <div class="form-group">
                                        <label for="especialidad">Especialidad</label>
                                        <input type="text" class="form-control" name="especialidad" value="<?php echo $infoMedico->especialidad; ?>" required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Modificar Médico</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>