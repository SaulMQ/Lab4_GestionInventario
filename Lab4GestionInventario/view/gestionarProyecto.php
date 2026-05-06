<?php
include_once 'public/header.php';
?>



<section class="table-section">
    <div class="table-container-card">
        <div class="table-header">
            <h2>Listado de Proyectos</h2>
            <button class="btn-add" onclick="window.location.href='?controlador=Proyecto&accion=mostrarformulario'">
                <i class="fa-solid fa-plus"></i> Nuevo
            </button>
        </div>

        <table class="management-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Inventario</th>
                    <th>Limite de seguridad</th>
                </tr>
            </thead>
            <tbody>

                <?php $counter = 1; foreach ($vars['listado'] as $item) { ?>
                    <tr>
                        <td><?php echo $counter++; ?></td>
                        <td><?php echo $item[0]; ?></td>
                        <td><?php echo $item[1]; ?></td>
                        <td><?php echo $item[2]; ?></td>

                        <?php if($item[1] >= $item[2] ){ ?>
                            <td><span class="badge success"><?php echo'Esta por encima del limite' ?></span></td>
                        <?php }else { ?>
                            <td><span class="badge warning"><?php echo 'Esta por debajo del limite' ?></span></td>
                        <?php } ?>
                        <td class="actions-cell">
                            <button class="btn-action edit" data-nombre="<?php echo $item[0]; ?>" title="Actualizar"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="btn-action delete" data-id="<?php echo $item[0]; ?>" title="Eliminar"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>


<?php
include_once 'view/modals/actualizarProyecto.php';
?>

<?php
include_once 'view/modals/spinnerCarga.php';
?>

<script>
    const modal = document.getElementById('editarProyecto');
    const btnCerrar = document.querySelector('.close-modal');
    const loader = document.getElementById('loader-overlay');

    // Lógica básica para botones
    document.querySelectorAll('.btn-action.delete').forEach(btn => {
        btn.addEventListener('click', function() {
            const nombre = this.getAttribute('data-id');

            if (confirm('¿Estás seguro de que deseas eliminar este proyecto?')) {
                loader.style.display = 'flex';

                const formData = new FormData();
                formData.append('nombre', nombre);

                fetch('?controlador=Proyecto&accion=eliminarProyecto', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        loader.style.display = 'none';
                        if (data.status === 'success') {
                            //alert('Registro eliminado correctamente ' + data.message);
                            
                            //this.closest('tr').remove();
                            this.closest('tr').style.opacity = '0';
                            setTimeout(() => this.closest('tr').remove(), 300);
                        } else {
                            alert('Error: ' + data.message);
                        }
                    })
                    .catch(error => {
                        //console.error('Error en la petición:', error);
                        loader.style.display = 'none';
                        alert('Hubo un problema al procesar la solicitud.');
                    });
            }
        });
    });
    // Abrir modal de edición
    document.querySelectorAll('.btn-action.edit').forEach(btn => {
        btn.addEventListener('click', function() {
            const nombre = this.getAttribute('data-nombre');
            modal.style.display = 'block';
            loader.style.display = 'flex';

            const fd = new FormData();
            fd.append('nombre', nombre);

            fetch('?controlador=Proyecto&accion=buscar', {
                    method: 'POST',
                    body: fd
                })
                .then(res => res.json())
                .then(res => {
                    if (res.status === 'success') {
                        document.getElementById('nombreOriginal').value = res.data.nombre;
                        document.getElementById('nombre').value = res.data.nombre;
                        document.getElementById('estado').value = res.data.estado;
                        document.getElementById('fecha').value = res.data.fecha;
                        modal.style.display = 'block';
                        loader.style.display = 'none';
                    }
                });

        });
    });

    // Cerrar modal
    btnCerrar.onclick = () => modal.style.display = 'none';
    window.onclick = (event) => {
        if (event.target == modal) modal.style.display = 'none';
    }

    // Realizar actualización
    document.getElementById('formularioEditarProyecto').addEventListener('submit', function(e) {
        e.preventDefault();

        const updateData = new FormData();
        updateData.append('nombre_original', document.getElementById('nombreOriginal').value);
        updateData.append('nombre', document.getElementById('nombre').value);
        updateData.append('estado', document.getElementById('estado').value);
        updateData.append('fecha', document.getElementById('fecha').value);

        fetch('?controlador=Proyecto&accion=actualizar', {
                method: 'POST',
                body: updateData
            })
            .then(res => res.json())
            .then(res => {
                if (res.status === 'success') {
                    alert(res.message);
                    location.reload();
                    modal.style.display = 'none';
                }
            });
    });
</script>

<?php
include_once 'public/footer.php';
?>