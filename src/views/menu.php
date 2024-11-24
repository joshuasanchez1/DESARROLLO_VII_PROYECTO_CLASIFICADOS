<?php
    include __DIR__ . '/../php/controllers/rol.php';

    $rol = null;
    if (isset($_SESSION['id'])) {
        $isLoggedIn = true;
        $rol = $_SESSION['rol'];
    } else {
        $isLoggedIn = false;
        if (basename($_SERVER['PHP_SELF']) !== 'index.php') {
            header("Location: ../public/index.php");
            exit();
        }
    }

    
?>
<div class="sidebar">
    <ul>
        <li><a href="../public/index.php">Inicio</a></li>
        <?php if ($isLoggedIn): ?>
            <?php if (rIsAdmin($rol)) : ?>
                <li><a href="../public/administracion_rol.php">Administracion de Roles</a></li>
                <li><a href="../public/administracion_usuario.php">Administracion de Usuarios</a></li>
                <li><a href="../public/administracion_categorias.php">Administracion de Categorias</a></li>
            <?php else : ?>
                <li><a href="../public/misAnuncios.php">Mis Anuncios</a></li>
            <?php endif ?>
        <li><a href="../views/logout.php">Cerrar Sesión</a></li>
        <?php endif; ?>
    </ul>
</div> 

<style>
    .sidebar {
        top: 60px !important; /* Altura del navbar */
    }
</style>