// Abrir el popup-upload
document.getElementById('upload-icon').addEventListener('click', function() {
    document.getElementById('popup-upload').style.display = 'flex';
});

// Cerrar el popup-upload
document.getElementById('cerrarPopupUpload').addEventListener('click', function() {
    document.getElementById('popup-upload').style.display = 'none';
});

// Cerrar el popup cuando se haga clic fuera del contenido
window.addEventListener('click', function(event) {
    const popup = document.getElementById('popup');
    const popupUpload = document.getElementById('popup-upload');

    if (event.target === popup) {
        popup.style.display = 'none';
    }

    if (event.target === popupUpload) {
        popupUpload.style.display = 'none';
    }
});


document.addEventListener('DOMContentLoaded', () => {
    const categoriaSelect = document.getElementById('categoria');
    console.log(categoriaSelect);

    // Función para cargar las categorías
    const loadCategories = async () => {
        try {
            const response = await fetch('../../src/views/categorias.php'); // Asegúrate de que la ruta sea correcta
            const categories = await response.json();

            // Limpiar el select antes de agregar opciones
            categoriaSelect.innerHTML = '';

            // Agregar las categorías al select
            categories.forEach(category => {
                const option = document.createElement('option');
                option.value = category.cat_id;
                option.textContent = category.cat_name;
                categoriaSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error al cargar las categorías:', error);
        }
    };

    // Cargar las categorías al abrir el popup
    loadCategories();
});