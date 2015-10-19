<?php
$correo = $_GET["correo"];
$pass = $_GET["pass"];
$contador = 0;
$errores = "Has cometido los siguientes errores:<br/>";
if(strlen($correo) == 0)
{
	$errores = $errores."No has puesto el correo.<br/>";
	$contador++;
	$correo="";
}
if(strlen($pass) == 0)
{
	$errores = $errores."No has puesto la contraseña.<br/>";
	$contador++;
	$pass="";
}

include_once("conexion.php");
$resultado = $conexion->query("SELECT id,tipo FROM usuarios where correo = '".$correo."' and password = '".$pass."'");
if ($resultado->num_rows == 00) 
{
	$errores = $errores."No coincide el password o la contraseña.<br/>";
	$contador++;
}
else
{
	while($fila=mysqli_fetch_row($resultado))
	{
		session_start();
		$_SESSION["id"]=$fila[0];
		$_SESSION["tipo"]=$fila[1];
		echo'<ul class="pager"><li><a href="tablon.php">Ir a mi Tablon</a></li></ul><script>idUsuario=1;</script>'; 
	}
}
if($contador > 0)
{
	echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$errores."</div>";
}
if($contador > 0){
echo '<h3>Entrar en mi Perfil:</h3>
		<form class="form-horizontal" role="form" action="/" method="post" enctype="text/plain">
		<div class="col-xs-12" style="text-align:center;">
			<label for="correo">Correo electrónico: </label><input  onkeypress = "pulsar(event,"loginacceso.php");" class="form-control input-lg" id="correo" type="email" name="correo" placeholder="ejemplo@ejemplo.com" value='."'$correo'".'/>
		</div>
		<div class="col-xs-12">
			<label for="pass">Password:</label><input type="password" name="pass" onkeypress = "pulsar(event,"loginacceso.php");" class="form-control input-lg" id="pass" placeholder="Escoja una contraseña" value='."'$pass'".'/>
		</div>
		<div class="col-sm-12">		
		<div class="checkbox">
			<label><input type="checkbox" name="veri" id="veri" value="veri">No volver a pedir verificacion.</label>
		</div>	
		<button type="button" class="btn btn-default" onclick="envio('."'loginacceso.php'".');">Conectarse</button><br/><br/>
		</div>
		</form>
		<div class="btn-group btn-group-sm">
			<button type="button" class="btn btn-primary" onclick="envio('."'empleado.php'".');">Registrarse como Usuario</button>
			<button type="button" class="btn btn-primary" onclick="envio('."'empresa.php'".');">Registrarse como Empresa</button>
		</div>
		<br/><br/>
		<button type="button" class="btn btn-primary btn-sm" id="botonusuario" onclick="envio('."'login.php'".');">Entrar(login)</button>';
		}
	mysqli_close($conexion);
	sleep(2);
?>
