document.addEventListener('DOMContentLoaded', () => {
    fetch('../../src/views/categorias.php')
        .then(response => response.json())
        .then(categorias => {
            const container = document.getElementById('categories-container');
            categorias.forEach(categoria => {
                const div = document.createElement('div');
                div.className = 'category';
                div.textContent = categoria.cat_name; // Nombre de la categoría
                div.dataset.id = categoria.cat_id;   // ID de la categoría (si lo necesitas)
                // Evento clic
                div.addEventListener('click', () => {
                    // Redirigir a la página de búsqueda con la categoría seleccionada
                    window.location.href = `../../src/public/search-item.php?category=${categoria.cat_id}`;
                });

                container.appendChild(div);
            });
        })
        .catch(error => console.error('Error cargando categorías:', error));
});

document.getElementById("clear-button").addEventListener("click", () => {
    // Limpiar el campo de búsqueda
    const searchBar = document.getElementById("search-bar");
    searchBar.value = "";

    
});
