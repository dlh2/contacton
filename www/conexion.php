<?php
//pruebas servidor mysqli_connect("mysql.nixiweb.com", "u770401726_dbco", "LWWYUwhbX8", "u770401726_dbco");
//pruebas local mysqli_connect("localhost", "root", "", "contacton");
$conexion = mysqli_connect("mysql.nixiweb.com", "u770401726_dbco", "LWWYUwhbX8", "u770401726_dbco");

if (!$conexion) {
    $errores = $errores. "Error: No se pudo conectar a MySQL." . PHP_EOL ."<br/>";
	$contador++;
}
?>