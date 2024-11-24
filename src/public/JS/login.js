// Abrir el popup
const userIcon = document.getElementById('user-icon');

if (userIcon) {
    userIcon.addEventListener('click', function () {
        document.getElementById('popup').style.display = 'flex';
    });
}

// Cerrar el popup cuando se haga clic en el botón de cerrar
document.getElementById('cerrarPopup').addEventListener('click', function() {
    document.getElementById('popup').style.display = 'none';
});

// Cerrar el popup cuando se haga clic fuera del contenido
window.addEventListener('click', function(event) {
    const popup = document.getElementById('popup');
    if (event.target === popup) {
        popup.style.display = 'none';
    }
});