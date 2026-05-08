<?php
include_once 'public/header.php';
?>
<?php include 'modals/modal_retiro.php'; ?>

<section class="recent">
    <div class="activity-card">
        <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 20px;">
            <h3>Proyectos Recientes</h3>
        </div>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Inventario</th>
                    <th>Limite de seguridad</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php $counter = 1;
                foreach ($listado as $item) { ?>
                    <tr>

                        <td><?php echo $counter++; ?></td>

                        <td><?php echo $item['nombre']; ?></td>

                        <td><?php echo $item['inventario']; ?></td>

                        <td><?php echo $item['limite_seguridad']; ?></td>

                        <td>
                            <?php if ($item['inventario'] >= $item['limite_seguridad']) { ?>
                                <span class="badge success">Suficiente</span>
                            <?php } else { ?>
                                <span class="badge warning">Bajo Stock</span>
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