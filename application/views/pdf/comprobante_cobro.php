<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .details { margin-bottom: 20px; }
        .details table { width: 100%; border-collapse: collapse; }
        .details th, .details td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .footer { text-align: center; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Comprobante de Pago</h1>
        <p>Fecha de emisión: <?php echo date('d/m/Y H:i'); ?></p>
    </div>

    <div class="details">
        <table>
            <tr>
                <th>Número de Comprobante:</th>
                <td><?php echo $cobro->idCobro; ?></td>
            </tr>
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
                <th>Monto Pagado:</th>
                <td>
                <td>Bs. <?php echo number_format($cobro->monto, 2); ?></td>
            </tr>
            <tr>
                <th>Fecha de Pago:</th>
                <td><?php echo date('d/m/Y H:i', strtotime($cobro->fechaCobro)); ?></td>
            </tr>
            <tr>
                <th>Método de Pago:</th>
                <td><?php echo $cobro->metodoPago; ?></td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Gracias por su pago. Este comprobante es válido como recibo de pago.</p>
        <p>Para cualquier consulta, por favor contacte con nuestro servicio de atención al cliente.</p>
    </div>
</body>
</html>