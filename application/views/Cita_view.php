<div class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- ... (código anterior) ... -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Lista de Citas</h5>
                        <a href="<?php echo base_url('Cita/agregar'); ?>" class="btn btn-primary float-right">Agregar Cita</a>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Fecha</th>
                                        <th>Paciente</th>
                                        <th>Médico</th>
                                        <th>Tipo de Atención</th>
                                        <th>Motivo de Consulta</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($citas as $cita): ?>
                                        <tr data-toggle="collapse" data-target="#detalle-<?php echo $cita->idCita; ?>" class="accordion-toggle">
                                            <td><?php echo $cita->idCita; ?></td>
                                            <td><?php echo $cita->fecha; ?></td>
                                            <td><?php echo $cita->nombrePaciente; ?></td>
                                            <td><?php echo $cita->nombreMedico; ?></td>
                                            <td><?php echo $cita->nombreTipoAtencion; ?></td>
                                            <td><?php echo $cita->motivoConsulta; ?></td>
                                            <td>
                                                <a href="<?php echo base_url('Cita/modificar/'.$cita->idCita); ?>" class="btn btn-sm btn-info">Modificar</a>
                                                <a href="<?php echo base_url('Cita/eliminar/'.$cita->idCita); ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Está seguro de eliminar esta cita?')">Eliminar</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" class="hiddenRow">
                                                <div class="accordian-body collapse" id="detalle-<?php echo $cita->idCita; ?>">
                                                    <h6>Detalles de la Cita</h6>
                                                    <p><strong>Cita Cabeza:</strong></p>
                                                    <ul>
                                                        <li>Estado: <?php echo $cita->citaCabeza->estado; ?></li>
                                                        <!-- Agregar más detalles de cita_cabeza aquí -->
                                                    </ul>
                                                    <p><strong>Cita Detalle:</strong></p>
                                                    <ul>
                                                        <li>Costo de Atención: <?php echo $cita->citaDetalle->costoAtencion; ?></li>
                                                        <!-- Agregar más detalles de cita_detalle aquí -->
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>