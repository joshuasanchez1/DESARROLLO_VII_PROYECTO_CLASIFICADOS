<?php
    require_once __DIR__ . '/../config/dbConfig.php';

class Anuncions{
    private $table_name = "anuncios_ads";

    public $ads_id;
    public $ads_title;
    public $ads_description;
    public $ads_price;
    public $ads_usr_id;
    public $ads_category_id;

    public function __construct($id, $title, $descripcion, $price, $usr_id, $ads_category_id)
    {
        $this->ads_id = $id;
        $this->ads_title = $title;
        $this->ads_description = $descripcion;
        $this->ads_price = $price;
        $this->ads_usr_id = $usr_id;
        $this->ads_category_id = $ads_category_id;
    }

    public function addAnuncio() {
        global $conn;

        $query = "INSERT INTO ".$this->table_name.
                 " (ads_title, ads_description, ads_price, ads_usr_id, ads_category_id)
                  VALUES (:tittle, :description, :price, :usr_id, :category_id)";
        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':tittle', $this->ads_title);
            $stmt->bindParam(':description', $this->ads_description);
            $stmt->bindParam(':price', $this->ads_price);
            $stmt->bindParam(':usr_id', $this->ads_usr_id);
            $stmt->bindParam(':category_id', $this->ads_category_id);
            $stmt->execute();

            $this->ads_id = $conn->lastInsertId();

            return true; // Devuelve verdadero si la inserción fue exitosa
        } catch (PDOException $e) {
            error_log("Error en addAnuncio: " . $e->getMessage());
            return false; // Devuelve falso si hubo un error
        }
    }

    public function updateAnuncio() {
        global $conn;
    
        $query = "UPDATE " . $this->table_name . " 
                  SET ads_title = :tittle, ads_description = :description, 
                      ads_price = :price, ads_usr_id = :usr_id, ads_category_id = :category_id
                  WHERE ads_id = :ads_id";
    
        try {
            $stmt = $conn->prepare($query);
    
            $stmt->bindParam(':tittle', $this->ads_title);
            $stmt->bindParam(':description', $this->ads_description);
            $stmt->bindParam(':price', $this->ads_price);
            $stmt->bindParam(':usr_id', $this->ads_usr_id);
            $stmt->bindParam(':category_id', $this->ads_category_id);
            $stmt->bindParam(':ads_id', $this->ads_id);
    
            $stmt->execute();
    
            return true; // Devuelve verdadero si la actualización fue exitosa
        } catch (PDOException $e) {
            error_log("Error en updateAnuncio: " . $e->getMessage());
            return false; // Devuelve falso si hubo un error
        }
    }
    

    public function deleteAnuncio() {
        global $conn;

        $query = "DELETE FROM ".$this->table_name." WHERE ads_id = :id";
        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $this->ads_id);
            $stmt->execute();

            return true; // Devuelve verdadero si la inserción fue exitosa
        } catch (PDOException $e) {
            error_log("Error en deleteAnuncio: " . $e->getMessage());
            return false; // Devuelve falso si hubo un error
        }
    }

    public function getAllAds()
    {
        global $conn;
        $table_name = "anuncios_ads";

        $query = "SELECT * FROM $table_name";
        try {
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los resultados como un arreglo asociativo
        } catch (PDOException $e) {
            // Manejo de errores
            error_log("Error en getAllAds: " . $e->getMessage());
            return [];
        }
    }

    public function getAllAdsImages(){
        global $conn;
        $table_name = "Anuncios_Con_Imagenes";

        $query = "SELECT * FROM $table_name";
        try {
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los resultados como un arreglo asociativo
        } catch (PDOException $e) {
            // Manejo de errores
            error_log("Error en getAllAdsImages: " . $e->getMessage());
            return [];
        }
    }

    public function getAllAdsImagesById(){
        global $conn;
        $table_name = "Anuncios_Con_Imagenes";

        $query = "SELECT * FROM $table_name WHERE ads_id = :id";
        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $this->ads_id);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los resultados como un arreglo asociativo
        } catch (PDOException $e) {
            // Manejo de errores
            error_log("Error en getAllAdsImagesById: " . $e->getMessage());
            return [];
        }
    }

    public static function getAllAdsImagesByUsr($usr_id){
        global $conn;
        $table_name = "Anuncios_Con_Imagenes";

        $query = "SELECT * FROM $table_name WHERE ads_usr_id = $usr_id";
        try {
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve todos los resultados como un arreglo asociativo
        } catch (PDOException $e) {
            // Manejo de errores
            error_log("Error en getAllAdsImagesByUsr: " . $e->getMessage());
            return [];
        }
    }
}
?>