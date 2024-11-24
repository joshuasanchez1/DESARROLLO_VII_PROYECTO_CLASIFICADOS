<?php
require_once __DIR__ . '/../php/controllers/categorias.php';

header('Content-Type: application/json');

// Obtener todas las categorías desde la base de datos
$categorias = allCategorias();

echo json_encode($categorias);
?>
