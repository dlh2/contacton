<?php 
session_start();
include_once( $_SERVER['DOCUMENT_ROOT'] . "/recursos/bd/conexion.php");
if(!isset($_SESSION['id']))
{
	header('Location: /index.php');
}
if(!isset($_REQUEST['id_empresa']))
{
	echo "No existe esta empresa o usuario.";
	echo '<div align="center"><a href="/tablon/tablon.php"><button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Volver al inicio</span></button></a></div>';
}
$envios=0;
if(isset($_REQUEST['envio']))
{
	$envios=$_REQUEST['envio'];
}

	if($envios === 0)
	{
	$sql="SELECT nombre, url_foto, tipo, correo FROM usuarios where id = '".$_REQUEST['id_empresa']."' limit 1";
	$busqueda=$conexion->query($sql);
	if($busqueda->num_rows != 00)
	{
		$fila=mysqli_fetch_row($busqueda);
		if($fila[2] === "empresa")
		{
			if($_SESSION['tipo'] === "empresa")
			{
				echo '<div class="well well-lg">';
				echo "Puede contactar con la empresa a partir de la siguiente cuenta de correo:<a href='mailto:".$fila[3]."'>".$fila[3]."</a> o enviandole un Mensaje Privado mediante la plataforma de la red social pulsando el boton de abajo que pone MP.";
				?>
				<div align="center"><button type='button' onclick="tareas('/tablon/tareas.php?tipo=1&fase=5&cor=<?php echo $fila[3]; ?>','cp','Mensajeria cargando...');" class='btn btn-default btn-sm'><span class='glyphicon glyphicon-envelope'></span> MP</button></div>
				<?php 
				echo '</div>';
				echo '<div align="center"><a href="/tablon/tablon.php"><button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Volver al inicio</span></button></a></div>';
			}
			else
			{
				//comprobamos de que no se haya enviado ya 
				$sqlc="SELECT * FROM actividades where id_user = '".$_REQUEST['id_empresa']."' and id_desti = '".$_SESSION['id']."' and id_tipo_actividad = 3";
				//fin de compro
				$busquedac=$conexion->query($sqlc);
				if($busquedac->num_rows == 00)
				{
					echo '<div class="panel panel-default" align="center"><div class="panel-heading"><h3>Buzon de la empresa '.$fila[0].'</h3></div><div class="panel-body">';
					?><img class="img-responsive" src="/recursos/img/buzon.png" alt="Buzon de la empresa"/><p>Puede enviar su curriculum a la empresa pulsando el boton de abajo que pone "Enviar Curriculum".</p><br/><a href="#" onclick="tareas('/tablon/buzon.php?id_empresa=<?php echo $_REQUEST['id_empresa'];?>&envio=1','cp','Enviando Curriculum >>>>>');" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-open-file"></span>Enviar Curriculum</a><?php
					echo '</div></div>';
					echo '<div align="center"><a href="/tablon/tablon.php"><button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Volver al inicio</span></button></a></div>';
				}
				else
				{
					echo '<div class="panel panel-default" align="center"><div class="panel-heading"><h3>Buzon de la empresa '.$fila[0].'</h3></div><div class="panel-body">';
					?><img class="img-responsive" src="/recursos/img/buzon.png" alt="Buzon de la empresa"/><br/><a href="#" class="btn btn-default btn-lg disabled"><span class="glyphicon glyphicon-open-file"></span>Ya se ha enviado el curriculum</a><p>El curriculum ya se ha enviado a esta empresa anteriormente, estara siendo procesado por la empresa tenga paciencia por favor.</p><?php
					echo '</div></div>';
					echo '<div align="center"><a href="/tablon/tablon.php"><button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Volver al inicio</span></button></a></div>';
				}
			}
		}
		if($fila[2] === "usuario")
		{
			if($_SESSION['tipo'] === "empresa")
			{
				echo '<div class="well well-lg">';
				echo "Puede contactar con el usuario a partir de la siguiente cuenta de correo:<a href='mailto:".$fila[3]."'>".$fila[3]."</a> o enviandole un Mensaje Privado mediante la plataforma de la red social pulsando el boton de abajo que pone MP.";
				?>
				<div align="center"><button type='button' onclick="tareas('/tablon/tareas.php?tipo=1&fase=5&cor=<?php echo $fila[3]; ?>','cp','Mensajeria cargando...');" class='btn btn-default btn-sm'><span class='glyphicon glyphicon-envelope'></span> MP</button></div>
				<?php
				echo '</div>';
				echo '<div align="center"><a href="/tablon/tablon.php"><button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Volver al inicio</span></button></a></div>';
			}
			else
			{
				echo '<div class="well well-lg">';
				echo "Puede contactar con el usuario a partir de la siguiente cuenta de correo:<a href='mailto:".$fila[3]."'>".$fila[3]."</a> o enviandole un Mensaje Privado mediante la plataforma de la red social pulsando el boton de abajo que pone MP, tambien lo puede agregar a la lista de amigos.";
				?>
				<div align="center"><button type='button' onclick="tareas('/tablon/tareas.php?tipo=1&fase=5&cor=<?php echo $fila[3]; ?>','cp','Mensajeria cargando...');" class='btn btn-default btn-sm'><span class='glyphicon glyphicon-envelope'></span> MP</button></div>
				<?php
				echo '</div>';
				echo '<div align="center"><a href="/tablon/tablon.php"><button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Volver al inicio</span></button></a></div>';
			}
		}
	}
	else
	{
		echo "No existe esta empresa o usuario.";
		echo '<div align="center"><a href="/tablon/tablon.php"><button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Volver al inicio</span></button></a></div>';
	}
	}
	else
	{
		$sql="SELECT nombre, url_foto, tipo, correo FROM usuarios where id = '".$_REQUEST['id_empresa']."' limit 1";
		$busqueda=$conexion->query($sql);
		$fila=mysqli_fetch_row($busqueda);
		$sql2 = "INSERT INTO actividades (id_user,id_desti,id_tipo_actividad,actividad,fecha) VALUES ('".$_SESSION['id']."','".$_REQUEST['id_empresa']."','20','Se ha enviado correctamente el curriculum al buzon de la empresa ".$fila[0].".','".date("Y/m/d")."')";
		$sql3 = "INSERT INTO actividades (id_user,id_desti,id_tipo_actividad,actividad,fecha) VALUES ('".$_REQUEST['id_empresa']."','".$_SESSION['id']."','3','Te han enviado un curriculum a tu buzon.','".date("Y/m/d")."')";
		$busqueda2=$conexion->query($sql2);
		$busqueda3=$conexion->query($sql3);
		echo '<div class="panel panel-default" align="center"><div class="panel-heading"><h3>Buzon de la empresa '.$fila[0].'</h3></div><div class="panel-body">';
		echo date("Y/m/d");
		?><img class="img-responsive" src="/recursos/img/buzon.png" alt="Buzon de la empresa"/><span class="glyphicon glyphicon-ok"></span><p>Su curriculum se ha enviado correctamente, tenga paciencia hasta que le den una respuesta.</p><br/><?php
		echo '</div></div>';
		echo '<div align="center"><a href="/tablon/tablon.php"><button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Volver al inicio</span></button></a></div>';
	}
mysqli_close($conexion);
sleep(2);
?>
