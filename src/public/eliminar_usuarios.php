<?php
require_once "../php/models/User.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = new User($id, null, null, null);
    $user->eliminar_usuario();
}
