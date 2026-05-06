<?php
include_once 'public/header.php';
?>

<section class="form-section">
    <div class="form-container-card">
        <form id="entradaForm" method="POST" action="?controlador=Inventario&accion=agregarStock">
            <div class="form-row">
                <div class="form-group">
                    <label for="producto_id">Producto</label>
                    <select id="producto_id" name="producto_id" required>
                        <option value="">-- Seleccione un producto --</option>
                        <?php foreach ($vars['productos'] as $p): ?>
                            <option value="<?php echo $p[0]; ?>" data-stock="<?php echo $p[2]; ?>">
                                <?php echo $p[1]; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div id="stock-actual" style="display:none;" class="stock-badge">
                        Stock actual: <strong id="stock-valor">0</strong> unidades
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="cantidad">Cantidad a agregar</label>
                    <input type="number" id="cantidad" name="cantidad" min="1" placeholder="Ej: 10" required>
                </div>
            </div>

            <hr class="form-divider">

            <div class="form-actions-right">
                <button type="submit" class="btn-save">Agregar Stock</button>
            </div>

            <?php
            $status = isset($_GET['status']) ? $_GET['status'] : '';
            if ($status === 'success'): ?>
                <div class="alert alert-success"> Stock actualizado correctamente.</div>
            <?php elseif ($status === 'error'): ?>
                <div class="alert alert-error"> No se pudo actualizar el stock.</div>
            <?php elseif ($status === 'invalido'): ?>
                <div class="alert alert-error"> Datos inválidos o cantidad debe ser mayor a cero.</div>
            <?php endif; ?>

        </form>
        <script>
            document.getElementById('producto_id').addEventListener('change', function() {
                const selected = this.options[this.selectedIndex];
                const stockDiv = document.getElementById('stock-actual');
                const stockValor = document.getElementById('stock-valor');

                if (this.value === '') {
                    stockDiv.style.display = 'none';
                } else {
                    stockValor.textContent = selected.getAttribute('data-stock');
                    stockDiv.style.display = 'block';
                }
            });
        </script>
    </div>
</section>

<?php
include_once 'public/footer.php';
?>