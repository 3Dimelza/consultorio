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
                        <a href="<?php echo base_url('index.php/reporte/citasPorMedico'); ?>" class="btn btn-primary">Ver Reporte</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ingresos por Mes</h5>
                        <p class="card-text">Genera un reporte de los ingresos mensuales.</p>
                        <a href="<?php echo base_url('index.php/reporte/ingresosPorMes'); ?>" class="btn btn-primary">Ver Reporte</a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pacientes Frecuentes</h5>
                        <p class="card-text">Genera un reporte de los pacientes más frecuentes.</p>
                        <a href="<?php echo base_url('index.php/reporte/pacientesFrecuentes'); ?>" class="btn btn-primary">Ver Reporte</a>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Lista de Pacientes</h5>
                        <p class="card-text">Genera un reporte de los pacientes en el sistema.</p>
                        <a href="<?php echo base_url('index.php/reporte/listapdfPaciente'); ?>" class="btn btn-primary">Ver Reporte</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Lista de Medicos</h5>
                        <p class="card-text">Genera un reporte de los medicos en el sistema.</p>
                        <a href="<?php echo base_url('index.php/reporte/listapdfMedico'); ?>" class="btn btn-primary">Ver Reporte</a>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Lista de Usuarioss</h5>
                        <p class="card-text">Genera un reporte de los Usuarios en el sistema.</p>
                        <a href="<?php echo base_url('index.php/reporte/listapdfUsuario'); ?>" class="btn btn-primary">Ver Reporte</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>