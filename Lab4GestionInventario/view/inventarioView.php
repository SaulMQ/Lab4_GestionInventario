<?php
include_once 'public/header.php';
?>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre Producto</th>
        <th>Categoria</th>
        <th>Ruta</th>
    </tr>

    <?php if (empty($vars['listado'])): ?>
        <tr>
            <td colspan="4">No hay productos registrados.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($vars['listado'] as $item): ?>
            <tr>
                <td data-label="ID"><?php echo $item[0]; ?></td>
                <td data-label="NombreProducto"><?php echo $item[1]; ?></td>
                <td data-label="Categoria"><?php echo $item[2]; ?></td>
                <td data-label="Ruta"><?php echo $item[3]; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

<?php
include_once 'public/footer.php';
?>