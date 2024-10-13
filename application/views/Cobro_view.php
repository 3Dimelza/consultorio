<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Gestión de Cobros</h5>
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
                        <h5>Citas Pendientes de Pago</h5>
                    </div>
                    <div class="card-body table-border-style">
                        <?php if($this->session->flashdata('mensaje')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $this->session->flashdata('mensaje'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $this->session->flashdata('error'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Cita</th>
                                        <th>Paciente</th>
                                        <th>Fecha de Cita</th>
                                        <th>Tipo de Atención</th>
                                        <th>Monto</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($citas_pendientes)): ?>
                                        <?php foreach ($citas_pendientes as $cita): ?>
                                        <tr>
                                            <td><?php echo $cita->idCita; ?></td>
                                            <td><?php echo $cita->nombre_paciente . ' ' . $cita->apellido_paciente; ?></td>
                                            <td><?php echo date('d/m/Y H:i', strtotime($cita->fecha)); ?></td>
                                            <td><?php echo $cita->nombreTipoAtencion; ?></td>
                                            <td>Bs. <?php echo number_format($cita->costoAtencion, 2); ?></td>
                                            <td>
                                            <a href="<?php echo base_url('index.php/cobro/registrar/'.$cita->idCita); ?>" class="btn btn-success btn-sm rounded-pill">
                                                <i class="fas fa-money-bill-wave mr-1"></i> Registrar Pago
                                            </a>
                                        </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No hay citas pendientes de pago</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Cobros Realizados</h5>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Cobro</th>
                                        <th>ID Cita</th>
                                        <th>Paciente</th>
                                        <th>Fecha de Cita</th>
                                        <th>Tipo de Atención</th>
                                        <th>Monto</th>
                                        <th>Fecha de Pago</th>
                                        <th>Método de Pago</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($cobros)): ?>
                                        <?php foreach ($cobros as $cobro): ?>
                                        <tr>
                                            <td><?php echo $cobro->idCobro; ?></td>
                                            <td><?php echo $cobro->idCita; ?></td>
                                            <td><?php echo $cobro->nombrePaciente; ?></td>
                                            <td><?php echo date('d/m/Y H:i', strtotime($cobro->fechaCita)); ?></td>
                                            <td><?php echo $cobro->nombreTipoAtencion; ?></td>
                                            <td>Bs. <?php echo number_format($cobro->monto, 2); ?></td>
                                            <td><?php echo date('d/m/Y H:i', strtotime($cobro->fechaCobro)); ?></td>
                                            <td><?php echo $cobro->metodoPago; ?></td>
                                            <td>
                                                <a href="<?php echo base_url('index.php/cobro/ver/'.$cobro->idCobro); ?>" class="btn btn-info btn-sm">Ver</a>
                                                <a href="<?php echo base_url('index.php/cobro/generarComprobante/'.$cobro->idCobro); ?>" class="btn btn-primary btn-sm">Generar Comprobante</a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="9" class="text-center">No hay cobros registrados</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>