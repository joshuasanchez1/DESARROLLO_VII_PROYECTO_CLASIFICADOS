<?php
    include '../views/header.php';
    require_once __DIR__ . '/../php/controllers/rol.php';


    // Obtener todos los roles
    $roles = allRols();
?>

    <div class="content">
        <h1>Lista de Roles</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Es Admin</th>
                    <th>Es User</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($roles) > 0): ?>
                    <?php foreach ($roles as $rol): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($rol['rol_id']); ?></td>
                            <td><?php echo htmlspecialchars($rol['rol_Descripcion']); ?></td>
                            <td><?php echo htmlspecialchars($rol['rol_admin'] === 'S' ? 'Sí' : 'No'); ?></td>
                            <td><?php echo htmlspecialchars($rol['rol_user'] === 'S' ? 'Sí' : 'No'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No se encontraron roles.</td>
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