<?php
// dd($var);
// $var = response()->Json($xD);
$nuevoArchivo = fopen("julico1.json","w");
fwrite($nuevoArchivo,response()->Json($xD));
fclose($nuevoArchivo);
echo "CRISTIAN SE LA COME"
?>
