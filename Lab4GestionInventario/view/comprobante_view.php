<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante de Retiro</title>
    <style>
        body { font-family: sans-serif; padding: 30px; text-align: center; }
        .ticket { border: 1px solid #ccc; padding: 20px; display: inline-block; width: 300px; }
        .no-print { margin-top: 20px; }
        @media print { .no-print { display: none; } } /* Oculta botones al imprimir */
    </style>
</head>
<body>
    <div class="ticket">
        <h3>BANCO DE ALIMENTOS</h3>
        <p><strong>Comprobante de Salida</strong></p>
        <hr>
        <p><strong>Beneficiario:</strong> <?php echo $vars['id']; ?></p>
        <p><strong>Fecha:</strong> <?php echo date("d/m/Y H:i"); ?></p>
    </div>

    <div class="no-print">
        <button onclick="window.print()">🖨️ Imprimir Comprobante</button>
        <br><br>
        <a href="index.php">Volver al Menú Principal</a>
    </div>
</body>
</html>