<!-- [ Main Content ] start -->
<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Dashboard Analytics</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Dashboard Analytics</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
<!-- [ Main Content ] start -->
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Agregar Paciente</h5>
            </div>
            <div class="card-body">
                <?php
                // Inicia el formulario con multipart para permitir subida de archivos
                echo form_open_multipart("Administrador/agregarbd");
                ?>

                <!-- Campo para el nombre -->
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" name="nombre" placeholder="Escribe el nombre" required>
                </div>

                <!-- Campo para el apellido -->
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" name="apellido" placeholder="Escribe el apellido" required>
                </div>

                <!-- Campo para la fecha de nacimiento -->
                <div class="form-group">
                    <label for="fechaNacimiento">Fecha de Nacimiento</label>
                    <input type="date" class="form-control" name="fechaNacimiento" placeholder="Escribe la fecha de nacimiento" required>
                </div>

                <!-- Campo para el teléfono -->
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control" name="telefono" placeholder="Escribe el teléfono" required>
                </div>

                <!-- Campo para la dirección -->
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" class="form-control" name="direccion" placeholder="Escribe la dirección" required>
                </div>

                <!-- Campo para el correo electrónico -->
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" class="form-control" name="email" placeholder="Escribe el correo electrónico" required>
                </div>
    
                
                <!-- Campo para la contraseña -->
                
                <!-- 
                <div class="form-group">
                    <label for="contrasenia">Contraseña</label>
                    <input type="password" class="form-control" name="contrasenia" placeholder="Escribe la contraseña" required>
                </div>
                -->

                <!-- Campo para el rol utilizando un combo box -->
                
                <!-- 
                <div class="form-group">
                    <label for="rol">Rol</label>
                    <select class="form-control" name="rol" required>
                        <option value="Administrador">Administrador</option>
                        <option value="Paciente">Paciente</option>
                        <option value="Medico">Medico</option>
                    </select>
                </div>
                -->

                 <!-- Campo para Alergias -->
                <div class="form-group">
                    <label for="alergias">Alergias</label>
                    <input type="text" class="form-control" name="alergias" placeholder="Escribe las alergias" required>
                </div>

                <!-- Campo para el Tipo de Sangre -->
                <div class="form-group">
                    <label for="tipoSangre">Tipo de Sangre</label>
                    <select class="form-control" name="tipoSangre" required>
                        <option value="" disabled selected>Selecciona el tipo de sangre</option>
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

                <!-- Campo para el Historial Médico -->
                <div class="form-group">
                    <label for="historialMedico">Historial Médico</label>
                    <textarea class="form-control" name="historialMedico" placeholder="Escribe el historial médico" required></textarea>
                </div>  









                <!-- Botón de envío -->
                <button type="submit" class="btn btn-success">Agregar Paciente</button>

                <?php 
                // Cierra el formulario
                echo form_close();
                ?>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
