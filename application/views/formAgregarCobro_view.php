<div class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Registrar Nuevo Cobro</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('cobro'); ?>">Gestión de Cobros</a></li>
                            <li class="breadcrumb-item"><a href="#!">Registrar Cobro</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Registrar Nuevo Cobro</h5>
                    </div>
                    <div class="card-body">
                        <?php echo validation_errors('<div class="alert alert-danger">', '</div>'); ?>
                        <?php echo form_open('cobro/agregarbd'); ?>
                            <div class="form-group">
                                <label for="idCita">Cita</label>
                                <select name="idCita" class="form-control" required>
                                    <option value="">Seleccione una cita</option>
                                    <?php foreach($citas as $cita): ?>
                                        <option value="<?php echo $cita->idCita; ?>">
                                            <?php echo $cita->nombrePaciente . ' - ' . date('d/m/Y H:i', strtotime($cita->fecha)) . ' - Bs. ' . number_format($cita->costoAtencion, 2); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="monto">Monto</label>
                                <input type="number" step="0.01" class="form-control" name="monto" required>
                            </div>
                            <div class="form-group">
                                <label for="metodoPago">Método de Pago</label>
                                <select name="metodoPago" class="form-control" required>
                                    <option value="Efectivo">Efectivo</option>
                                    <option value="Tarjeta">Tarjeta</option>
                                    <option value="Transferencia">Transferencia</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Registrar Cobro</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>