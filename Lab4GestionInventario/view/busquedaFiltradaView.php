<?php
include_once 'public/header.php';

// Extraemos los filtros actuales para facilitar el uso en el HTML
$filtros = $vars['filtros'];
$q = htmlspecialchars($filtros['q']);
$cat_actual = $filtros['cat'];
$sort = $filtros['sort'];
$dir = $filtros['dir'];

// Función auxiliar para generar los links de ordenamiento (AC 2)
function getSortLink($columna, $sortActual, $dirActual, $q, $cat)
{
    $nuevaDir = ($sortActual == $columna && $dirActual == 'ASC') ? 'DESC' : 'ASC';
    return "?controlador=Busqueda&accion=mostrar&q=$q&cat=$cat&sort=$columna&dir=$nuevaDir";
}
?>

<section class="table-section">
    <div class="table-container-card">
        <div class="table-header">
            <h2>Buscador de Suministros - Banco de Alimentos</h2>
        </div>

        <div class="filter-container" style="padding: 20px; background: #f9f9f9; border-bottom: 1px solid #ddd;">
            <form method="GET" action="index.php" style="display: flex; gap: 15px; align-items: flex-end;">
                <input type="hidden" name="controlador" value="Busqueda">
                <input type="hidden" name="accion" value="mostrar">

                <div class="form-group">
                    <label>Buscar producto o lote:</label>
                    <input type="text" name="q" value="<?php echo $q; ?>" placeholder="Ej: Arroz o LOT-001" class="form-control">
                </div>

                <div class="form-group">
                    <label>Categoría:</label>
                    <select name="cat" class="form-control">
                        <option value="">Todas las categorías</option>
                        <?php foreach ($vars['categorias'] as $c) { ?>
                            <option value="<?php echo $c['categoria_producto']; ?>" <?php echo ($cat_actual == $c['categoria_producto']) ? 'selected' : ''; ?>>
                                <?php echo $c['categoria_producto']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <button type="submit" class="btn-add">
                    <i class="fa-solid fa-magnifying-glass"></i> Filtrar
                </button>

                <?php if (!empty($q) || !empty($cat_actual)) { ?>
                    <a href="?controlador=Busqueda&accion=mostrar"
                        style="text-decoration: none; color: #007bff; margin-left: 10px; font-size: 0.9rem;">
                        Limpiar filtros
                    </a>
                <?php } ?>
            </form>
        </div>

        <table class="management-table">
            <thead>
                <tr>
                    <th>
                        <a href="<?php echo getSortLink('nombre_producto', $sort, $dir, $q, $cat_actual); ?>">
                            Nombre <?php echo ($sort == 'nombre_producto') ? ($dir == 'ASC' ? '↑' : '↓') : '↕'; ?>
                        </a>
                    </th>
                    <th>Categoría</th>
                    <th>Lote</th>
                    <th>
                        <a href="<?php echo getSortLink('cantidad_disponible', $sort, $dir, $q, $cat_actual); ?>">
                            Stock <?php echo ($sort == 'cantidad_disponible') ? ($dir == 'ASC' ? '↑' : '↓') : '↕'; ?>
                        </a>
                    </th>
                    <th>Vencimiento (D,M,Y)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($vars['listado']) > 0) {
                    foreach ($vars['listado'] as $item) { ?>
                        <tr>
                            <td><strong><?php echo $item['nombre_producto']; ?></strong></td>
                            <td><?php echo $item['categoria_producto']; ?></td>
                            <td><?php echo $item['codigo_lote']; ?></td>
                            <td><?php echo $item['cantidad_disponible']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($item['fecha_vencimiento'])); ?></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 40px;">
                            <div class="no-results">
                                <p style="margin-top: 15px; font-size: 1.2rem;">No se encontraron suministros con esos criterios.</p>
                                <a href="?controlador=Busqueda&accion=mostrar" class="btn-add" style="display: inline-block; margin-top: 10px;">
                                    Limpiar filtros y ver todo
                                </a>
                            </div>
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