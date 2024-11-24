<?php
    include '../views/header.php';
    require_once __DIR__ . '/../php/controllers/categorias.php';
    $categorias = allCategorias();
?>
    <div class="content">
    <div class="header">
        <h1>Lista de categorías</h1>
        <a href="añadir_categorias.php" class="add-category-button">Añadir Categoría</a>
    </div>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($categorias) > 0): ?>
                    <?php foreach ($categorias as $cat): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cat['cat_id']); ?></td>
                            <td><?php echo htmlspecialchars($cat['cat_name']); ?></td>
                            <td><?php echo htmlspecialchars($cat['cat_description']); ?></td>
                            <td>
                                <a href="eliminar_categoria.php?id=<?php echo $cat['cat_id']; ?>" 
                                onclick="return confirm('¿Estás seguro de que deseas eliminar esta categoría?')">
                                    Eliminar
                                </a>
                                <a href="añadir_categorias.php?id=<?php echo $cat['cat_id']; ?>" class="btn btn-edit">Editar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No se encontraron categorias.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php include '../views/footer.php'; ?>