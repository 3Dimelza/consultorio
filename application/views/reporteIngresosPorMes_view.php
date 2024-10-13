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
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('reporte'); ?>">Reportes</a></li>
                            <li class="breadcrumb-item"><a href="#!">Ingresos por Mes</a></li>
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
                        <a href="<?php echo base_url('index.php/reporte/generarPDF/ingresosPorMes'); ?>" class="btn btn-primary float-right">
                            Generar PDF
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <canvas id="ingresosPorMesChart"></canvas>
                            </div>
                            <div class="col-md-4">
                                <h6>Resumen</h6>
                                <p>Total de ingresos: Bs. <?php echo number_format(array_sum(array_column($reporte, 'totalIngresos')), 2); ?></p>
                                <p>Promedio mensual: Bs. <?php echo number_format(array_sum(array_column($reporte, 'totalIngresos')) / count($reporte), 2); ?></p>
                                <p>Mes con mayores ingresos: <?php 
                                    $max = max(array_column($reporte, 'totalIngresos'));
                                    $maxMes = array_filter($reporte, function($item) use ($max) { return $item->totalIngresos == $max; });
                                    $maxMes = reset($maxMes);
                                    echo date('F Y', strtotime($maxMes->mes)) . ' (Bs. ' . number_format($max, 2) . ')';
                                ?></p>
                            </div>
                        </div>
                        <div class="table-responsive mt-4">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Mes</th>
                                        <th>Total Ingresos</th>
                                        <th>% del Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $totalIngresos = array_sum(array_column($reporte, 'totalIngresos'));
                                    foreach($reporte as $fila): 
                                    ?>
                                    <tr>
                                        <td><?php echo date('F Y', strtotime($fila->mes)); ?></td>
                                        <td>Bs. <?php echo number_format($fila->totalIngresos, 2); ?></td>
                                        <td><?php echo number_format(($fila->totalIngresos / $totalIngresos) * 100, 2); ?>%</td>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var ctx = document.getElementById('ingresosPorMesChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?php echo json_encode(array_map(function($item) { return date('F Y', strtotime($item->mes)); }, $reporte)); ?>,
        datasets: [{
            label: 'Ingresos por Mes',
            data: <?php echo json_encode(array_column($reporte, 'totalIngresos')); ?>,
            backgroundColor: 'rgba(75, 192, 192, 0.6)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Ingresos (Bs.)'
                }
            }
        }
    }
});
</script>