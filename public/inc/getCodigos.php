<?php

require 'database.php';

$con = new Database();
$pdo = $con->conectar();

$campo = $_POST["campo"];

$sql = "SELECT cod_oem,nombre FROM productos WHERE cod_oem LIKE ? ORDER BY cod_oem ASC";
$query = $pdo->prepare($sql);
$query->execute([$campo . '%']);

$html = "";

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
	// $html .= "<li onclick=\"mostrar('" . $row["ci"] . "')\">" . $row["ci"] . " - " . $row["nombre"] . " " . $row["apellido"] .  " - " . $row["nit"] . " - " . $row["nit"] . $row["telefono"] ."</li>";
	$html .= "<li>" . "<a href='google.com'>" . $row["cod_oem"] . " - " . $row["nombre"] . "</a>". "</li>";
}

echo json_encode($html, JSON_UNESCAPED_UNICODE);
