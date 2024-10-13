<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Modificar Cita</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Gestión de Citas</a></li>
                            <li class="breadcrumb-item"><a href="#!">Modificar Cita</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Modificar Cita</h5>
                    </div>
                    <div class="card-body">
                        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                        <?php endif; ?>
                        <?php if($this->session->flashdata('mensaje')): ?>
                            <div class="alert alert-success"><?php echo $this->session->flashdata('mensaje'); ?></div>
                        <?php endif; ?>
                        <?php echo form_open('Cita/modificarbd'); ?>
                            <input type="hidden" name="idCita" value="<?php echo $infoCita->idCita; ?>">
                            <div class="form-group">
                                <label for="idPaciente">Paciente</label>
                                <select class="form-control" name="idPaciente" required>
                                    <?php foreach($pacientes as $paciente): ?>
                                        <option value="<?php echo $paciente->idUsuario; ?>" <?php echo ($paciente->idUsuario == $infoCita->idPaciente) ? 'selected' : ''; ?>>
                                            <?php echo $paciente->nombre . ' ' . $paciente->apellido; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="idMedico">Médico</label>
                                <select class="form-control" name="idMedico" id="idMedico" required>
                                    <?php foreach($medicos as $medico): ?>
                                        <option value="<?php echo $medico->idUsuario; ?>" <?php echo ($medico->idUsuario == $infoCita->idMedico) ? 'selected' : ''; ?>>
                                            <?php echo $medico->nombre . ' ' . $medico->apellido . ' - ' . $medico->especialidad; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control" name="fecha" id="fecha" value="<?php echo date('Y-m-d', strtotime($infoCita->fecha)); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="hora">Hora</label>
                                <input type="time" class="form-control" name="hora" id="hora" value="<?php echo date('H:i', strtotime($infoCita->fecha)); ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="idTipoDeAtencion">Tipo de Atención</label>
                                <select class="form-control" name="idTipoDeAtencion" id="idTipoDeAtencion" required>
                                    <?php foreach($tipos_atencion as $tipo): ?>
                                        <option value="<?php echo $tipo->idTipoDeAtencion; ?>" 
                                                data-costo="<?php echo $tipo->costoAtencion; ?>"
                                                <?php echo ($tipo->idTipoDeAtencion == $infoCita->idTipoDeAtencion) ? 'selected' : ''; ?>>
                                            <?php echo $tipo->nombreTipoAtencion . ' - Bs. ' . $tipo->costoAtencion; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="costoAtencion">Costo de Atención</label>
                                <input type="text" class="form-control" id="costoAtencion" name="costoAtencion" value="<?php echo $infoCita->costoAtencion; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="motivoConsulta">Motivo de Consulta</label>
                                <textarea class="form-control" name="motivoConsulta" rows="3" required><?php echo $infoCita->motivoConsulta; ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Modificar Cita</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#idTipoDeAtencion').change(function() {
        var selectedOption = $(this).find('option:selected');
        var costo = selectedOption.data('costo');
        $('#costoAtencion').val(costo);
    });

    $('#idMedico, #fecha').change(function() {
        var idMedico = $('#idMedico').val();
        var fecha = $('#fecha').val();
        if(idMedico && fecha) {
            $.ajax({
                url: '<?php echo base_url("cita/obtenerHorariosDisponibles"); ?>',
                method: 'POST',
                data: { idMedico: idMedico, fecha: fecha },
                dataType: 'json',
                success: function(response) {
                    var horaSelect = $('#hora');
                    horaSelect.empty();
                    $.each(response, function(index, hora) {
                        horaSelect.append($('<option>', {
                            value: hora,
                            text: hora
                        }));
                    });
                }
            });
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var fechaInput = document.getElementById('fecha');
    var horaInput = document.getElementById('hora');
    if (fechaInput && horaInput) {
        var today = new Date().toISOString().split('T')[0];
        fechaInput.setAttribute('min', today);
        
        document.querySelector('form').addEventListener('submit', function(e) {
            var selectedDateTime = new Date(fechaInput.value + 'T' + horaInput.value);
            var now = new Date();
            if (selectedDateTime <= now) {
                e.preventDefault();
                alert('No se pueden agendar citas para fechas y horas pasadas.');
            }
        });
    }
});
</script>