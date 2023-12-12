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

    // Incluir a función dbDelta para crear/modificar táboas na base de datos
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}
register_activation_hook( __FILE__, 'crear_tabla');

// Función para insertar datos na tabla
function insertardatos($palabras1, $palabras2) {
    global $wpdb;
    $tabla = $wpdb->prefix . 'examen';

    // Bucle para inserir datos baseados nos arrays proporcionados
    for ($i = 0; $i < count($palabras1); $i++) {
        $palabrafinal = $palabras1[$i] . $palabras2[$i];

        // Inserción dos datos na táboa
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

// Inserir datos ao activar o plugin (pasando os arrays como argumentos)
register_activation_hook( __FILE__, function() use ($palabras1, $palabras2) {
    insertardatos($palabras1, $palabras2);
});

// Función para mostrar datos no contenido da publicación
function mostrar_datos_contenido($content) {
    global $wpdb;
    $tabla = $wpdb->prefix . 'examen';

    // Consultar datos da táboa
    $result = $wpdb->get_results("SELECT * FROM $tabla");

    if ($result) {
        // Xerar o HTML coa lista das palabras compostas
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

// Función para mostrar datos no título da publicación
function mostrar_datos_title($title) {
    global $wpdb;
    $tabla = $wpdb->prefix . 'examen';

    // Obter o primeiro dato da táboa
    $result = $wpdb->get_results("SELECT * FROM $tabla LIMIT 1");

    if ($result) {
        // Engadir o dato da palabra composta ao título
        $title .= ' - Compostas: ';
        $title .= $result[0]->palabra_composta;
    }

    return $title;
}
add_filter('the_title', 'mostrar_datos_title');
