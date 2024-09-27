<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Citas por Médico</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte de Citas por Médico</h1>
        <p>Fecha de generación: <?php echo date('d/m/Y H:i'); ?></p>
    </div>
    <table>
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
</body>
</html>