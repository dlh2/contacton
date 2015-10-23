<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
if(isset($_SESSION['id']))
{
	header('Location: /index.php');
}
include($_SERVER['DOCUMENT_ROOT'] . "/recursos/bd/conexion.php");
$sql="SELECT correo FROM usuarios where privacidad = '1' limit 1000";
$busqueda2=$conexion->query($sql);
$contador=0;
while ($fila = mysqli_fetch_row($busqueda2)) {
	if($contador == 0)
	{
		echo "http://contacton.es/recursos/perfil.php?perfil=".md5($fila[0]);
		$contador++;
	}
	else
	{
		echo "\n";
		echo "http://contacton.es/recursos/perfil.php?perfil=".md5($fila[0]);
	}
		$contador++;

}
?>