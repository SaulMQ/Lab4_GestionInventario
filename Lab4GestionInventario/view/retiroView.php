<?php include_once 'public/header.php'; ?>

<section class="form-section">

    <div class="form-container-card">

        <h2>Registrar Retiro</h2>

        <form action="?controlador=Retiro&accion=procesarRetiro" method="POST">

            <div class="form-group">
                <label>Cédula del Beneficiario</label>

                <input
                    type="text"
                    name="id_beneficiario"
                    class="form-control"
                    required
                    maxlength="9"
                    pattern="[0-9]{9}"
                    placeholder="123456789"
                >
            </div>

            <div class="form-group">
                <label>Producto</label>

                <select name="id_producto" class="form-control" required>

                    <option value="">
                        -- Seleccione un producto --
                    </option>

                    <?php foreach($productos as $prod): ?>

                        <option value="<?php echo $prod['id_producto']; ?>">

                            <?php echo $prod['nombre']; ?>

                            (Disponible:
                            <?php echo $prod['inventario']; ?>)

                        </option>

                    <?php endforeach; ?>

                </select>
            </div>

            <div class="form-group">
                <label>Cantidad</label>

                <input
                    type="number"
                    name="cantidad"
                    class="form-control"
                    min="1"
                    required
                >
            </div>

            <br>

            <button type="submit" class="btn btn-primary">
                Confirmar Retiro
            </button>

        </form>

    </div>

</section>

<?php include_once 'public/footer.php'; ?>