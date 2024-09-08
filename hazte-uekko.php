<?php
/*
Plugin Name: Hazte Uekko
Plugin URI: https://www.uekko.com
Description: Plugin de reservas
Version: 1.0
Author: Hazte Uekko SL
Author URI: https://www.uekko.com
License: GPL2
*/
// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit; // Salir si se accede directamente
}

// Definir el dominio de texto del plugin
define('HAZTE_UEKKO_DOMAIN', 'hazte-uekko');

define('HAZTE_UEKKO_DEBUG', true);

// Función de activar el plugin

function Activar () {
    global $wpdb; // Al activar el plugin se comprueba si existe la BD y si no lo hace la crea.

    $charset_collate = $wpdb->get_charset_collate();

    $sql ="CREATE TABLE IF NOT EXISTS {$wpdb->prefix}formularios(
    `FormulariosId` INT NOT NULL AUTO_INCREMENT,
    `Nombre` VARCHAR(45) NULL,
    `ShortCode` VARCHAR(45) NULL,
    PRIMARY KEY (`FormulariosId`),
    )ENGINE=InnoDB $charset_collate;";
    $wpdb->query($sql);

    if (HAZTE_UEKKO_DEBUG && $wpdb->last_error) {
        error_log('Error al crear la tabla formularios: ' . $wpdb->last_error);
    }

    $sql2 = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}detalle_formularios( 
        `DetalleId` INT NOT NULL AUTO_INCREMENT,
        `FormulariosId` INT NOT NULL,
        `Pregunta` VARCHAR(150) NULL,
        `Tipo` VARCHAR(45) NULL,
        PRIMARY KEY (`DetalleId`),
        CONSTRAINT fk_formularios,
            FOREIGN KEY (`FormulariosId`)
            REFERENCES {$wpdb->prefix}formularios(`FormulariosId`),
            ON DELETE CASCADE,
            ON UPDATE CASCADE,
        )ENGINE=InnoDB $charset_collate;";
    $wpdb->query($sql2);

    if (HAZTE_UEKKO_DEBUG && $wpdb->last_error) {
        error_log('Error al crear la tabla detalle_formularios: ' . $wpdb->last_error);
    }

    $sql3 = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}respuesta_formularios(
        `RespuestaId` INT NOT NULL AUTO_INCREMENT,
        `DetalleId` INT NOT NULL,
        `Respuesta` VARCHAR(45) NULL,
        PRIMARY KEY (`RespuestaId`)
        CONSTRAINT fk_detalle_formularios,
            FOREIGN KEY (`DetalleId`),
            REFERENCES {$wpdb->prefix}detalle_formularios(`DetalleId`),
            ON DELETE CASCADE,
            ON UPDATE CASCADE,
        )ENGINE=InnoDB $charset_collate;";
    $wpdb->query($sql3);

    if (HAZTE_UEKKO_DEBUG && $wpdb->last_error) {
        error_log('Error al crear la tabla detalle_formularios: ' . $wpdb->last_error);
    }

}

// Función de desactivar el plugin
function Desactivar (){
    flush_rewrite_rules();

}

// Función de borrar el plugin

function Borrar (){

}

register_activation_hook(__FILE__,'Activar');
register_deactivation_hook(__FILE__,'Desactivar');
register_uninstall_hook(__FILE__,'Borrar');

add_action('admin_menu','CrearMenu');

function CrearMenu(){
    add_menu_page(
        'Mis Reservas', // Título de la página
        'Hazte Uekko', // Título del menú 
        'manage_options', // Permisos de acceso
        plugin_dir_path(__FILE__).'admin/mis_reservas.php',// Slug
        null, // function del contenido
        plugin_dir_url(__FILE__).'admin/img/logo.png', // Icono del menú
        1 // Prioridad del menú
    );


}

function MostrarContenido() {
    echo "<h1>Portal Uekko<h1>";
}

// encolar bootstrap

function EncolarBootstrapJs(){
    wp_enqueue_script('bootstrapJs',plugins_url('admin/bootstrap/js/bootstrap.min.js',__FILE__),array('jquery'));        
}
add_action('admin_enqueue_scripts','EncolarBootstrapJs');

function EncolarBootstrapCSS(){
    wp_enqueue_style('bootstrapCSS',plugins_url('admin/bootstrap/css/bootstrap.min.css',__FILE__));        
}
add_action('admin_enqueue_scripts','EncolarBootstrapCSS');