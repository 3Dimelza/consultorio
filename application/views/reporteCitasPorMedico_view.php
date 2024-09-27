<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Reporte de Citas por Médico</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('reporte'); ?>">Reportes</a></li>
                            <li class="breadcrumb-item"><a href="#!">Citas por Médico</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Citas por Médico</h5>
                        <a href="<?php echo base_url('reporte/generarPDF/citasPorMedico'); ?>" class="btn btn-primary float-right">
                            Generar PDF
                        </a>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Médico</th>
                                        <th>Especialidad</th>
                                        <th>Total Citas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($reporte as $fila): ?>
                                    <tr>
                                        <td><?php echo $fila->nombreMedico; ?></td>
                                        <td><?php echo $fila->especialidad; ?></td>
                                        <td><?php echo $fila->totalCitas; ?></td>
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