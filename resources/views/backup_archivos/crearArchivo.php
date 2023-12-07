<?php
$archivo  = fopen("archivo_prueba.txt","a") or die("Error al crear");

$text = $_REQUEST['textoxd'];

fwrite($archivo,$text);
echo "Se genero correcamente el archivo!!"


?>
