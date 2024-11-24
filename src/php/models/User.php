<?php
require_once __DIR__ . '/../config/dbConfig.php';
class User
{
    private $table_name = "users_usr";

    public $usr_id;
    public $usr_rol_id = 1;
    public $usr_name;
    public $usr_email;
    public $usr_password;

    public function __construct($id, $nombre, $email, $password)
    {
        $this->usr_id = $id;
        $this->usr_name = $nombre;
        $this->usr_email = $email;
        $this->usr_password = $password;
    }

    public function register()
    {
        global $conn;
        // Verificar si el correo ya está registrado
        $query = "INSERT INTO " . $this->table_name . " (usr_rol_id, usr_name, usr_email, usr_password, usr_created_at)
                  VALUES (:rol,:name, :email, :password, NOW())";
        try {

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':rol', $this->usr_rol_id);
            $stmt->bindParam(':name', $this->usr_name);
            $stmt->bindParam(':email', $this->usr_email);
            $stmt->bindParam(':password', $this->usr_password);

            if ($stmt->execute()) {
                return header("Location: ../../public/signup.php?success=Usuario registrado con éxito");
                exit();
            }

            return header("Location: ../../public/signup.php?error=ocurrio un error extraño");
            exit();
        } catch (PDOException  $e) {
            if ($e->getCode() == 23000) {
                return header("Location: ../../public/signup.php?error=El correo ya está registrado");
                exit();
            } else {
                return header("Location: ../../public/signup.php?error=error" . $e->getMessage());
                exit();
            }
        }
    }

    public function login()
    {
        global $conn;

        $query = "SELECT usr_id, usr_name, usr_rol_id, usr_email FROM " . $this->table_name . " where usr_email = :email and usr_password = :password";
        try {

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':email', $this->usr_email);
            $stmt->bindParam(':password', $this->usr_password);

            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $this->usr_id = $row['usr_id'];
                $this->usr_name = $row['usr_name'];
                $this->usr_rol_id = $row['usr_rol_id'];

                return true;
            }

            return false;
        } catch (PDOException  $e) {
            return false;
        }
    }

    public static function getAllUsers()
    {
        global $conn;
        $table_name = "users_usr";

        $query = "SELECT * FROM $table_name";
        try {
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los resultados como un arreglo asociativo
        } catch (PDOException $e) {
            // Manejo de errores
            error_log("Error en getAllUsers: " . $e->getMessage());
            return [];
        }
    }
    public function getUserInfo()
    {
        global $conn;
        $table_name = "users_usr";
        $id = $this->usr_id;

        $query = "SELECT * FROM $table_name where usr_id = :id";
        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":id", $id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los resultados como un arreglo asociativo
        } catch (PDOException $e) {
            // Manejo de errores
            error_log("Error en getUserInfo: " . $e->getMessage());
            return [];
        }
    }

    public function eliminar_usuario()
    {
        global $conn;
        $table_name = "users_usr";
        $query = "DELETE from $table_name WHERE usr_id = :id";
        try {

            $stmt = $conn->prepare($query);
            $stmt->bindParam(":id", $this->usr_id);
            if ($stmt->execute()) {
                return header("Location: administracion_usuario.php");
                exit();
            }
        } catch (PDOException $e) {
            echo "Usuario no eliminado";
        }
    }

    public function updateUsuario()
    {
        global $conn;
        $table_name = "users_usr";

        $query = "UPDATE $table_name
              SET usr_rol_id = :rol, usr_name = :name, usr_email = :email, usr_updated_at = NOW()
              WHERE usr_id = :id";
        try {
            $stmt = $conn->prepare($query);

            // Bind parameters
            $stmt->bindParam(':id', $this->usr_id);
            $stmt->bindParam(':rol', $this->usr_rol_id);
            $stmt->bindParam(':name', $this->usr_name);
            $stmt->bindParam(':email', $this->usr_email);

            // Execute the query
            if ($stmt->execute()) {
                return header("Location: administracion_usuario.php?success=Usuario actualizado con éxito");
                exit();
            }

            return header("Location: administracion_usuario.php?error=Ocurrió un error al actualizar el usuario");
            exit();
        } catch (PDOException $e) {
            // Handle exceptions
            error_log("Error en update: " . $e->getMessage());
            return header("Location: administracion_usuario.php?error=Error: " . $e->getMessage());
            exit();
        }
    }
}
