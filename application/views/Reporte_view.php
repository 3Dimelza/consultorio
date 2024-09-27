<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Reportes</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Reportes</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Citas por Médico</h5>
                        <p class="card-text">Genera un reporte de las citas atendidas por cada médico.</p>
                        <a href="<?php echo base_url('reporte/reporteCitasPorMedico'); ?>" class="btn btn-primary">Ver Reporte</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ingresos por Mes</h5>
                        <p class="card-text">Genera un reporte de los ingresos mensuales de la clínica.</p>
                        <a href="<?php echo base_url('reporte/reporteIngresosPorMes'); ?>" class="btn btn-primary">Ver Reporte</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pacientes Frecuentes</h5>
                        <p class="card-text">Genera un reporte de los pacientes más frecuentes.</p>
                        <a href="<?php echo base_url('reporte/reportePacientesFrecuentes'); ?>" class="btn btn-primary">Ver Reporte</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>