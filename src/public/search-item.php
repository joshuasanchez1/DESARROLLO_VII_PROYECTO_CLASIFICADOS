<?php   
include '../views/header.php';
require_once __DIR__ . '../../php/controllers/anuncio.php';

// Obtener el ID de la categoría desde la URL
$categoryId = isset($_GET['category']) ? intval($_GET['category']) : null;

// Obtener los anuncios según la categoría, o todos si no hay categoría seleccionada
if ($categoryId) {
    $allAnuncios = allAnunciosByCategory($categoryId);
} else {
    $allAnuncios = allAnuncios();
}
?>

<div class="content">

    <?php include '../views/search.php'; ?>

    <?php
        if ($allAnuncios) {
            // Mostrar los anuncios como tarjetas
            echo '<div class="product-grid">';
            foreach ($allAnuncios as $anuncio) {
                // Mostrar cada anuncio en una tarjeta
                echo '<div class="product-card">';
                echo '<img src="' . $anuncio['ads_image_url'] . '" alt="' . $anuncio['ads_title'] . '">';
                echo '<h3> vendedor '. $anuncio['name']. ' - ' . $anuncio['ads_title'] . '</h3>';
                echo '<p class="price">$' . number_format($anuncio['ads_price'], 2) . '</p>';
                echo '<p class="description">' . $anuncio['ads_description'] . '</p>';
                echo '<button>Ver mas</button>';
                echo '</div>';
            }
            echo '</div>';
        } else {
            echo '<p>No anuncios found.</p>';
        }
    ?>
</div>

<?php include '../views/footer.php'; ?> 
