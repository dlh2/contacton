<?php
session_start();
$direccion = $_GET["direccion"];
$fecha = $_GET["fecha"];
$nif = $_GET["nif"];
//validacion completa
//vamos a comprobar en la base de datos
include_once( $_SERVER['DOCUMENT_ROOT'] . "/recursos/bd/conexion.php");
$resultado = $conexion->query("SELECT nombre, apellido, direccion, fecha, nif FROM usuarios where id = '".$_SESSION['id']."' limit 1");
if ($resultado->num_rows != 00) 
{
	$sql = "UPDATE usuarios SET direccion='".$direccion."', fecha='".$fecha."', nif='".$nif."' WHERE id = '".$_SESSION['id']."' ";
		if ($conexion->query($sql) === TRUE) {
			echo "<div class=\"modal-header\">
			<button type=\"button\" class=\"close\" data-dismiss=\"modal\">&times;</button>	
			<h4 class=\"modal-title\">
				Se ha guardado correctamente.
			</h4>
			  </div>
			<div class=\"modal-body\">
				<ul class=\"pager\"><li id=\"image_upload_result\"></li><li><a href=\"/tablon/\">Ir al Tablon.</a></li></ul>
			</div>
			<div class=\"modal-footer\">
				<button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">Ok</button>
			</div>";
			$sql3 = "INSERT INTO actividades (id_user,id_desti,fecha,id_tipo_actividad,actividad) VALUES ('".$_SESSION['id']."','".$_SESSION['id']."','".date("Y/m/d")."','20','Has modificado tu perfil')";	
			$conexion->query($sql3);
		} else {
			echo "Ha fallado";
		}
} else {
	echo "Error en la cookie de la id";
}
mysqli_close($conexion);
sleep(4);
?>