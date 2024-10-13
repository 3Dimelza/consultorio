<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Registrar Pago</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('cobro'); ?>">Gestión de Cobros</a></li>
                            <li class="breadcrumb-item"><a href="#!">Registrar Pago</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Registrar Pago para la Cita #<?php echo $numero_correlativo; ?></h5>
                    </div>
                    <div class="card-body">
                        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger"><?php echo $this->session->flashdata('error'); ?></div>
                        <?php endif; ?>
                        
                        <?php echo form_open('cobro/registrar/'.$cita->idCita); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="paciente">Paciente</label>
                                        <input type="text" class="form-control" id="paciente" value="<?php echo $cita->nombre_paciente . ' ' . $cita->apellido_paciente; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="medico">Médico</label>
                                        <input type="text" class="form-control" id="medico" value="<?php echo $cita->nombre_medico . ' ' . $cita->apellido_medico; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha">Fecha y Hora</label>
                                        <input type="text" class="form-control" id="fecha" value="<?php echo date('d/m/Y H:i', strtotime($cita->fecha)); ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tipoAtencion">Tipo de Atención</label>
                                        <input type="text" class="form-control" id="tipoAtencion" value="<?php echo $cita->nombreTipoAtencion; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="monto">Monto a Pagar</label>
                                        <input type="text" class="form-control" id="monto" value="Bs. <?php echo number_format($cita->costoAtencion, 2); ?>" readonly>
                                    </div>
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
                                </div>
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