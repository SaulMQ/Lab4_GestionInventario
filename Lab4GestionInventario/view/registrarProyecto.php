<?php
    include_once 'public/header.php';
?>



<section class="form-section">
    <div class="form-container-card">
        <form id="projectoForm" method="POST" action="?controlador=Proyecto&accion=registrarproyecto">
            <div class="form-row">
                <div class="form-group">
                    <label for="projectName">Nombre del Proyecto</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Ej: App Web" required>
                </div>
            </div>

            <div class="form-row split">
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="text" id="fecha" name="fecha" required>
                </div>

                <div class="form-group">
                    <label for="status">Estado</label>
                    <select id="status" name="estado">
                        <option value="completado">Completado</option>
                        <option value="pendiente">Pendiente</option>
                        <option value="en-progreso">En progreso</option>
                    </select>
                </div>

            </div>

            <hr class="form-divider">

            <div class="form-actions-right">
                <button type="submit" class="btn-save">Guardar Proyecto</button>
            </div>
        </form>
    </div>
</section>


<?php
    include_once 'public/footer.php';
?>