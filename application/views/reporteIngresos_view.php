<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Reporte de Ingresos</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Reporte de Ingresos</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Ingresos por Período</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="<?php echo base_url('index.php/cobro/reporteIngresos'); ?>">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="fechaInicio">Fecha de Inicio</label>
                                    <input type="date" class="form-control" id="fechaInicio" name="fechaInicio" value="<?php echo isset($_GET['fechaInicio']) ? $_GET['fechaInicio'] : ''; ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="fechaFin">Fecha de Fin</label>
                                    <input type="date" class="form-control" id="fechaFin" name="fechaFin" value="<?php echo isset($_GET['fechaFin']) ? $_GET['fechaFin'] : ''; ?>">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">Generar Reporte</button>
                                </div>
                            </div>
                        </form>
                        
                        <?php if (isset($ingresos) && !empty($ingresos)): ?>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Total Ingresos</th>
                                            <th>Cantidad de Citas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($ingresos as $ingreso): ?>
                                            <tr>
                                                <td><?php echo date('d/m/Y', strtotime($ingreso->fecha)); ?></td>
                                                <td>Bs. <?php echo number_format($ingreso->totalIngresos, 2); ?></td>
                                                <td><?php echo $ingreso->cantidadCitas; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Total</th>
                                            <th>Bs. <?php echo number_format(array_sum(array_column($ingresos, 'totalIngresos')), 2); ?></th>
                                            <th><?php echo array_sum(array_column($ingresos, 'cantidadCitas')); ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        <?php elseif (isset($ingresos)): ?>
                            <div class="alert alert-info">No se encontraron ingresos para el período seleccionado.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>