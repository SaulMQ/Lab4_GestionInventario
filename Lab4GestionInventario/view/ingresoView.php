<?php
include_once 'public/header.php';
?>



<section class="form-section">
    <div class="form-container-card">
        <form id="projectoForm" method="POST" action="?controlador=Proyecto&accion=mostrarregistro">
            <div class="form-row">
                <div class="form-group">
                    <label for="nombre">Nombre del producto</label>
                    <!--<input type="text" id="nombre" name="nombre" placeholder="Ej: Monitores" required>-->
                    <select id="nombre" name="nombre" required>
                        <option value="">Seleccionar producto</option>
                        <?php foreach ($vars['listado'] as $item) { ?>
                            <option value="<?php echo $item[0]; ?>"
                                    data-inventory="<?php echo isset($item[1]) ? htmlspecialchars($item[1]) : ''; ?>"
                                    data-limit="<?php echo isset($item[2]) ? htmlspecialchars($item[2]) : ''; ?>">
                                <?php echo $item[0]; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="cantidad">Cantidad ingresada</label>
                    <input type="number" id="cantidad" name="cantidad" placeholder="Ej: 10" required min="1">
                </div>
            </div>

            <hr class="form-divider">

            <div class="form-actions-right">
                <button type="submit" class="btn-save">Guardar Registro</button>
            </div>

            <dialog id="successDialog">
                <p id="dialogMessage"></p>
                <menu>
                    <button id="closeDialog" type="button">Cerrar</button>
                </menu>
            </dialog>

        </form>
    </div>
</section>


<?php
include_once 'public/footer.php';
?>