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
        1parte TEXT NOT NULL,
        2parte TEXT NOT NULL,
        palabra_composta TEXT,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
register_activation_hook( __FILE__, 'crear_tabla');

// Función para insertar datos en la tabla
// ... Código previo del plugin

// Función para insertar datos en la tabla
function insertardatos($palabras1, $palabras2) {
    global $wpdb;
    $tabla = $wpdb->prefix . 'examen';

    for ($i = 0; $i < count($palabras1); $i++) {
        $palabrafinal = $palabras1[$i] . $palabras2[$i];

        $wpdb->insert(
            $tabla,
            array(
                '1parte' => $palabras1[$i],
                '2parte' => $palabras2[$i],
                'palabra_composta' => $palabrafinal
            )
        );
    }
}

// Insertar datos al activar el plugin (pasando los arrays como argumentos)
register_activation_hook( __FILE__, function() use ($palabras1, $palabras2) {
    insertardatos($palabras1, $palabras2);
});

// Función para mostrar datos en el contenido de la publicación
function mostrar_datos_contenido($content) {
    global $wpdb;
    $tabla = $wpdb->prefix . 'examen';

    $result = $wpdb->get_results("SELECT * FROM $tabla");

    if ($result) {
        $content .= '<h2>Palabras compostas</h2>';
        $content .= '<ul>';
        foreach ($result as $row) {
            $content .= '<li>' . $row->palabra_composta . '</li>';
        }
        $content .= '</ul>';
    }

    return $content;
}
add_filter('the_content', 'mostrar_datos_contenido');


