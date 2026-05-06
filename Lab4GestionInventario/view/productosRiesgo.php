<?php
include_once 'public/header.php';
?>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Cantidad</th>
        <th>Límite</th>
        <th>Faltante</th>
    </tr>

    <?php if (empty($vars['listadoRiesgo'])): ?>
        <tr>
            <td colspan="5">Todos los productos están dentro del límite de seguridad.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($vars['listadoRiesgo'] as $item): ?>
            <tr>
                <td data-label="ID"><?php echo $item[0]; ?></td>
                <td data-label="Nombre"><?php echo $item[1]; ?></td>
                <td data-label="Cantidad"><?php echo $item[2]; ?></td>
                <td data-label="Límite"><?php echo $item[3]; ?></td>
                <td data-label="Faltante"><?php echo $item[4]; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

<?php
include_once 'public/footer.php';
?>