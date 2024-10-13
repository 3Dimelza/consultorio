<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Agendar Nueva Cita</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Gestión de Citas</a></li>
                            <li class="breadcrumb-item"><a href="#!">Agendar Cita</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Agendar Nueva Cita</h5>
                    </div>
                    <div class="card-body">
                        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                        <?php endif; ?>
                        <?php if($this->session->flashdata('mensaje')): ?>
                            <div class="alert alert-success"><?php echo $this->session->flashdata('mensaje'); ?></div>
                        <?php endif; ?>
                        <?php echo form_open('Cita/agregarbd'); ?>
                        <div class="form-group">
                            <label for="idPaciente">Paciente</label>
                            <input type="text" id="searchPaciente" class="form-control" placeholder="Buscar paciente...">
                            <select name="idPaciente" id="idPaciente" class="form-control" required>
                                <option value="">Seleccione un paciente</option>
                                <?php foreach($pacientes->result() as $paciente): ?>
                                    <option value="<?php echo $paciente->idUsuario; ?>"><?php echo $paciente->nombre . ' ' . $paciente->apellido; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="idMedico">Médico</label>
                            <input type="text" id="searchMedico" class="form-control" placeholder="Buscar médico...">
                            <select name="idMedico" id="idMedico" class="form-control" required>
                                <option value="">Seleccione un médico</option>
                                <?php foreach($medicos->result() as $medico): ?>
                                    <option value="<?php echo $medico->idUsuario; ?>"><?php echo $medico->nombre . ' ' . $medico->apellido . ' - ' . $medico->especialidad; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control" name="fecha" id="fecha" required>
                            </div>
                            <div class="form-group">
                                <label for="hora">Hora</label>
                                <select class="form-control" name="hora" id="hora" required>
                                    <option value="">Seleccione una hora</option>
                                    <?php foreach($horarios_disponibles as $hora): ?>
                                        <option value="<?php echo $hora; ?>"><?php echo $hora; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="idTipoDeAtencion">Tipo de Atención</label>
                                <select class="form-control" name="idTipoDeAtencion" id="idTipoDeAtencion" required>
                                    <option value="">Seleccione el tipo de atención</option>
                                    <?php foreach($tipos_atencion as $tipo): ?>
                                        <option value="<?php echo $tipo->idTipoDeAtencion; ?>" data-costo="<?php echo $tipo->costoAtencion; ?>">
                                            <?php echo $tipo->nombreTipoAtencion . ' - Bs. ' . $tipo->costoAtencion; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="costoAtencion">Costo de Atención</label>
                                <input type="text" class="form-control" id="costoAtencion" name="costoAtencion" readonly>
                            </div>
                            <div class="form-group">
                                <label for="motivoConsulta">Motivo de Consulta</label>
                                <textarea class="form-control" name="motivoConsulta" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Agendar Cita</button>
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
                    horaSelect.append('<option value="">Seleccione una hora</option>');
                    $.each(response, function(index, hora) {
                        horaSelect.append('<option value="' + hora + '">' + hora + '</option>');
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
<script>
function filterSelect(searchInput, selectId) {
    const input = document.getElementById(searchInput);
    const select = document.getElementById(selectId);

    input.addEventListener('input', function() {
        const filter = this.value.toLowerCase();
        const options = select.getElementsByTagName('option');

        for (let i = 0; i < options.length; i++) {
            const txtValue = options[i].textContent || options[i].innerText;
            if (txtValue.toLowerCase().indexOf(filter) > -1) {
                options[i].style.display = "";
            } else {
                options[i].style.display = "none";
            }
        }
    });
}

filterSelect('searchPaciente', 'idPaciente');
filterSelect('searchMedico', 'idMedico');
</script>