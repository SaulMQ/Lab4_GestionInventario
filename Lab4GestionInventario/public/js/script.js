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
});