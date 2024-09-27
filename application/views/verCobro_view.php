<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Detalle del Cobro</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('cobro'); ?>">Gestión de Cobros</a></li>
                            <li class="breadcrumb-item"><a href="#!">Detalle del Cobro</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Detalle del Cobro #<?php echo $cobro->idCobro; ?></h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Paciente:</strong> <?php echo $cobro->nombrePaciente; ?></p>
                                <p><strong>Fecha de Cita:</strong> <?php echo date('d/m/Y H:i', strtotime($cobro->fechaCita)); ?></p>
                                <p><strong>Tipo de Atención:</strong> <?php echo $cobro->nombreTipoAtencion; ?></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Monto:</strong> Bs. <?php echo number_format($cobro->monto, 2); ?></p>
                                <p><strong>Método de Pago:</strong> <?php echo $cobro->metodoPago; ?></p>
                                <p><strong>Fecha de Cobro:</strong> <?php echo date('d/m/Y H:i', strtotime($cobro->fechaCobro)); ?></p>
                            </div>
                        </div>
                        <a href="<?php echo base_url('cobro/generarRecibo/'.$cobro->idCobro); ?>" class="btn btn-primary">Generar Recibo</a>
                        <a href="<?php echo base_url('cobro'); ?>" class="btn btn-secondary">Volver a la lista</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>