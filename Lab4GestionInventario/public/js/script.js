// Antes (explota si el elemento no existe)
const searchInput = document.querySelector('.search-wrapper input');
searchInput.addEventListener('keyup', (e) => {

// Después (verifica que existe antes de usarlo)
const searchInput = document.querySelector('.search-wrapper input');
if (searchInput) {
    searchInput.addEventListener('keyup', (e) => {
        console.log("Buscando:", e.target.value);
        // Aquí podrías filtrar filas de la tabla
    });
}