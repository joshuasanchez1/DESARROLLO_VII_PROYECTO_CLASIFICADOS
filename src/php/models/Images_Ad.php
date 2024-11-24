<?php
    require_once __DIR__ . '/../config/dbConfig.php';

class Images_Ad{
    private $table_name = "images_ad";
    private $Padre_tabla = "anuncios_ads";

    public $ad_id;
    public $ad_ads_id;
    public $ads_image_url;

    public function __construct($id, $ad_ads_id, $ads_image_url)
    {
        $this->ad_id = $id;
        $this->ad_ads_id = $ad_ads_id;
        $this->ads_image_url = $ads_image_url;
    }

    public function addImages_ad() {
        global $conn;

        $query = "INSERT INTO ".$this->table_name.
                 " (ad_ads_id, ads_image_url)
                  VALUES (:tittle, :description)";
        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':tittle', $this->ad_ads_id);
            $stmt->bindParam(':description', $this->ads_image_url);
            $stmt->execute();

            $this->ad_id = $conn->lastInsertId();

            return true; // Devuelve verdadero si la inserción fue exitosa
        } catch (PDOException $e) {
            error_log("Error en addImages_ad: " . $e->getMessage());
            return false; // Devuelve falso si hubo un error
        }
    }

    public function updateImages_ad() {
        global $conn;
    
        $query = "UPDATE " . $this->table_name . " 
                  SET ads_image_url = :image_url
                  WHERE ad_ads_id = :ads_id";
    
        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':image_url', $this->ads_image_url);
            $stmt->bindParam(':ads_id', $this->ad_ads_id);
    
            $stmt->execute();
    
            return true; // Devuelve verdadero si la actualización fue exitosa
        } catch (PDOException $e) {
            error_log("Error en updateImages_ad: " . $e->getMessage());
            return false; // Devuelve falso si hubo un error
        }
    }
    

    public function deleteImages_ad() {
        global $conn;

        $query = "DELETE FROM ".$this->table_name." WHERE ads_id = :id";
        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $this->ad_id);
            $stmt->execute();

            return true; // Devuelve verdadero si la inserción fue exitosa
        } catch (PDOException $e) {
            error_log("Error en deleteImages_ad: " . $e->getMessage());
            return false; // Devuelve falso si hubo un error
        }
    }

    public function getAdById()
    {
        global $conn;

        $query = "SELECT * FROM " .$this->table_name. "WHERE  ad_id = :id";
        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $this->ad_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los resultados como un arreglo asociativo
        } catch (PDOException $e) {
            // Manejo de errores
            error_log("Error en getAdById: " . $e->getMessage());
            return [];
        }
    }

    public static function getAllAd()
    {
        global $conn;
        $table_name = "images_ad";

        $query = "SELECT * FROM $table_name";
        try {
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los resultados como un arreglo asociativo
        } catch (PDOException $e) {
            // Manejo de errores
            error_log("Error en getAllAd: " . $e->getMessage());
            return [];
        }
    }

    
}
?>