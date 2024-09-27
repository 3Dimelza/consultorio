<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recibo de Cobro</title>
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
        <h1>Recibo de Cobro</h1>
        <p>Recibo No: <?php echo $cobro->idCobro; ?></p>
    </div>
    <div class="details">
        <table>
            <tr>
                <th>Paciente:</th>
                <td><?php echo $cobro->nombrePaciente; ?></td>
            </tr>
            <tr>
                <th>Fecha de Cita:</th>
                <td><?php echo date('d/m/Y H:i', strtotime($cobro->fechaCita)); ?></td>
            </tr>
            <tr>
                <th>Tipo de Atención:</th>
                <td><?php echo $cobro->nombreTipoAtencion; ?></td>
            </tr>
            <tr>
                <th>Monto:</th>
                <td>Bs. <?php echo number_format($cobro->monto, 2); ?></td>
            </tr>
            <tr>
                <th>Método de Pago:</th>
                <td><?php echo $cobro->metodoPago; ?></td>
            </tr>
            <tr>
                <th>Fecha de Cobro:</th>
                <td><?php echo date('d/m/Y H:i', strtotime($cobro->fechaCobro)); ?></td>
            </tr>
        </table>
    </div>
    <div class="footer">
        <p>Este documento es un comprobante de pago. Gracias por su preferencia.</p>
    </div>
</body>
</html>