<?php
include '../views/header.php';
require_once __DIR__ . '/../php/controllers/auth.php';

// Obtén la categoría si es una edición
$cat_id = isset($_GET['id']) ? intval($_GET['id']) : null;
$category = null;

if ($cat_id) {
    // Cargar datos de la categoría si estamos en modo edición
    $allCategories = allCategorias(); // Obtén todas las categorías
    foreach ($allCategories as $cat) {
        if ($cat['cat_id'] == $cat_id) {
            $category = $cat;
            break;
        }
    }
}

// Valores predeterminados para el formulario
$cat_name = $category['cat_name'] ?? '';
$cat_description = $category['cat_description'] ?? '';
$action = $cat_id ? 'edit_category' : 'add_category'; // Define la acción
?>

<div class="content">
    <div class="header">
        <h1><?php echo $cat_id ? 'Editar Categoría' : 'Añadir Categoría'; ?></h1>
    </div>
    <form action="../php/controllers/categorias.php" method="POST" class="form-login">
        <input type="hidden" name="cat_id" value="<?php echo $cat_id; ?>"> <!-- ID para edición -->

        <div class="form-group">
            <label for="cat_name">Nombre:</label>
            <input type="text" id="cat_name" name="cat_name" value="<?php echo htmlspecialchars($cat_name); ?>" required>
        </div>
        <div class="form-group">
            <label for="cat_description">Descripción:</label>
            <textarea id="cat_description" name="cat_description" required><?php echo htmlspecialchars($cat_description); ?></textarea>
        </div>
        <button type="submit" name="action" value="<?php echo $action; ?>">
            <?php echo $cat_id ? 'Guardar Cambios' : 'Añadir Categoría'; ?>
        </button>
    </form>
</div>

<?php include '../views/footer.php'; ?>
