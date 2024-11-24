<?php
include '../views/header.php';
require_once "../php/models/User.php";
// $usr_id = $usr_rol_id = $usr_name = $usr_email = null;
if (!isset($_GET["id"], $_GET["rol_id"], $_GET["name"], $_GET["email"])) {
    die("Error capturando valores");
}
$usr_id = $_GET["id"];
$usr_rol_id = $_GET["rol_id"];
$usr_name = $_GET["name"];
$usr_email = $_GET["email"];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
</head>

<body>
    <div class="content">
        <div class="header">
            <h1>Editar Usuario</h1>
        </div>
        <form action="guardar_cambios_usuario.php" method="POST" class="form-login">
            <input type="hidden" name="usr_id" value="<?php echo htmlspecialchars($usr_id); ?>">

            <div class="form-group">
                <label for="usr_name">Nombre Usuario:</label>
                <input type="text" id="usr_name" name="usr_name" value="<?php echo htmlspecialchars($usr_name); ?>" required>
            </div>
            <div class="form-group">
                <label for="usr_rol_id">Rol del usuario:</label>
                <textarea id="usr_rol_id" name="usr_rol_id" required><?php echo htmlspecialchars($usr_rol_id); ?></textarea>
            </div>
            <div class="form-group">
                <label for="usr_email">Email:</label>
                <textarea id="usr_email" name="usr_email" required><?php echo htmlspecialchars($usr_email); ?></textarea>
            </div>
            <button type="submit" name="submit" value="Guardar Cambios">
                Guardar Cambios
            </button>
        </form>
    </div>

</body>

</html>