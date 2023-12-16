<?php
 /*
Plugin Name: Primer plugin
Plugin URI: http://www.danielcastelao.org/
Description: Experimentación de varias técnicas para hacer un plugin
Version: 1.0
*/

$palabras1 = array(
    "prostituta",
    "maricon",
    "gilipollas",
    "malnacido"
);

$palabras2 = array(
    "persona de alterne",
    "homosexual",
    "imbecil",
    "malcriado"
);

function cambia_soez_por_eufemismo($text)
{
    global $palabras1, $palabras2;
    return str_replace($palabras1, $palabras2, $text);
}

add_filter('the_content', 'cambia_soez_por_eufemismo');

