<?php
session_start();
$nombre = $_GET["nombre"];
$apellidos = $_GET["apellidos"];
$email = $_GET["email"];
$id_motivo = $_GET["id_motivo"];
$num_telf = $_GET["num_telf"];
$mensaje = $_GET["mensaje"];
//validacion completa
//vamos a comprobar en la base de datos
include_once("conexion.php");
	$sql = "INSERT INTO atencion_cliente (nombre,apellidos,email,id_motivo,telefono,mensaje) VALUES ('".$nombre."','".$apellidos."','".$email."',".$id_motivo.",'".$num_telf."','".$mensaje."')";
		if ($conexion->query($sql) === TRUE) {
			echo "<div class=\"modal-header\">
			<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>	
			<h4 class=\"modal-title\">
				Se ha guardado correctamente.
			</h4>
			  </div>
			<div class=\"modal-body\">
				<ul class=\"pager\"><li><a href=\"tablon.php\">Ir al Tablon.</a></li></ul>
			</div>
			<div class=\"modal-footer\">
				<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Ok</button>
			</div>";
		} else {
			echo "Ha fallado";
		}
mysqli_close($conexion);
sleep(4);
?>