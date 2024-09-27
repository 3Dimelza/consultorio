<!-- application/views/pdf/cita_detalle.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Detalle de Cita</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .details { margin-bottom: 20px; }
        .details table { width: 100%; border-collapse: collapse; }
        .details th, .details td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .footer { text-align: center; font-size: 12px; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Detalle de Cita #<?php echo $cita->idCita; ?></h1>
    </div>
    <div class="details">
        <table>
            <tr>
                <th>Paciente:</th>
                <td><?php echo $cita->nombre_paciente . ' ' . $cita->apellido_paciente; ?></td>
            </tr>
            <tr>
                <th>Médico:</th>
                <td><?php echo $cita->nombre_medico . ' ' . $cita->apellido_medico; ?></td>
            </tr>
            <tr>
                <th>Especialidad:</th>
                <td><?php echo $cita->especialidad; ?></td>
            </tr>
            <tr>
                <th>Fecha y Hora:</th>
                <td><?php echo date('d/m/Y H:i', strtotime($cita->fecha)); ?></td>
            </tr>
            <tr>
                <th>Tipo de Atención:</th>
                <td><?php echo $cita->nombreTipoAtencion; ?></td>
            </tr>
            <tr>
                <th>Costo:</th>
                <td>Bs. <?php echo number_format($cita->costoAtencion, 2); ?></td>
            </tr>
            <tr>
                <th>Motivo de Consulta:</th>
                <td><?php echo $cita->motivoConsulta; ?></td>
            </tr>
            <tr>
                <th>Estado:</th>
                <td><?php echo $cita->estado == 1 ? 'Activa' : 'Cancelada'; ?></td>
            </tr>
        </table>
    </div>
    <div class="footer">
        <p>Este documento es una constancia de la cita médica programada.</p>
    </div>
</body>
</html>