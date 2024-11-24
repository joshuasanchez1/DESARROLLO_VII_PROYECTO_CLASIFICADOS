// Obtener los elementos del DOM
const fileInput = document.getElementById('file_ea');
const previewImage = document.getElementById('preview');

// Escuchar el evento "change" del input file
fileInput.addEventListener('change', function(event) {
    console.log('entro');
    const file = event.target.files[0]; // Obtener el archivo seleccionado
    if (file) {
        const reader = new FileReader();

        // Cuando se cargue el archivo, actualizar la src del <img>
        reader.onload = function(e) {
            previewImage.src = e.target.result;
        };

        reader.readAsDataURL(file); // Leer el archivo como una URL de datos
    }
});