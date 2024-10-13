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
                                            <td><?php echo isset($cita->nombrePaciente) ? $cita->nombrePaciente : 'N/A'; ?></td>
                                            <td><?php echo isset($cita->fechaCita) ? date('d/m/Y H:i', strtotime($cita->fechaCita)) : 'N/A'; ?></td>
                                            <td><?php echo isset($cita->nombreTipoAtencion) ? $cita->nombreTipoAtencion : 'N/A'; ?></td>
                                            <td>Bs. <?php echo isset($cita->costoAtencion) ? number_format($cita->costoAtencion, 2) : 'N/A'; ?></td>
                                            <td>
                                                <a href="<?php echo base_url('cobro/registrar/'.$cita->idCita); ?>" class="btn btn-success btn-sm">Registrar Pago</a>
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
                                            <td><?php echo isset($cobro->nombrePaciente) ? $cobro->nombrePaciente : 'N/A'; ?></td>
                                            <td><?php echo isset($cobro->fechaCita) ? date('d/m/Y H:i', strtotime($cobro->fechaCita)) : 'N/A'; ?></td>
                                            <td><?php echo isset($cobro->nombreTipoAtencion) ? $cobro->nombreTipoAtencion : 'N/A'; ?></td>
                                            <td>Bs. <?php echo isset($cobro->monto) ? number_format($cobro->monto, 2) : 'N/A'; ?></td>
                                            <td><?php echo isset($cobro->fechaCobro) ? date('d/m/Y H:i', strtotime($cobro->fechaCobro)) : 'N/A'; ?></td>
                                            <td><?php echo isset($cobro->metodoPago) ? $cobro->metodoPago : 'N/A'; ?></td>
                                            <td>
                                                <a href="<?php echo base_url('cobro/ver/'.$cobro->idCobro); ?>" class="btn btn-info btn-sm">Ver</a>
                                                <a href="<?php echo base_url('cobro/generarComprobante/'.$cobro->idCobro); ?>" class="btn btn-primary btn-sm">Generar Comprobante</a>
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
