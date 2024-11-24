CREATE SCHEMA IF NOT EXISTS EXAMEN_PHP_DSVII;

USE EXAMEN_PHP_DSVII;


-- DROPS
DROP TABLE IF EXISTS images_ad;
DROP TABLE IF EXISTS anuncios_ads;
DROP TABLE IF EXISTS categories_cat;
DROP TABLE IF EXISTS users_usr;
DROP TABLE IF EXISTS roles_rol;

-- Tabla de Roles

CREATE TABLE roles_rol(
    rol_id INT AUTO_INCREMENT PRIMARY KEY,
    rol_Descripcion VARCHAR(100) NOT NULL,
    rol_admin VARCHAR(1) DEFAULT 'N',
    rol_user VARCHAR(1) DEFAULT 'S',
    rol_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    rol_updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de Usuarios

CREATE TABLE users_usr (
    usr_id INT AUTO_INCREMENT PRIMARY KEY,
    usr_rol_id INT NOT NULL,
    usr_name VARCHAR(100) NOT NULL,
    usr_email VARCHAR(150) UNIQUE NOT NULL,
    usr_password VARCHAR(255) NOT NULL,
    usr_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usr_updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (usr_rol_id) REFERENCES roles_rol(rol_id) ON DELETE CASCADE
);

-- Tabla de Categorías

CREATE TABLE categories_cat (
    cat_id INT AUTO_INCREMENT PRIMARY KEY,
    cat_name VARCHAR(100) NOT NULL UNIQUE,
    cat_description TEXT,
    cat_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    cat_updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabla de Anuncios Clasificados

CREATE TABLE anuncios_ads (
    ads_id INT AUTO_INCREMENT PRIMARY KEY,
    ads_title VARCHAR(200) NOT NULL,
    ads_description TEXT NOT NULL,
    ads_price DECIMAL(10, 2) NOT NULL,
    ads_usr_id INT NOT NULL,
    ads_category_id INT NULL,
    ads_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ads_updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (ads_usr_id) REFERENCES users_usr(usr_id) ON DELETE CASCADE,
    FOREIGN KEY (ads_category_id) REFERENCES categories_cat(cat_id) ON DELETE SET NULL
);

-- Tabla para Imágenes de Anuncios

CREATE TABLE images_ad (
    ad_id INT AUTO_INCREMENT PRIMARY KEY,
    ad_ads_id INT NOT NULL,
    ads_image_url VARCHAR(255) NOT NULL,
    ads_created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ad_ads_id) REFERENCES anuncios_ads(ads_id) ON DELETE CASCADE
);


INSERT INTO roles_rol (rol_Descripcion,rol_admin,rol_user)
values('USUARIO FINAL','N','S');

INSERT INTO roles_rol (rol_Descripcion,rol_admin,rol_user)
values('ADMIN','S','N');

insert into users_usr (usr_rol_id,usr_name,usr_email,usr_password)
values (2,'ADMIN','cgonAdmin@gmail.com','1234');


CREATE VIEW Anuncios_Con_Imagenes as
SELECT  ads_id,
		ad_id,
		ads_title, 
		ads_description, 
        ads_price, 
        ads_usr_id,
        (select usr_name from users_usr where usr_id = ads_usr_id) name,
        ads_category_id, 
        ads_image_url 
FROM  anuncios_ads ads
INNER JOIN images_ad ad
on (ad_ads_id = ads_id);
