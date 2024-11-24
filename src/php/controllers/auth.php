<?php
    require_once __DIR__ . '/../models/User.php';
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    

    if (isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirm_password'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Validar si las contraseñas coinciden
        if ($password !== $confirm_password) {
            header("Location: ../../public/signup.php?error=Las contraseñas no coinciden");
            exit();
        }

        $user = new User(null, $name, $email, $confirm_password);

        $user->register();
    }
    if (isset($_POST['login_email'], $_POST['login_password'])){
        $email = $_POST['login_email'];
        $password = $_POST['login_password'];

        $user = new User(null, null, $email, $password);

        if ($user->login()){
            $_SESSION['id'] = $user->usr_id;
            $_SESSION['email'] = $user->usr_email;
            $_SESSION['rol'] = $user->usr_rol_id;
            $_SESSION['nombre'] = $user->usr_name;

            header("Location: ../../public/index.php");
            exit();
        }

        header("Location: ../../public/index.php?error=Credenciales invalidas");
        exit();
    }

    function allUsers(){
        return User::getAllUsers();
    };
?>
