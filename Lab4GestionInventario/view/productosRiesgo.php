<?php
include_once 'public/header.php';
?>

<section class="recent">
    <div class="activity-card">
        <h3>
            Alertas de Inventario
            (<?php echo $vars['totalAlertas']; ?>)
        </h3>
        <form method="GET" action="index.php">
            <input type="hidden" name="controlador" value="Inventario">
            <input type="hidden" name="accion" value="mostrarAlertas">
            <select name="categoria">
                <option value="">Todas las categorías</option>
                <?php foreach ($vars['categorias'] as $categoria) { ?>
                    <option value="<?php echo $categoria; ?>"
                        <?php
                        if ($vars['categoriaSeleccionada'] == $categoria) {
                            echo 'selected';
                        }
                        ?>>
                        <?php echo $categoria; ?>
                    </option>
                <?php } ?>
            </select>
            <button type="submit" class="btn-add">
                <i class="fa-solid fa-magnifying-glass"></i> Filtrar
            </button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Categoría</th>
                    <th>Lote</th>
                    <th>Stock</th>
                    <th>Vencimiento</th>
                    <th>Nivel</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $counter = 1;
                foreach ($vars['alertas'] as $item) {
                ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo $item['nombre_producto']; ?></td>
                        <td><?php echo $item['categoria_producto']; ?></td>
                        <td><?php echo $item['codigo_lote']; ?></td>
                        <td><?php echo $item['cantidad_disponible']; ?></td>
                        <td><?php echo $item['fecha_vencimiento']; ?></td>
                        <td>
                            <?php
                            if ($item['nivel_alerta'] == 'Crítico') {
                            ?>
                                <span class="badge danger">
                                    <?php echo $item['nivel_alerta']; ?>
                                </span>
                            <?php
                            } else if ($item['nivel_alerta'] == 'Advertencia') {
                            ?>
                                <span class="badge warning">
                                    <?php echo $item['nivel_alerta']; ?>
                                </span>
                            <?php
                            } else {
                            ?>
                                <span class="badge info">
                                    <?php echo $item['nivel_alerta']; ?>
                                </span>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<?php
include_once 'public/footer.php';
?>