<?php
    require_once __DIR__ . '/../models/Rol.php';


    function rIsAdmin($rol){
        $roles = new Rol($rol, null, null, null);

        return $roles->rolIsAdmin();
    }

    function allRols(){
        return Rol::getAllRoles();
    }
?>