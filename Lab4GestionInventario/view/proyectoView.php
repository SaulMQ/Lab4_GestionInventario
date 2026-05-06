<?php
    include_once 'public/header.php';
?>

            <section class="recent">
                <div class="activity-card">
                    <h3>Proyectos Recientes</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Inventario</th>
                                <th>Limite de seguridad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $counter = 1; foreach($vars['listado'] as $item){ ?>
                                <tr>
                                    <td><?php echo $counter++; ?></td>
                                    <td><?php echo $item[0]; ?></td>
                                    <td><?php echo $item[1]; ?></td>
                                    <td><?php echo $item[2]; ?></td>

                                    <?php if($item[1] > $item[2] ){ ?>
                                        <td><span class="badge success"><?php echo'Esta por encima del limite' ?></span></td>
                                    <?php }else if($item[1] == $item[2] ){ ?>
                                        <td><span class="badge warning"><?php echo 'Esta en el limite' ?></span></td>
                                    <?php } else { ?>
                                        <td><span class="badge danger"><?php echo 'Esta por debajo del limite' ?></span></td>
                                    <?php } ?>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </section>

<?php
    include_once 'public/footer.php';
?>