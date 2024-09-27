<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Reporte de Ingresos por Mes</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcr
                            
                            </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Ingresos por Mes</h5>
                        <a href="<?php echo base_url('reporte/generarPDF/ingresosPorMes'); ?>" class="btn btn-primary float-right">
                            Generar PDF
                        </a>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Mes</th>
                                        <th>Total Ingresos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($reporte as $fila): ?>
                                    <tr>
                                        <td><?php echo date('F Y', strtotime($fila->mes)); ?></td>
                                        <td>Bs. <?php echo number_format($fila->totalIngresos, 2); ?></td>
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