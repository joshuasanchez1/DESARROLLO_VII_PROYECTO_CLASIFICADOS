<?php
    require_once __DIR__ . '/../config/dbConfig.php';
class Categorias{
    private $table_name = "categories_cat";

    public $cat_id;
    public $cat_name;
    public $cat_description;

    public function __construct($id, $nombre, $email)
    {
        $this->cat_id = $id;
        $this->cat_name = $nombre;
        $this->cat_description = $email;
    }

    public static function getAllCategories()
    {
        global $conn;
        $table_name = "categories_cat";

        $query = "SELECT * FROM $table_name";
        try {
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los resultados como un arreglo asociativo
        } catch (PDOException $e) {
            // Manejo de errores
            error_log("Error en getAllCategories: " . $e->getMessage());
            return [];
        }
    }

    public static function addCategory($name, $description) {
        global $conn;
        $table_name = "categories_cat";

        $query = "INSERT INTO $table_name (cat_name, cat_description) VALUES (:name, :description)";
        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->execute();
            return true; // Devuelve verdadero si la inserción fue exitosa
        } catch (PDOException $e) {
            error_log("Error en addCategory: " . $e->getMessage());
            return false; // Devuelve falso si hubo un error
        }
    }

    public static function updateCategory($id, $name, $description) {
        global $conn;
        $table_name = "categories_cat";

        $query = "UPDATE $table_name SET cat_name = :name, cat_description = :description WHERE cat_id = :id";
        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->execute();
            return true; // Devuelve verdadero si la actualización fue exitosa
        } catch (PDOException $e) {
            error_log("Error en updateCategory: " . $e->getMessage());
            return false;
        }
    }
}
?>