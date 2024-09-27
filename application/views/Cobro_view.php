<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Lista de Cobros</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Gestión de Cobros</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Lista de Cobros</h5>
                        <a href="<?php echo base_url('cobro/agregar'); ?>" class="btn btn-primary float-right">
                            Registrar Nuevo Cobro
                        </a>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Paciente</th>
                                        <th>Fecha de Cita</th>
                                        <th>Monto</th>
                                        <th>Método de Pago</th>
                                        <th>Fecha de Cobro</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($cobros as $cobro): ?>
                                    <tr>
                                        <td><?php echo $cobro->idCobro; ?></td>
                                        <td><?php echo $cobro->nombrePaciente; ?></td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($cobro->fechaCita)); ?></td>
                                        <td>Bs. <?php echo number_format($cobro->monto, 2); ?></td>
                                        <td><?php echo $cobro->metodoPago; ?></td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($cobro->fechaCobro)); ?></td>
                                        <td>
                                            <a href="<?php echo base_url('cobro/ver/'.$cobro->idCobro); ?>" class="btn btn-info btn-sm">Ver</a>
                                            <a href="<?php echo base_url('cobro/generarRecibo/'.$cobro->idCobro); ?>" class="btn btn-success btn-sm">Generar Recibo</a>
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