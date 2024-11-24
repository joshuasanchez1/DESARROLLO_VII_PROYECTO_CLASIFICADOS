<?php
    require_once __DIR__ . '/../config/dbConfig.php';

class Rol{
    private $table_name = "roles_rol";

    public $rol_id;
    public $rol_descripcion;
    public $rol_admin;
    public $rol_user;

    public function __construct($id, $nombre, $admin, $user)
    {
        $this->rol_id = $id;
        $this->rol_descripcion = $nombre;
        $this->rol_admin = $admin;
        $this->rol_user = $user;
    }

    public function getRol(){
        global $conn;
        $query = "SELECT * FROM  " . $this->table_name . " WHERE rol_id = :id";
        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $this->rol_id);

            // Ejecutar la consulta
            $stmt->execute();
            
            // Verificar si se encontró una fila
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $this->rol_descripcion = $row['rol_Descripcion'];
                $this->rol_admin = $row['rol_admin'];
                $this->rol_user = $row['rol_user'];
                return true; // Indica que los datos se cargaron correctamente
            } else {
                return false; // No se encontró ningún registro
            }
        } catch (PDOException  $e) {
            // Manejo de errores
            error_log("Error en getRol: " . $e->getMessage());
            return false;
        }
    }

    public static function getAllRoles()
    {
        global $conn;
        $table_name = "roles_rol";

        $query = "SELECT * FROM $table_name";
        try {
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los resultados como un arreglo asociativo
        } catch (PDOException $e) {
            // Manejo de errores
            error_log("Error en getAllRoles: " . $e->getMessage());
            return [];
        }
    }

    public function rolIsAdmin(){
        global $conn;
        $query = "SELECT * FROM  " . $this->table_name . " WHERE rol_id = :id";
        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $this->rol_id);

            $stmt->execute();
            
            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $isAdmin = $row['rol_admin'];

                if ($isAdmin === 'S') {
                    return true; 
                }
                
            } else {
                return false; // No se encontró ningún registro
            }

            return false;
        } catch (PDOException  $e) {
            // Manejo de errores
            error_log("Error en getRol: " . $e->getMessage());
            return false;
        }
    }

    
}
?>