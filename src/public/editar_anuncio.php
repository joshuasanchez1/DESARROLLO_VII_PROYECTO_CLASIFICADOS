<?php
include '../views/header.php';
require_once __DIR__ . '/../php/controllers/anuncio.php';
require_once __DIR__ . '/../php/controllers/categorias.php';

// Obtén el ID del anuncio si es una edición
$ads_id = isset($_GET['id']) ? intval($_GET['id']) : null;
$anuncio = null;

// Cargar datos del anuncio si se proporciona el ID
if ($ads_id) {
    $anuncio = allAnunciosById($ads_id);
}


// Cargar todas las categorías para el select
$categorias = allCategorias();

// Valores predeterminados para el formulario
if (!empty($anuncio) && isset($anuncio[0])) {
    $ads_data = $anuncio[0];
    $ads_titulo = $ads_data['ads_title'] ?? '';
    $ads_descripcion = $ads_data['ads_description'] ?? '';
    $ads_categoria = $ads_data['ads_category_id'] ?? '';
    $ads_precio = $ads_data['ads_price'] ?? '';
    $ads_url = $ads_data['ads_image_url'];
} else {
    $ads_titulo = '';
    $ads_descripcion = '';
    $ads_categoria = '';
    $ads_precio = '';
}
$action = $ads_id ? 'editar_anuncio' : 'crear_anuncio'; // Define la acción
?>

<div class="content">
    <h1><?php echo $ads_id ? 'Editar Anuncio' : 'Crear Anuncio'; ?></h1>

    <form class="form-login" action="../php/controllers/anuncio.php" method="post" enctype="multipart/form-data">
        <!-- ID del anuncio para edición -->
        <input type="hidden" name="ads_id" value="<?php echo $ads_id; ?>">

        <div class="form-group">
            <label for="ads_titulo_ea">Titulo</label>
            <input type="text" id="ads_titulo_ea" name="ads_titulo_ea" value="<?php echo htmlspecialchars($ads_titulo); ?>" required />
        </div>

        <div class="form-group">
            <label for="ads_descripcion_ea">Descripcion</label>
            <textarea id="ads_descripcion_ea" name="ads_descripcion_ea" required><?php echo htmlspecialchars($ads_descripcion); ?></textarea>
        </div>

        <div class="form-group">
            <label for="ads_categoria_ea">Categoria</label>
            <select id="ads_categoria_ea" name="ads_categoria_ea" required>
                <option value="">Seleccione una categoría</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?php echo $categoria['cat_id']; ?>" <?php echo ($ads_categoria == $categoria['cat_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($categoria['cat_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="ads_precio_ea">Precio</label>
            <input type="number" step="0.01" id="ads_precio_ea" name="ads_precio_ea" value="<?php echo htmlspecialchars($ads_precio); ?>" required />
        </div>

        <div class="form-group">
            <label for="file_ea">Imagen</label>
            <input type="file" id="file_ea" name="file_ea" accept="image/*" <?php echo $ads_id ? '' : 'required'; ?>>
        </div>

        <div>
            <img id="preview" src="<?php echo $ads_url; ?>" alt="<?php echo $ads_titulo; ?>" style="max-width: 300px; max-height: 300px;">
        </div>

        <button type="submit" name="action" value="<?php echo $action; ?>">
            <?php echo $ads_id ? 'Guardar Cambios' : 'Crear Anuncio'; ?>
        </button>
    </form>

    <!-- Formulario para eliminar el anuncio -->
    <?php if ($ads_id): ?>
        <form method="POST" action="../php/controllers/anuncio.php" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este anuncio?');">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="ads_id" value="<?php echo $ads_id; ?>">
            <button type="submit" style="background-color: red; color: white;">
                Eliminar Anuncio
            </button>
        </form>
    <?php endif; ?>
</div>
<script type="module" src="JS/editar_anuncio.js"></script>
<?php include '../views/footer.php'; ?>
