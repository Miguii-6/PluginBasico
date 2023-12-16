# Plugin de WordPress: Cambiador de Palabras Soeces

## Descripción
Este plugin de WordPress se diseñó para reemplazar ciertas palabras soeces 
por sus equivalentes más suaves en el contenido del sitio web. Es útil para 
mantener un lenguaje apropiado y evitar palabras ofensivas en el contenido.

## Instalación
1. Descarga el archivo `primer-plugin.php`.
2. Ve a la carpeta de plugins de tu instalación de WordPress (normalmente`wp-content/plugins/`).
3. Crea una nueva carpeta (por ejemplo, `cambiador-palabras-soeces`) y coloca el archivo `primer-plugin.php` dentro de ella.
4. En el panel de administración de WordPress, activa el plugin desde la sección de Plugins.

## Uso
Una vez activado, el plugin reemplazará automáticamente las palabras soeces definidas en los arrays `$palabras1` y `$palabras2` en el contenido del sitio web. Puedes editar estos arrays en el archivo `primer-plugin.php` para personalizar las palabras a reemplazar.

## Ejemplo
- La palabra "prostituta" será reemplazada por "persona de alterne".
- "maricon" será reemplazado por "homosexual".
- "gilipollas" será reemplazado por "imbecil".
- "malnacido" será reemplazado por "malcriado".

## Funcionamiento del Código
- El plugin define dos arrays `$palabras1` y `$palabras2` que contienen las palabras soeces y sus equivalentes suaves, respectivamente.
- La función `cambia_soez_por_eufemismo($text)` toma el texto y utiliza `str_replace` para reemplazar las palabras definidas en los arrays.
- El filtro `add_filter('the_content', 'cambia_soez_por_eufemismo');` aplica la función `cambia_soez_por_eufemismo` al contenido del sitio web utilizando el hook `the_content`.

## Importante
- Asegúrate de editar las palabras en los arrays `$palabras1` y `$palabras2` según las necesidades y el contexto de tu sitio web.
- Ten en cuenta que este plugin solo reemplaza las palabras exactas definidas en los arrays y no realiza cambios en palabras similares o derivadas.


## Autor Miguel Mariño Martinez

