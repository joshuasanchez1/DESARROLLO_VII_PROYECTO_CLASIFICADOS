<?php
include '../views/header.php';
require_once __DIR__ . '/../php/controllers/auth.php';
$usuarios = allUsers();
?>
<div class="content">
    <h1>Lista de Usuarios</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Rol</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($usuarios) > 0): ?>
                <?php foreach ($usuarios as $usr): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($usr['usr_id']); ?></td>
                        <td><?php echo htmlspecialchars($usr['usr_rol_id']); ?></td>
                        <td><?php echo htmlspecialchars($usr['usr_name']); ?></td>
                        <td><?php echo htmlspecialchars($usr['usr_email']); ?></td>
                        <td><a href="editar_usuarios.php?id=<?php echo $usr['usr_id'] ?>&rol_id=<?php echo $usr['usr_rol_id'] ?>&name=<?php echo $usr['usr_name'] ?>&email=<?php echo $usr['usr_email'] ?>" ;>Editar</a></td>
                        <td><a href="eliminar_usuarios.php?id=<?php echo $usr['usr_id'] ?>" onclick="return confirm('Esta seguro que desea eliminar este usuario?')" ;>Eliminar</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No se encontraron usuarios.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<style>
    .content {
        margin-left: 250px;
        width: calc(100% - 220px);
    }
</style>
<?php include '../views/footer.php'; ?>