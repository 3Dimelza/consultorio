<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Ingresos por Mes</title>
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
        <h1>Reporte de Ingresos por Mes</h1>
        <p>Fecha de generación: <?php echo date('d/m/Y H:i'); ?></p>
    </div>
    <table>
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
</body>
</html>