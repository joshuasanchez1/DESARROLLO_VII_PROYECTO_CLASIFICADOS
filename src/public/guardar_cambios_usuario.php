<?php
require_once "../php/models/User.php";

if (isset($_POST['usr_id'], $_POST['usr_name'], $_POST['usr_rol_id'], $_POST['usr_email'])) {
    $usr_id = $_POST['usr_id'];
    echo $usr_id . "<br>";
    $usr_name = $_POST['usr_name'];
    echo $usr_name . "<br>";
    $usr_rol_id = $_POST['usr_rol_id'];
    echo $usr_rol_id . "<br>";
    $usr_email = $_POST['usr_email'];
    echo $usr_email . "<br>";

    // Update user using the User class
    $user = new User($usr_id, $usr_name, $usr_email, null);
    $user->usr_rol_id = $usr_rol_id;
    $user->updateUsuario();
}
