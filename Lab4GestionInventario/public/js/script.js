document.addEventListener('DOMContentLoaded', () => {
    const navLinks = document.querySelectorAll('.nav-links a');

    // Cambiar clase activa al hacer clic
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Simulación de búsqueda
    const searchInput = document.querySelector('.search-wrapper input');
    searchInput.addEventListener('keyup', (e) => {
        console.log("Buscando:", e.target.value);
        // Aquí podrías filtrar filas de la tabla
    });

    const projectForm = document.querySelector('#projectoForm');
    const dialog = document.querySelector('#successDialog');
    const dialogMessage = document.querySelector('#dialogMessage');
    const closeDialog = document.querySelector('#closeDialog');

    if (projectForm && dialog && dialogMessage && closeDialog) {
        projectForm.addEventListener('submit', (event) => {
            event.preventDefault();

            if (!projectForm.checkValidity()) {
                projectForm.reportValidity();
                return;
            }

            const nombreSelect = projectForm.querySelector('#nombre');
            const cantidadInput = projectForm.querySelector('#cantidad');
            const selectedText = nombreSelect.options[nombreSelect.selectedIndex]?.text || nombreSelect.value;
            const cantidadValue = Number(cantidadInput.value);
            const inventoryValue = Number(nombreSelect.options[nombreSelect.selectedIndex]?.dataset.inventory || '0');
            const limitValue = Number(nombreSelect.options[nombreSelect.selectedIndex]?.dataset.limit || '0');
            const newInventory = inventoryValue + cantidadValue;
            let statusMessage = '';

            if (limitValue > 0) {
                if (newInventory > limitValue) {
                    statusMessage = 'Esta por encima del límite.';
                } else if (newInventory === limitValue) {
                    statusMessage = 'Esta en el límite.';   
                } else {
                    statusMessage = 'Esta por debajo del límite.';
                }
            }

            dialogMessage.textContent = `Guardado: ${selectedText} - Cantidad ${cantidadValue}. ${statusMessage}`;
            dialog.showModal();
        });

        closeDialog.addEventListener('click', () => {
            dialog.close();
            projectForm.submit();
        });
    }
});