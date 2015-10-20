<?php
header("Content-type: text/html; charset=utf8");
$correo = $_GET["correo"];
$pass = $_GET["pass"];
$pass2 = $_GET["pass2"];
$nombre = $_GET["nombre"];
$direccion = $_GET["direccion"];
$politica = $_GET["politica"];
$tipo = "empresa";
$contador = 0;
$check="";
$errores = "Has cometido los siguientes errores:<br/>";
//empieza validacion
if(strlen($correo) == 0)
{
	$errores = $errores."No has puesto el correo.<br/>";
	$contador++;
	$correo="";
}
if(strlen($pass) == 0)
{
	$errores = $errores."No has puesto la Password.<br/>";
	$contador++;
	$pass="";
}
if(strlen($pass2) == 0)
{
	$errores = $errores."No has repetido la Password.<br/>";
	$contador++;
	$pass2="";
}
if(strlen($nombre) == 0)
{
	$errores = $errores."No has puesto el nombre de la empresa.<br/>";
	$contador++;
	$nombre="";
}
if(!(strcmp($politica,'yes') == 0))
{
	$errores = $errores."No has aceptado nuestras politicas legales.<br/>";
	$contador++;
	$politicas="";
}
else
{
	$check="checked";
}
if(strlen($direccion) == 0)
{
	$errores = $errores."No has puesto la direccion de la empresa.<br/>";
	$contador++;
	$apellido="";
}
if(!strcmp ($pass , $pass2 ) == 0)
{
	$errores = $errores."El Password no coincide.<br/>";
	$contador++;
}
if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $errores = $errores."La direccion de correo no es valida.<br/>";
	$contador++;
}
//validacion completa
//vamos a comprobar en la base de datos
include_once( $_SERVER['DOCUMENT_ROOT'] . "/recursos/bd/conexion.php");
$resultado = $conexion->query("SELECT id,tipo FROM usuarios where correo = '".$correo."'");
if ($resultado->num_rows != 00) 
{
	$errores = $errores."Usted ya esta registrado con este usuario.<br/>";
	$contador++;
}
else
{
if($contador < 1)
	{
		$sql = "INSERT INTO usuarios (nombre,correo,password,tipo,direccion) VALUES ('".$nombre."','".$correo."','".$pass."','".$tipo."','".$direccion."')";
		if ($conexion->query($sql) === TRUE) {
			$resultado2 = $conexion->query("SELECT id,tipo FROM usuarios where correo = '".$correo."' and password = '".$pass."'");
			$fila=mysqli_fetch_row($resultado2);
			session_start();
			$_SESSION["id"]=$fila[0];
			$_SESSION["tipo"]=$tipo;
			echo "Se ha registrado correctamente.";
			echo'<ul class="pager"><li><a href="/tablon/">Ir al Tablon de la empresa.</a></li></ul>';
			$sql2 ="SELECT id FROM usuarios where correo = '".$correo."'";
			$resultado3 = $conexion->query($sql2);
			$fila2=mysqli_fetch_row($resultado3);
			$sql3 = "INSERT INTO actividades (id_user,id_desti,fecha,id_tipo_actividad,actividad) VALUES ('".$fila2[0]."','".$fila2[0]."','".date("Y/m/d")."','20','Bienvenido y Gracias por utilizar ContactON')";	
			$conexion->query($sql3);
		}
	}	
}
if($contador > 0)
{
	echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$errores."</div>";
}
if($contador > 0)
	{
		echo '<h3>Formulario de registro de Empresas:</h3>
		<form class="form-horizontal" role="form" action="/" method="post" enctype="text/plain">
		<div class="col-xs-6">
			<label for="nombre">Nombre de la Empresa:</label><input type="text" onkeypress = "pulsar(event,"/index/registroe.php");" name="nombre" class="form-control input-lg" id="nombre" placeholder="ejemplo:burguer and chicken" value='."'$nombre'".'/>
		</div>	
		<div class="col-xs-6">
			<label for="direccion">Direccion de la Empresa:</label><input onkeypress = "pulsar(event,"/index/registroe.php");" type="text" name="direccion" class="form-control input-lg" id="direccion" placeholder="calle 23 primero derecha" value='."'$direccion'".'/>
		</div>	
		<div class="col-xs-6">
			<label for="pass">Password:</label><input type="password" onkeypress = "pulsar(event,"/index/registroe.php");" name="pass" class="form-control input-lg" id="pass" placeholder="Escoja un Password" value='."'$pass'".'/>
		</div>	
		<div class="col-xs-6">
			<label for="pass2">Repetir Password: </label><input id="pass2" onkeypress = "pulsar(event,"/index/registroe.php");" type="password" name="pass2" class="form-control input-lg" placeholder="Vuelve a introducir tu Password" value='."'$pass2'".'/>
		</div>	
		<div class="col-xs-6">
			<label for="correo">Correo electronico: </label><input onkeypress = "pulsar(event,"/index/registroe.php");"  class="form-control input-lg" id="correo" type="email" name="correo" placeholder="ejemplo@ejemplo.com" value='."'$correo'".'/>
		</div><br/><br/>
		<div class="checkbox">
			<label for="politica"><input type="checkbox" name="politica" id="politica" value="yes" '.$check.'>Pulse para aceptar las <a href="#">politicas de uso</a>.</label>
		</div>	
		<button type="button" class="btn btn-default" onclick="envio('."'/index/registroe.php'".');">Enviar</button><br/><br/>
		</form>
		<div class="btn-group btn-group-sm">
			<button type="button" class="btn btn-primary" onclick="envio('."'/index/empleado.php'".');">Registrarse como Usuario</button>
			<button type="button" class="btn btn-primary" onclick="envio('."'/index/empresa.php'".');">Registrarse como Empresa</button>
		</div>
		<br/><br/>
		<button type="button" class="btn btn-primary btn-sm" id="botonusuario" onclick="envio('."'/index/login.php'".');">Entrar(login)</button>';
	}
	mysqli_close($conexion);
	sleep(4);
?>
