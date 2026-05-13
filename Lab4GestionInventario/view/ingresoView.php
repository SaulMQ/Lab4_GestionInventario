<?php
include_once 'public/header.php';
?>

<section class="form-section">

    <div class="form-container-card">

        <h2 class="form-title">
            Registrar Lote
        </h2>

        <?php
        $status = isset($_GET['status']) ? $_GET['status'] : '';
        ?>

        <?php if ($status == 'success'): ?>
            <div class="alert alert-success">
                Lote registrado correctamente.
            </div>
        <?php endif; ?>

        <?php if ($status == 'error'): ?>
            <div class="alert alert-error">
                Ocurrió un error al registrar el lote.
            </div>
        <?php endif; ?>

        <?php if ($status == 'fecha_error'): ?>
            <div class="alert alert-error">
                Una o más fechas de vencimiento son anteriores a la fecha actual.
            </div>
        <?php endif; ?>

        <?php if ($status == 'invalido'): ?>
            <div class="alert alert-error">
                Debe completar todos los campos obligatorios.
            </div>
        <?php endif; ?>

        <form method="POST" action="?controlador=Inventario&accion=registrarLote">

            <!-- LOTE EXISTENTE O NUEVO -->
            <div class="form-row">
                <div class="form-group">
                    <label>¿Agregar a un lote existente?</label>
                    <select name="id_lote_existente" id="id_lote_existente" onchange="toggleNuevoLote(this)">
                        <option value="">-- Crear nuevo lote --</option>
                        <?php foreach ($lotes as $lote): ?>
                            <option value="<?= $lote['ID_lote'] ?>">
                                <?= htmlspecialchars($lote['codigo_lote']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- CÓDIGO NUEVO LOTE -->
            <div class="form-row" id="nuevo-lote-row">
                <div class="form-group">
                    <label>Código de Lote nuevo <small>(opcional, se genera automáticamente)</small></label>
                    <input type="text" name="codigo_lote" placeholder="Ej: LOT-2026-001">
                </div>
            </div>

            <hr class="form-divider">

            <h3 style="margin-bottom: 12px;">Productos del Lote</h3>

            <!-- TABLA DINÁMICA DE PRODUCTOS -->
            <div id="productos-container">

                <!-- Fila 1 (mínimo una) -->
                <div class="producto-fila form-row" style="align-items: flex-end; gap: 12px;">

                    <div class="form-group" style="flex: 2;">
                        <label>Producto</label>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <select name="id_producto[]" required onchange="actualizarImagen(this)">
                                <option value="">-- Seleccione --</option>
                                <?php foreach ($productos as $p): ?>
                                    <option value="<?= $p['ID_producto'] ?>">
                                        <?= htmlspecialchars($p['nombre_producto']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <img
                                src=""
                                alt="imagen producto"
                                class="img-producto-preview"
                                style="width:40px; height:40px; object-fit:cover; border-radius:6px; display:none; border: 1px solid #ddd;">
                        </div>
                    </div>

                    <div class="form-group" style="flex: 1;">
                        <label>Cantidad</label>
                        <input type="number" name="cantidad[]" min="1" required placeholder="Ej: 50">
                    </div>

                    <div class="form-group" style="flex: 1;">
                        <label>Fecha de Vencimiento</label>
                        <input type="date" name="fecha_vencimiento[]" required>
                    </div>

                    <div class="form-group" style="flex: 0;">
                        <label style="visibility: hidden;">x</label>
                        <button
                            type="button"
                            class="btn-remove-fila"
                            onclick="eliminarFila(this)"
                            title="Eliminar fila"
                            style="display: none;">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>

                </div>
                <!-- fin fila 1 -->

            </div>
            <!-- fin productos-container -->

            <!-- BOTÓN AGREGAR PRODUCTO -->
            <div style="margin: 12px 0;">
                <button type="button" class="btn-secondary" onclick="agregarFila()">
                    <i class="fa-solid fa-plus"></i> Agregar otro producto
                </button>
            </div>

            <hr class="form-divider">

            <div class="form-actions-right">
                <button type="submit" class="btn-save">
                    Registrar Lote
                </button>
            </div>

        </form>

    </div>
</section>

<!-- Mapa de imágenes generado desde PHP -->
<script>
    const productosImagenes = {
        <?php foreach ($productos as $p): ?>
        "<?= $p['ID_producto'] ?>": "<?= htmlspecialchars($p['ruta_imagen_producto']) ?>",
        <?php endforeach; ?>
    };

    function actualizarImagen(select) {
        const img = select.parentElement.querySelector('.img-producto-preview');
        const idProducto = select.value;
        if (idProducto && productosImagenes[idProducto]) {
            img.src = productosImagenes[idProducto];
            img.style.display = 'inline-block';
        } else {
            img.src = '';
            img.style.display = 'none';
        }
    }

    function plantillaFila() {
        const options = Object.entries(productosImagenes).map(([id, img]) => {
            const nombre = document.querySelector(`option[value="${id}"]`)?.text || id;
            return `<option value="${id}">${nombre}</option>`;
        }).join('');

        return `
        <div class="producto-fila form-row" style="align-items: flex-end; gap: 12px;">
            <div class="form-group" style="flex: 2;">
                <label>Producto</label>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <select name="id_producto[]" required onchange="actualizarImagen(this)">
                        <option value="">-- Seleccione --</option>
                        ${options}
                    </select>
                    <img src="" alt="imagen producto" class="img-producto-preview"
                        style="width:40px; height:40px; object-fit:cover; border-radius:6px; display:none; border: 1px solid #ddd;">
                </div>
            </div>
            <div class="form-group" style="flex: 1;">
                <label>Cantidad</label>
                <input type="number" name="cantidad[]" min="1" required placeholder="Ej: 50">
            </div>
            <div class="form-group" style="flex: 1;">
                <label>Fecha de Vencimiento</label>
                <input type="date" name="fecha_vencimiento[]" required>
            </div>
            <div class="form-group" style="flex: 0;">
                <label style="visibility: hidden;">x</label>
                <button type="button" class="btn-remove-fila" onclick="eliminarFila(this)" title="Eliminar fila">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>
        </div>`;
    }

    function agregarFila() {
        const container = document.getElementById('productos-container');
        const div = document.createElement('div');
        div.innerHTML = plantillaFila();
        container.appendChild(div.firstElementChild);
        actualizarBotonesEliminar();
    }

    function eliminarFila(btn) {
        const fila = btn.closest('.producto-fila');
        fila.remove();
        actualizarBotonesEliminar();
    }

    function actualizarBotonesEliminar() {
        const filas = document.querySelectorAll('.producto-fila');
        filas.forEach((fila) => {
            const btn = fila.querySelector('.btn-remove-fila');
            btn.style.display = filas.length > 1 ? 'inline-block' : 'none';
        });
    }

    function toggleNuevoLote(select) {
        const row = document.getElementById('nuevo-lote-row');
        row.style.display = select.value ? 'none' : 'block';
    }

    actualizarBotonesEliminar();
</script>

<?php
include_once 'public/footer.php';
?>