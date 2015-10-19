<?php
session_start();
include_once("conexion.php");

if($_GET['tipo'] == 1)//mensaje privado
{
if(isset($_GET['fase']))
{
	if($_GET['fase'] == 1)//bandeja de entrada
	{
			$sql="SELECT id_emisor, fecha, asunto,id FROM mensajes where id_receptor = '".$_SESSION['id']."'";
			$busqueda=$conexion->query($sql);
			if($busqueda->num_rows != 00)
			{
				?><div class="list-group"><?php
				while ($fila = mysqli_fetch_row($busqueda)) 
				{
					$sql2="SELECT correo FROM usuarios where id = '".$fila[0]."' limit 1";
					$busqueda2=$conexion->query($sql2);
					$fila2=mysqli_fetch_row($busqueda2);
					?>
					 <a href="#" onclick="tareas('tareas.php?tipo=10&id_men=<?php echo $fila[3];?>','pan','Cargando Mensaje Recibido');" class="list-group-item">&nbsp;Correo:<?php echo $fila2[0]; ?>&nbsp;&nbsp;&nbsp;Asunto: <?php echo $fila[2]; ?>&nbsp;&nbsp;&nbsp;Fecha Recibido:<?php echo $fila[1]; ?></a>
					<?php
				}
				?></div><?php
			}
			else
			{
				echo "No tiene ningun mensaje en su Bandeja de entrada.";
				echo '<div align="center"><a href="tablon.php"><button type="button"  class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Inicio</span></button></a></div>';
			}
	}
	if($_GET['fase'] == 2)//bandeja de salida
	{
			$sql="SELECT id_receptor, fecha, asunto,id FROM mensajes where id_emisor = '".$_SESSION['id']."'";
			$busqueda=$conexion->query($sql);
			if($busqueda->num_rows != 00)
			{
				?><div class="list-group"><?php
				while ($fila = mysqli_fetch_row($busqueda)) 
				{
					$sql2="SELECT correo FROM usuarios where id = '".$fila[0]."' limit 1";
					$busqueda2=$conexion->query($sql2);
					$fila2=mysqli_fetch_row($busqueda2);
					?>
					 <a href="#" onclick="tareas('tareas.php?tipo=9&id_men=<?php echo $fila[3];?>','pan','Cargando Mensaje Enviado');" class="list-group-item">&nbsp;Correo:<?php echo $fila2[0]; ?>&nbsp;&nbsp;&nbsp;Asunto: <?php echo $fila[2]; ?>&nbsp;&nbsp;&nbsp;Fecha Recibido:<?php echo $fila[1]; ?></a>
					<?php
				}
				?></div><?php
			}
			else
			{
				echo "No tiene ningun mensaje en su Bandeja de salida.";
				echo '<div align="center"><a href="tablon.php"><button type="button"  class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Inicio</span></button></a></div>';
			}
	}
	if($_GET['fase'] == 3)//Enviar mensajes
	{
	?>
	<div class="form-group">
		<label for="de">De:</label>
		<input type="text" name="de" class="form-control" id="de" value="TU" disabled>
	</div>
	<div class="form-group">
		<label for="des">Destinatario:</label>
		<input type="text" name="des" class="form-control" id="des" placeholder="Correo del destinatario">
	</div>
	<div class="form-group">
		<label for="asunto">Asunto del Mensaje:</label>
		<input type="text" name="asunto" class="form-control" id="asunto" placeholder="Asunto del mensaje">
	</div>
	<div class="form-group">
		<label for="mail">Mensaje</label>
		<textarea name="mail" class="form-control" rows="8" id="mail"></textarea>
	</div>
	<div align="center">
	<button align="center" type="button" onclick="tareas('tareas.php?tipo=1&fase=4','pan','Enviando mensaje');" class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-send"></span> Enviar Mensaje 
    </button>
	</div>
	<?php
	}
	if($_GET['fase'] == 4)//enviar mensaje
	{
		$sql="SELECT id, nombre FROM usuarios where correo = '".$_GET['des']."' limit 1";
		$busqueda=$conexion->query($sql);
		if($busqueda->num_rows != 00)
		{
			$fila=mysqli_fetch_row($busqueda);
			$sql3 = "INSERT INTO mensajes (id_emisor,id_receptor,asunto,mensaje,fecha) VALUES ('".$_SESSION['id']."','".$fila[0]."','".$_GET['asunto']."','".$_GET['mensaje']."','".date("Y/m/d")."')";
			$sql2 = "INSERT INTO actividades (id_user,id_desti,id_tipo_actividad,actividad,fecha) VALUES ('".$_SESSION['id']."','".$fila[0]."','20','Has enviado el mensaje privado satisfactoriamente ha ".$fila[1]."','".date("Y/m/d")."')";
			$sql1 = "INSERT INTO actividades (id_user,id_desti,id_tipo_actividad,actividad,fecha) VALUES ('".$fila[0]."','".$_SESSION['id']."','20','Has recibido un nuevo mensaje privado.','".date("Y/m/d")."')";
			$conexion->query($sql3);
			$conexion->query($sql2);
			$conexion->query($sql1);
			echo "<div align='center'>Enviado Correctamente <a href='tablon.php'> Volver al inicio</a></div>";
		}
		else
		{
			echo "No se ha podido realizar el envio no se ha puesto bien la direccion de correo del destinatario.";
			?>
			<div class="form-group">
				<label for="de">De:</label>
				<input type="text" name="de" class="form-control" value="TU" id="de" disabled>
			</div>
			<div class="form-group">
				<label for="des">Destinatario:</label>
				<input type="text" name="des" class="form-control" id="des" placeholder="Correo del destinatario" value="<?php if($_GET['des'] != ""){echo $_GET['des'];} ?>">
			</div>
			<div class="form-group">
				<label for="asunto">Asunto del Mensaje:</label>
				<input type="text" name="asunto" class="form-control" id="asunto" placeholder="Asunto del mensaje" value="<?php if($_GET['asunto'] != ""){echo $_GET['asunto'];} ?>">
			</div>
			<div class="form-group">
				<label for="mail">Mensaje</label>
				<textarea name="mail" class="form-control" rows="8" id="mail"><?php if($_GET['mensaje'] != ""){echo $_GET['mensaje'];} ?></textarea>
			</div>
			<div align="center">
			<button align="center" type="button" onclick="tareas('tareas.php?tipo=1&fase=4','pan','Enviando mensaje');" class="btn btn-default btn-sm">
				  <span class="glyphicon glyphicon-send"></span> Enviar Mensaje 
			</button>
			</div>
			<?php
		}
	}
	if($_GET['fase'] == 5)	
	{
		?>
		<div class="form-group">
			<label for="de">De:</label>
			<input type="text" name="de" class="form-control" id="de" value="TU" disabled>
		</div>
		<div class="form-group">
			<label for="des">Destinatario:</label>
			<input type="text" name="des" class="form-control" id="des" placeholder="Correo del destinatario" value="<?php echo $_REQUEST['cor']; ?>" disabled>
		</div>
		<div class="form-group">
			<label for="asunto">Asunto del Mensaje:</label>
			<input type="text" name="asunto" class="form-control" id="asunto" placeholder="Asunto del mensaje">
		</div>
		<div class="form-group">
			<label for="mail">Mensaje</label>
			<textarea name="mail" class="form-control" rows="8" id="mail"></textarea>
		</div>
		<div align="center">
		<button align="center" type="button" onclick="tareas('tareas.php?tipo=1&fase=4','pan','Enviando mensaje');" class="btn btn-default btn-sm">
			  <span class="glyphicon glyphicon-send"></span> Enviar Mensaje 
		</button>
		</div>
		<?php
	}
}
else
{
	?>
	<div align="center">
	<p>Escoja la opcion de mensajeria que quiera realizar:</p>
	    <a href="#mensajesrecibidos" onclick="tareas('tareas.php?tipo=1&fase=1','pan','Cargando Mensajes Recibidos...');" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-save"></span> Mensajes Recibidos
        </a>
		<a href="#mensajesenviados" onclick="tareas('tareas.php?tipo=1&fase=2','pan','Cargando Mensajes Enviados...');" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-open"></span> Mensajes Enviados
        </a>
		<a href="#enviar" onclick="tareas('tareas.php?tipo=1&fase=3','pan','Cargando Editor Mensaje...');" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-send"></span> Enviar Mensaje Privado
        </a>
	</div>
	<?php
}
}

if($_GET['tipo'] == 3)//el usuario tal te ha enviado un curriculum
{
	$sql="SELECT nombre, apellido, correo, id FROM usuarios where id = '".$_GET['id']."' limit 1";
	$sql2="SELECT contenido FROM curri where id = '".$_GET['id']."' limit 1";
	$busqueda=$conexion->query($sql);
	$busqueda2=$conexion->query($sql2);
	if($busqueda->num_rows != 00 && $busqueda2->num_rows != 00)
	{
		$fila=mysqli_fetch_row($busqueda);
		$fila2=mysqli_fetch_row($busqueda2);
		echo "<h3>Curriculum de ".$fila[0]." ".$fila[1]."</h3>";
		echo htmlspecialchars_decode($fila2[0]);
		?>
			<div align="center"><p>Abajo se muestran las diferentes opciones que se pueden realizar:</p><button type="button" class="btn btn-danger" onclick="tareas('tareas.php?tipo=5&id=<?php echo $fila[3]; ?>','pan','Denegando curriculum..')">Denegar Curriculum</button> <button type="button" class="btn btn-success" onclick="tareas('tareas.php?tipo=4&id=<?php echo $fila[3]; ?>','pan','Aceptando curriculum..')">Aceptar</button> <button type="button" class="btn btn-warning" onclick="tareas('tareas.php?tipo=6&id=<?php echo $fila[3]; ?>','pan','Guardando curriculum..')">Guardar para proximas Vacantes</button></div>
			<div align="center"><p>Tambien puede contactar directamente con el usuario para saber mas de el o informarse antes de tomar una decision pulsando el boton de MP.</p><button type='button' onclick="tareas('tareas.php?tipo=1&fase=5&cor=<?php echo $fila[2]; ?>','pan','Mensajeria cargando...');" class='btn btn-default btn-sm'><span class='glyphicon glyphicon-envelope'></span> MP</button></div>
		<?php
	}
	else
	{
		echo "<p>Lo sentimos pero el curriculum que esta intentando ver ahora mismo no esta disponible, puede ser causa de varias razones como que no haya creado ningun curriculum o que se haya dado de baja en la plataforma.</p>";
		echo '<div align="center"><a href="tablon.php"><button type="button"  class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Inicio</span></button></a></div>';
	}
}

if($_GET['tipo'] == 4)//Han aceptado tu curriculum
{
	//Mostraremos una explicacion de como se hara la comunicacion
	if($_SESSION['tipo'] === "empresa")
	{
		//eres una empresa
		$sql="UPDATE actividades set datos='aceptado', fecha='".date("Y/m/d")."' where id_user = '".$_SESSION['id']."' and id_desti = '".$_REQUEST['id']."' and id_tipo_actividad = '3'";
		$busqueda=$conexion->query($sql);
		echo "<div align='center'><p>Se ha aceptado el curriculum, en breve el usuario recibira la confirmacion y estara esperando que contacten con el, para concretar la cita.</p></div>";
		$sql="INSERT INTO actividades (id_user,id_desti,fecha,id_tipo_actividad,actividad) VALUES ('".$_REQUEST['id']."','".$_SESSION['id']."','".date("Y/m/d")."','12','Hay novedades en los curriculums que has enviado revisalos por favor.')";
		$busqueda=$conexion->query($sql);
		echo '<div align="center"><a href="tablon.php"><button type="button"  class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Inicio</span></button></a></div>';
	}
	else
	{
		//eres un usuario
		echo "<div><p>Han aceptado tu solicitud por lo que se pondran en contacto contigo, mediante los mensajes privados de esta plataforma o otras vias de comunicacion que hayas agregado a tu curriculum.</p></div>";
		echo '<div align="center"><a href="tablon.php"><button type="button"  class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Inicio</span></button></a></div>';
	}
}

if($_GET['tipo'] == 5)//Han rechazado tu curriculum
{
	if($_SESSION['tipo'] === "empresa")
	{
		//eres una empresa
		$sql="UPDATE actividades set datos='denegado', fecha='".date("Y/m/d")."' where id_user = '".$_SESSION['id']."' and id_desti = '".$_REQUEST['id']."' and id_tipo_actividad = '3'";
		$busqueda=$conexion->query($sql);
		echo "<div align='center'><p>Has denegado el curriculum.</p></div>";
		$sql="INSERT INTO actividades (id_user,id_desti,fecha,id_tipo_actividad,actividad) VALUES ('".$_REQUEST['id']."','".$_SESSION['id']."','".date("Y/m/d")."','12','Hay novedades en los curriculums que has enviado revisalos por favor.')";
		$busqueda=$conexion->query($sql);
		echo '<div align="center"><a href="tablon.php"><button type="button"  class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Inicio</span></button></a></div>';
	}
	else
	{
		//eres un usuario
		echo "<div><p>Se ha denegado tu curriculum, esto ocurre muchas veces porque no ha rellenado bien su curriculum o porque no cumplia los requisitos minimos.</p></div>";
		echo '<div align="center"><a href="tablon.php"><button type="button"  class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Inicio</span></button></a></div>';
	}
}

if($_GET['tipo'] == 6)// han guardado tu curriculum para proximas vacantes
{
	if($_SESSION['tipo'] === "empresa")
	{
		//eres una empresa
		$sql="UPDATE actividades set datos='aplazado', fecha='".date("Y/m/d")."' where id_user = '".$_SESSION['id']."' and id_desti = '".$_REQUEST['id']."' and id_tipo_actividad = '3'";
		$busqueda=$conexion->query($sql);
		echo "<div align='center'><p>Has guardado este curriculum para proximos puestos ofertados.</p></div>";
		$sql="INSERT INTO actividades (id_user,id_desti,fecha,id_tipo_actividad,actividad) VALUES ('".$_REQUEST['id']."','".$_SESSION['id']."','".date("Y/m/d")."','12','Hay novedades en los curriculums que has enviado revisalos por favor.')";
		$busqueda=$conexion->query($sql);
		echo '<div align="center"><a href="tablon.php"><button type="button"  class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Inicio</span></button></a></div>';
	}
	else
	{
		//eres un usuario
		echo "<div><p>Han guardado tu curriculum para proximos puestos ofertados en tu categoria, esto es buena señal significa que le interesas a esta empresa, ContactON te aconseja que sigas buscando trabajo.</p></div>";
		echo '<div align="center"><a href="tablon.php"><button type="button"  class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Inicio</span></button></a></div>';
	}
}

if($_GET['tipo'] == 8)//buscar
{
	$sql="SELECT nombre, tipo, id FROM usuarios where nombre like '%".$_REQUEST['busqueda']."%' limit 50";
	$busqueda=$conexion->query($sql);
	if($busqueda->num_rows != 00)
	{
		echo '<div class="list-group">';
		while ($fila = mysqli_fetch_row($busqueda)) 	
		{
			if($fila[1] === "empresa")
			{
				?><a href="#" onclick="tareas('buzon.php?id_empresa=<?php echo $fila[2];?>','cp');" class="list-group-item"><span class="badge">Empresa</span><?php echo $fila[0];?></a>
				<?php
			}
			else
			{
				?><a href="#" onclick="tareas('buzon.php?id_empresa=<?php echo $fila[2];?>','cp');" class="list-group-item"><span class="badge">Usuario</span><?php echo $fila[0];?></a>
				<?php
			}
		}
		echo '</div>';
	}
	else
	{
		echo '<div class="well well-lg">No se ha podido encontrar las empresas o usuarios relacionados con los terminos "'.$_REQUEST['busqueda'].'",vuelva a buscarlo con otros terminos diferentes.</div>';
		echo '<div align="center"><a href="tablon.php"><button type="button"  class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Inicio</span></button></a></div>';
	}
}

if($_GET['tipo'] == 9)//visualizar mensaje tuyo
{
	$sql="SELECT id_receptor, fecha, asunto, mensaje FROM mensajes where id = '".$_REQUEST['id_men']."' limit 1";
	$busqueda=$conexion->query($sql);
	if($busqueda->num_rows != 00)
	{
		$fila=mysqli_fetch_row($busqueda);
		$sql2="SELECT nombre FROM usuarios where id = '".$fila[0]."' limit 1";
		$busqueda2=$conexion->query($sql2);
		$fila2=mysqli_fetch_row($busqueda2);
		echo "<h6>"."El mensaje se envio a las:".$fila[1]." al usuario:".$fila2[0]."</h6><hr/>";
		echo "<h3>Asunto: ".$fila[2]."</h3><br/>";
		echo "<h4>Ha enviado este mensaje: ".$fila[3]."</h4>";
		echo '<div align="center"><a href="tablon.php"><button type="button"  class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Inicio</span></button></a></div>';
	}
	else
	{
		echo '<div class="well well-lg">No se ha podido visualizar el mensaje que queria ver, intentelo mas tarde por favor.</div>';
		echo '<div align="center"><a href="tablon.php"><button type="button"  class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Inicio</span></button></a></div>';
	}
}

if($_GET['tipo'] == 10)//visualizar mensaje de otro
{
	$sql="SELECT id_emisor, fecha, asunto, mensaje FROM mensajes where id = '".$_REQUEST['id_men']."' limit 1";
	$busqueda=$conexion->query($sql);
	if($busqueda->num_rows != 00)
	{
		
		$fila=mysqli_fetch_row($busqueda);
		$sql2="SELECT nombre FROM usuarios where id = '".$fila[0]."' limit 1";
		$busqueda2=$conexion->query($sql2);
		$fila2=mysqli_fetch_row($busqueda2);
		echo "<h6>"."El mensaje se ha recibido a las:".$fila[1]." del usuario:".$fila2[0]."</h6><hr/>";
		echo "<h3>Asunto: ".$fila[2]."</h3><br/>";
		echo "<h4>Ha enviado este mensaje: ".$fila[3]."</h4>";
		echo '<div align="center"><a href="tablon.php"><button type="button"  class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Inicio</span></button></a></div>';
	}
	else
	{
		echo '<div class="well well-lg">No se ha podido visualizar el mensaje que queria ver, intentelo mas tarde por favor.</div>';
		echo '<div align="center"><a href="tablon.php"><button type="button"  class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Inicio</span></button></a></div>';
	}
}

if($_GET['tipo'] == 11)//buzon de empresa
{
	$sql="SELECT id, fecha, id_desti, datos FROM actividades where id_user = '".$_SESSION['id']."' and id_tipo_actividad = 3";
	$busqueda=$conexion->query($sql);
	if($busqueda->num_rows != 00)
	{
		echo '<div class="list-group">';
		while ($fila = mysqli_fetch_row($busqueda)) 	
		{
				if($fila[3] == "aceptado")
				{
					$opcion='<span class="label label-success">Aceptado</span>';
				}
				else if($fila[3] == "denegado")
				{
					$opcion='<span class="label label-danger">No Aceptado</span>';
				}
				else if($fila[3] == "aplazado")
				{
					$opcion='<span class="label label-warning">Guardado</span>';
				}
				else
				{
					$opcion='<span class="label label-default">En espera</span>';
				}
				$sql2="SELECT nombre FROM usuarios where id = '".$fila[2]."' limit 1";
				$busqueda2=$conexion->query($sql2);
				$fila2=mysqli_fetch_row($busqueda2);
				?><a href="#" onclick="tareas('tareas.php?tipo=3&id=<?php echo $fila[2]; ?>','pan','Cargando Curriculum');" class="list-group-item">Curriculum de <?php echo $fila2[0]; echo "&nbsp;".$opcion;?><span class="badge"><?php echo $fila[1]; ?></span></a><?php
		}
		echo '</div>';
		echo '<div align="center"><a href="tablon.php"><button type="button"  class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Inicio</span></button></a></div>';
	}
	else
	{
		echo '<div class="well well-lg">No tiene ningun curriculum en su buzon.</div>';
		echo '<div align="center"><a href="tablon.php"><button type="button"  class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Inicio</span></button></a></div>';
	}
}
if($_GET['tipo'] == 12)//curriculums enviados
{
	$sql="SELECT id, fecha, id_user, datos FROM actividades where id_desti = '".$_SESSION['id']."' and id_tipo_actividad = 3 order by fecha desc";
	$busqueda=$conexion->query($sql);
	if($busqueda->num_rows != 00)
	{
		echo '<div class="list-group">';
		while ($fila = mysqli_fetch_row($busqueda)) 	
		{
				$sql2="SELECT nombre FROM usuarios where id = '".$fila[2]."' limit 1";
				$busqueda2=$conexion->query($sql2);
				$fila2=mysqli_fetch_row($busqueda2);
				if($fila[3] == "aceptado")
				{
					$opcion='<span class="label label-success">Aceptado</span>';
					$ruta='onclick="tareas(&#039;tareas.php?tipo=4&#039;,&#039;pan&#039;,&#039;Cargando Guia...&#039;)"';
				}
				else if($fila[3] == "denegado")
				{
					$opcion='<span class="label label-danger">No Aceptado</span>';
					$ruta='onclick="tareas(&#039;tareas.php?tipo=5&#039;,&#039;pan&#039;,&#039;Cargando Guia...&#039;)"';
				}
				else if($fila[3] == "aplazado")
				{
					$opcion='<span class="label label-warning">Guardado para proximas vacantes</span>';
					$ruta='onclick="tareas(&#039;tareas.php?tipo=6&#039;,&#039;pan&#039;,&#039;Cargando Guia...&#039;)"';
				}
				else
				{
					$opcion='<span class="label label-default">En espera</span>';
				}
				?><a href="#" <?php echo $ruta; ?> class="list-group-item">Empresa: <?php echo $fila2[0]; echo "&nbsp;".$opcion; ?><span class="badge"><?php echo $fila[1]; ?></span></a><?php
		}
		echo '</div>';
		echo '<div align="center"><a href="tablon.php"><button type="button"  class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Inicio</span></button></a></div>';
	}
	else
	{
		echo '<div class="well well-lg">No has enviado ningun curriculum.</div>';
		echo '<div align="center"><a href="tablon.php"><button type="button"  class="btn btn-default btn-sm"><span class="glyphicon glyphicon-home"> Inicio</span></button></a></div>';
	}
}
//el numero 20 no tiene ninguna visualizacion
mysqli_close($conexion);
sleep(2);
?>