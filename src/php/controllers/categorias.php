<?php
    require_once __DIR__ . '/../models/Categorias.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'] ?? '';
        $name = $_POST['cat_name'];
        $description = $_POST['cat_description'];
    
        if ($action === 'add_category') {
            // Lógica para añadir categoría
            $result = Categorias::addCategory($name, $description);
            $redirect = $result ? '../../public/administracion_categorias.php?message=success' : '../../views/añadir_categoria.php?message=error';
        } elseif ($action === 'edit_category') {
            // Lógica para editar categoría
            $id = intval($_POST['cat_id']);
            $result = Categorias::updateCategory($id, $name, $description);
            $redirect = $result ? '../../public/administracion_categorias.php?message=updated' : '../../views/añadir_categoria.php?id=' . $id . '&message=error';
        }
    
        // Redirige según el resultado
        header("Location: $redirect");
        exit;
    }
    

    function allCategorias(){
        return Categorias::getAllCategories();
    }
?>