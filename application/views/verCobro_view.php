<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Detalles de la Cita y Cobro</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('cobro'); ?>">Gestión de Cobros</a></li>
                            <li class="breadcrumb-item"><a href="#!">Detalles de la Cita y Cobro</a></li>
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
                    </div>
                </div>
            </div>
        </div>
        <?php if($cobro): ?>
        <div class="row mt-4">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Detalles del Cobro</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>ID Cobro:</strong> <?php echo $cobro->idCobro; ?></p>
                                <p><strong>Monto:</strong> Bs. <?php echo number_format($cobro->monto, 2); ?></p>
                                <p><strong>Número de Comprobante:</strong> <?php echo $cobro->numeroComprobante; ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Fecha de Pago:</strong> <?php echo date('d/m/Y H:i', strtotime($cobro->fechaCobro)); ?></p>
                                <p><strong>Método de Pago:</strong> <?php echo $cobro->metodoPago; ?></p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="<?php echo base_url('cobro/generarComprobante/'.$cobro->idCobro); ?>" class="btn btn-primary">
                                <i class="feather icon-file-text"></i> Generar Comprobante PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="row mt-4">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <p>Esta cita aún no tiene un cobro registrado.</p>
                        <a href="<?php echo base_url('cobro/registrar/'.$cita->idCita); ?>" class="btn btn-success">
                            <i class="feather icon-dollar-sign"></i> Registrar Pago
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <div class="mt-3">
            <a href="<?php echo base_url('cobro'); ?>" class="btn btn-secondary">
                <i class="feather icon-arrow-left"></i> Volver a la lista de cobros
            </a>
        </div>
    </div>
</div>