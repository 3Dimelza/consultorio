<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Confirmar Pago</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('cita'); ?>">Gestión de Citas</a></li>
                            <li class="breadcrumb-item"><a href="#!">Confirmar Pago</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Detalles de la Cita #<?php echo $cita->idCita; ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Paciente:</strong> <?php echo $cita->nombre_paciente . ' ' . $cita->apellido_paciente; ?></p>
                                <p><strong>Médico:</strong> <?php echo $cita->nombre_medico . ' ' . $cita->apellido_medico; ?></p>
                                <p><strong>Especialidad:</strong> <?php echo $cita->especialidad; ?></p>
                                <p><strong>Fecha y Hora:</strong> <?php echo date('d/m/Y H:i', strtotime($cita->fecha)); ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Tipo de Atención:</strong> <?php echo $cita->nombreTipoAtencion; ?></p>
                                <p><strong>Costo:</strong> Bs. <?php echo number_format($cita->costoAtencion, 2); ?></p>
                                <p><strong>Motivo de Consulta:</strong> <?php echo $cita->motivoConsulta; ?></p>
                                <p><strong>Estado:</strong> <?php echo $cita->estado; ?></p>
                            </div>
                        </div>
                        
                        <?php echo form_open('cobro/registrar/'.$cita->idCita); ?>
                            <div class="form-group">
                                <label for="metodoPago">Método de Pago</label>
                                <select class="form-control" id="metodoPago" name="metodoPago" required>
                                    <option value="">Seleccione un método de pago</option>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Tarjeta de Crédito">Tarjeta de Crédito</option>
                                    <option value="Tarjeta de Débito">Tarjeta de Débito</option>
                                    <option value="Transferencia Bancaria">Transferencia Bancaria</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Confirmar Pago</button>
                            <a href="<?php echo base_url('cita'); ?>" class="btn btn-secondary">Cancelar</a>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>