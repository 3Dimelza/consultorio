<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Gestión de Citas</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Gestión de Citas</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Lista de Citas</h5>
                        <div class="card-header-right">
                            <a href="<?php echo base_url('index.php/cita/agregar'); ?>" class="btn btn-primary">Agendar Nueva Cita</a>
                        </div>
                    </div>
                    <div class="card-body table-border-style">
                        <?php if($this->session->flashdata('mensaje')): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $this->session->flashdata('mensaje'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <?php if($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $this->session->flashdata('error'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif; ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Paciente</th>
                                        <th>Médico</th>
                                        <th>Fecha y Hora</th>
                                        <th>Motivo</th>
                                        <th>Tipo de Atención</th>
                                        <th>Costo</th>
                                        <th>Estado de Pago</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($citas as $cita): ?>
                                    <tr>
                                        <td><?php echo $this->Cita_model->obtenerNumeroCorrelativo($cita->idCita); ?></td>
                                        <td><?php echo $cita->nombre_paciente . ' ' . $cita->apellido_paciente; ?></td>
                                        <td><?php echo $cita->nombre_medico . ' ' . $cita->apellido_medico; ?></td>
                                        <td><?php echo date('d/m/Y H:i', strtotime($cita->fecha)); ?></td>
                                        <td><?php echo $cita->motivoConsulta; ?></td>
                                        <td><?php echo $cita->nombreTipoAtencion; ?></td>
                                        <td>Bs. <?php echo number_format($cita->costoAtencion, 2); ?></td>
                                        <td>
                                            <?php if ($cita->idCobro): ?>
                                                <span class="badge badge-success">Pagado</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning">Pendiente</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="<?php echo base_url('index.php/cita/ver/'.$cita->idCita); ?>" class="btn btn-info btn-sm">
                                                    <i class="feather icon-eye"></i> Ver
                                                </a>
                                                <a href="<?php echo base_url('index.php/cita/modificar/'.$cita->idCita); ?>" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i> Modificar
                                                </a>
                                                <?php if($cita->estado == 1): ?>
                                                    <a href="<?php echo base_url('index.php/cita/cancelar/'.$cita->idCita); ?>" class="btn btn-warning btn-sm" onclick="return confirm('¿Está seguro de que desea cancelar esta cita?');">
                                                        <i class="fas fa-ban"></i> Cancelar
                                                    </a>
                                                <?php endif; ?>
                                                
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