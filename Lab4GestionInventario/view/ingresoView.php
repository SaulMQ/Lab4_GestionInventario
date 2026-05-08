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
                    <select name="id_producto" class="form-control" required>
    <option value="">-- Seleccione un producto --</option>
    
    <?php foreach($productos as $prod): ?>
    <option value="<?php echo $prod['id_producto']; ?>">
    <?php echo $prod['nombre']; ?>
    (Disponible: <?php echo $prod['inventario']; ?>)
</option>
<?php endforeach; ?>
    
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
                  <button type="reset" class="btn btn-secondary" data-dismiss="modal">
    Cancelar
</button>
                </menu>
            </dialog>

        </form>
    </div>
</section>


<?php
include_once 'public/footer.php';
?>