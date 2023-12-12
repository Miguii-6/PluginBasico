<?php

/*
Plugin Name: Examen SXE Plugin
Description: Plugin para concatenar palabras desde unha tabla de base de datos en WordPress.
*/

// Arrays coas palabras
$palabras1 = array(
    "para",
    "super",
    "esterno"
);

$palabras2 = array(
    "guas",
    "mercado",
    "cleido"
);

// Función para crear a tabla na base de datos ao activar o plugin
function crear_tabla() {
    global $wpdb;
    $tabla = $wpdb->prefix . 'examen';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $tabla (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        palabras1 TEXT NOT NULL,
        palabras2 TEXT NOT NULL,
        palabrafinal TEXT,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
register_activation_hook( __FILE__, 'crear_tabla');


