<form name="FormEnvio" method="" id="FormEnvio"  action="" >
    <table class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <tr>
    <td width="163">Unidades</td>
    <td width="163">Codigo Producto</td>
    <td width="163">Descripcion</td>
    <td width="146">Unidad Medida</td>
    <td width="270" align="right"> <input type='submit' name='btn1' value='Agregar' onclick='unaMas("tabla")'/></td>
    </tr>
    <tr>
    <td class="block mt-4 w-full">
        <div>
            <input type="text" name="unidades" id="unidades" />
        </div>
    </td>
    <td class="max-w-7xl mx-auto sm:px-6 lg:px-8" width="163"><input type="text" id="CodProd" name ="CodProd" onchange='unaMas("grilla")' /></td>
    <td  class="max-w-7xl mx-auto sm:px-6 lg:px-8" width="163"><input type="text" name="Descripcion"  /></td>
    <td class="max-w-7xl mx-auto sm:px-6 lg:px-8" width="146"><select name="Tunidades" ></select></td>
    <td align="right"><input class="bordes" type="submit" name="Limpiar" id="Limpiar" value="Limpiar" /> </td>
    </tr>
    </table>
    </form>

<?php
if (isset ($_POST ['btn1'])){
	$activado = 1 ;
$unidades = $_POST["unidades"];
$Codigo = $_POST["CodProd"];
$Descripcion = $_POST["Descripcion"];


$array["Datos"]["Cantidad"]= $unidades;
$array["Datos"]["Codigo"]=$Codigo;
$array["Datos"]["Descripcion"]=$Descripcion;
$array["Datos"]["Medida"]="Post medida";
$array["Datos"]["ValUnitario"]="Post valu";
$array["Datos"]["Descuentos"]="Post des";
$array["Datos"]["Total"]="Post total";

  $keys = array_keys($array["Datos"]);

$table = "<table id='tabla' border=\"1\">";
$table .= "<tr>";

foreach($keys as $i){
$table .= "<th>".$i."</th>";
}
 $table .="</tr>";
foreach($keys as $i){
	$table .=  "<td>".$array["Datos"]["${i}"]."</td>";


}
$table .= "</table>";
echo $table ;
}
?>
