<?php
    require_once __DIR__ . '/../models/Anuncios.php';
    require_once __DIR__ . '/../models/Images_Ad.php';

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['id'])) {
        $isLoggedIn = true;
        $rol = $_SESSION['rol'];
    } else {
        $isLoggedIn = false;
        header("Location: ../../public/index.php?message=nosession");
        exit();
    }

    $dir_destinacion = __DIR__ . '/../../public/tmp_images/';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Variables comunes
        $action = $_POST['action'];
        $titulo = $_POST['ads_titulo'] ?? '';
        $descripcion = $_POST['ads_Descripcion'] ?? '';
        $categoria_id = $_POST['ads_categoria'] ?? '';
        $precio = $_POST['ads_precio'] ?? '';
        $usr_id = $_SESSION['id'];
    
        // Verificamos si se ha enviado un id de anuncio
        $ads_id = $_POST['ads_id'] ?? null; // Si es null, es una creación
    
        // Crear anuncio (si no hay ads_id)
        if ($action !== 'delete'){
        if (!$ads_id) {
            if (isset($_FILES['file'])) {
                // Manejo de archivo de imagen
                $file_name = $_FILES['file']['name'];
                $file_tmp_name = $_FILES['file']['tmp_name'];
                $file_info = uniqid('ad_image_', true) . '.' . pathinfo($file_name, PATHINFO_EXTENSION);
                $destinacion_full = $dir_destinacion . $file_info;
                $relative_path = './tmp_images/' . $file_info;
    
                // Crear el anuncio
                $anuncios = new Anuncions(null, $titulo, $descripcion, $precio, $usr_id, $categoria_id);
                if ($anuncios->addAnuncio()) {
                    // Si la creación fue exitosa, asociamos la imagen
                    $imagenes = new Images_Ad(null, $anuncios->ads_id, $relative_path);
                    if ($imagenes->addImages_ad()) {
                        // Mover archivo a destino
                        if (move_uploaded_file($file_tmp_name, $destinacion_full)) {
                            $redirect = '../../public/index.php?message=success';
                        } else {
                            $imagenes->deleteImages_ad();
                            $anuncios->deleteAnuncio();
                            $redirect = '../../public/index.php?message=error1';
                        }
                    } else {
                        $anuncios->deleteAnuncio();
                        $redirect = '../../public/index.php?message=error2';
                    }
                } else {
                    $redirect = '../../public/index.php?message=error3';
                }
            }
        } 
        // Actualizar anuncio (si hay ads_id)
        elseif ($ads_id) {
            // Actualizamos el anuncio
            $anuncios = new Anuncions($ads_id, $titulo, $descripcion, $precio, $usr_id, $categoria_id);
            if ($anuncios->updateAnuncio()) {
                // Si se proporciona una nueva imagen, la actualizamos
                if (isset($_FILES['file'])) {
                    $file_name = $_FILES['file']['name'];
                    $file_tmp_name = $_FILES['file']['tmp_name'];
                    $file_info = uniqid('ad_image_', true) . '.' . pathinfo($file_name, PATHINFO_EXTENSION);
                    $destinacion_full = $dir_destinacion . $file_info;
                    $relative_path = './tmp_images/' . $file_info;
    
                    $imagenes = new Images_Ad(null, $ads_id, $relative_path);
                    if ($imagenes->updateImages_ad()) {
                        if (move_uploaded_file($file_tmp_name, $destinacion_full)) {
                            $redirect = '../../public/index.php?message=successU1';
                        } else {
                            $imagenes->deleteImages_ad();
                            $redirect = '../../public/index.php?message=errorU1';
                        }
                    } else {
                        $redirect = '../../public/index.php?message=errorU2';
                    }
                } else {
                    $redirect = '../../public/index.php?message=successU';
                }
            } else {
                $redirect = '../../public/index.php?message=errorU3';
            }
        }
        }else{
            // Eliminar anuncio (si se pasó el id de anuncio)
            if (isset($_POST['ads_id'])) {
                $ads_id_to_delete = $_POST['ads_id'];
                $anuncios = new Anuncions($ads_id_to_delete, null, null, null, null, null);
                if ($anuncios->deleteAnuncio()) {
                    // Eliminar la imagen asociada al anuncio
                    $imagenes = new Images_Ad($ads_id_to_delete, null , null);
                    if ($imagenes->deleteImages_ad()) {
                        $redirect = '../../src/public/index.php?message=deleted';
                    } else {
                        $redirect = '../../src/public/index.php?message=error1';
                    }
                } else {
                    $redirect = '../../src/public/index.php?message=error2';
                }
            }
        }
    
        
    
        // Redirigir al índice con el mensaje correspondiente
        header("Location: $redirect");
        exit;
    }
    

    function allAnuncios(){
        $anuncios = new Anuncions(null,null,null,null,null,null);
        return $anuncios->getAllAdsImages();
    }

    function allAnunciosByUsrId(){
        $anuncios = new Anuncions(null,null,null,null,null,null,);
        return $anuncios->getAllAdsImagesByUsr($_SESSION['id']);
    }

    function allAnunciosById($id){
        $anuncios = new Anuncions($id,null,null,null,null,null,);
        return $anuncios->getAllAdsImagesById();
    }

    function allAnunciosByCategory($categoryId){
    $anuncios = new Anuncions(null, null, null, null, null, null);
    $allAnuncios = $anuncios->getAllAdsImages();

    // Filtrar por categoría
    $filteredAnuncios = array_filter($allAnuncios, function($anuncio) use ($categoryId) {
        return $anuncio['ads_category_id'] == $categoryId;
    });

    return $filteredAnuncios;
    }
?>