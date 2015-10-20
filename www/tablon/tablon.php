<?php session_start();
if(!isset($_SESSION['id']))
{
	header('Location: /index.php');
}
 ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Tablon</title>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1"/>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link rel="icon" href="/recursos/img/favicon.ico"/>
  <script></script>
  <script type="text/javascript">
	var t;
	t=setInterval('reload()',20000);
	var numero=6;
	function rel(a)
	{
		if(a == 1)
		{
			t=setInterval('reload()',20000);
		}
		else
		{
			clearInterval(t);
		}
	};
	function reload(a)
	{
	if(a != null)
	{
		numero=numero+a;
	}
	var conexion;
	//opciones de compatibilidad
	if(window.XMLHttpRequest)
	{
		conexion=new XMLHttpRequest();
	}
	else
	{
		conexion=new ActiveXObject('Microsoft.XMLHTTP');
	}
	//envio y recibo de informacion
	conexion.onreadystatechange=function()
	{
		if (conexion.readyState==4 && conexion.status==200)
		{
		var d = document.getElementById("lista");
		while (d.hasChildNodes())
		{
			d.removeChild(d.firstChild);
		}
		document.getElementById("carga").innerHTML="";
		document.getElementById("lista").innerHTML=conexion.responseText;
		}
	}
	parametros="?numero="+numero;
	document.getElementById("carga").innerHTML=' <br/><div class="progress" style="width:100%;text-align:center;margin:5px;padding:0;"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="50" style="width:100%;background-color:orange;"> Actualizando </div></div>';
	conexion.open("GET","/tablon/reload.php"+parametros,true);
	conexion.send();
};
	function tareas(a,b,c)
	{
	rel(0);
	var conexion;
	//opciones de compatibilidad
	mensajeload=c;
	if(b == "pan")
	{
		if(document.getElementById('pandes'))
		{
			document.getElementById('pandes').innerHTML = "Panel";
			document.getElementById('activi').innerHTML = "";
		}
		else
		{
			b='cp';
		}			
	}
	if(typeof(c) === "undefined")
	{
		mensajeload = "Procesando Peticion.....";
	}
	
	if(window.XMLHttpRequest)
	{
		conexion=new XMLHttpRequest();
	}
	else
	{
		conexion=new ActiveXObject('Microsoft.XMLHTTP');
	}
	//envio y recibo de informacion
	conexion.onreadystatechange=function()
	{
		if (conexion.readyState==4 && conexion.status==200)
		{
			if(document.getElementById(b))
			{
				document.getElementById(b).innerHTML="";
				document.getElementById(b).innerHTML=conexion.responseText;
			}
			else
			{
				document.getElementById('cp').innerHTML="";
				document.getElementById('cp').innerHTML=conexion.responseText;
			}
		}
	}
	if(a == '/tablon/tareas.php?tipo=8')
	{
		parametros="&busqueda="+document.getElementById('buscar').value;
	}
	else if(a == '/tablon/tareas.php?tipo=1&fase=4')
	{
		parametros="&mensaje="+document.getElementById('mail').value;
		parametros=parametros+"&asunto="+document.getElementById('asunto').value;
		parametros=parametros+"&des="+document.getElementById('des').value;
	}
	else if(a == '/tablon/contactanos_submit.php')
	{
		parametros="?nombre="+document.getElementById('nombre').value;
		parametros=parametros+"&apellidos="+document.getElementById('apellidos').value;
		parametros=parametros+"&email="+document.getElementById('email').value;
		 var n_motiv = document.getElementById("id_motivo").selectedIndex;
		parametros=parametros+"&id_motivo="+
		document.getElementsByTagName("option")[n_motiv].value;parametros=parametros+"&num_telf="+document.getElementById('num_telf').value;parametros=parametros+"&mensaje="+document.getElementById('mensaje').value;
	}
	else if(a == '/tablon/mod_perfil_submit.php')
	{
		var avatar = new FormData();
        var file = document.getElementById('mp_archivo_perfil').files[0];
		avatar.append("mp_archivo_perfil", file);
		parametros="?direccion="+document.getElementById('domicilio').value;
		parametros=parametros+"&fecha="+document.getElementById('fec_nac').value;
		parametros=parametros+"&nif="+document.getElementById('nif').value;
	}
	else
	{
		parametros="";
	}
	if(document.getElementById(b))
	{	
		document.getElementById(b).innerHTML=' <br/><div class="progress" style="width:100%;text-align:center;margin:0 0 0 0;padding:0 0 0 0;"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="50" style="width:100%;background-color:gray;">'+mensajeload+'</div></div>';
	}
	else
	{
		document.getElementById('cp').innerHTML=' <br/><div class="progress" style="width:100%;text-align:center;margin:0 0 0 0;padding:0 0 0 0;"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="50" style="width:100%;background-color:gray;">'+mensajeload+'</div></div>';
	}
	if(a == '/tablon/mod_perfil_submit.php'){
		var conexion_i;
		if(window.XMLHttpRequest)
		{
			conexion_i=new XMLHttpRequest();
		}
		else
		{
			conexion_i=new ActiveXObject('Microsoft.XMLHTTP');
		}
		//envio y recibo de informacion
		conexion_i.onreadystatechange=function()
		{
			if (conexion.readyState==4 && conexion.status==200)
			{
				if (conexion_i.readyState==4 && conexion_i.status==200)
				{
					document.getElementById("image_upload_result").innerHTML= conexion_i.responseText;
					location.reload(true);
				}
			}
		}
		conexion_i.open("POST","/tablon/image_upload.php",true);
		conexion_i.send(avatar);
	}
	conexion.open("GET",a+parametros,true);
	conexion.send();
};
function pulsar(e,ab,bb,cb)
{
	if(e.which == 13)
	{
		if(ab == '/tablon/tareas.php?tipo=8')
		{
			tareas(ab,bb,cb);
		}
	}
}
</script>
</head>
<body onLoad="t;" id="bod">
<div id="mod_perfil" class="modal fade" role="dialog">
<?php include_once( $_SERVER['DOCUMENT_ROOT'] . '/tablon/mod_perfil.php'); ?>
</div>
<?php
include_once( $_SERVER['DOCUMENT_ROOT'] . '/recursos/politicas_privacidad.php');
?>
<div id="contactanos" class="modal fade" role="dialog">
<?php include_once( $_SERVER['DOCUMENT_ROOT'] . '/tablon/contactanos.php'); ?>
</div>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/recursos/bd/conexion.php");?>
<div class="container-fluid" style="padding-left:0;padding-right:0;">
  <div class="jumbotron" style="background-color:#84c1a3;padding-top:20px;padding-bottom:58px;border-radius:0;padding-left:18%;">
    <div class="col-sm-3">
		<a href="/tablon/"><img class="img-responsive" src="/recursos/img/iccontact.png" style="max-width:60%;max-height:60%;" alt="Volver al inicio"/></a> 
	</div>
    <div class="col-sm-5">
		<div class="col-xs-8">
			<input class="form-control" id="buscar" onkeypress="pulsar(event,'/tablon/tareas.php?tipo=8','cp','Buscando...');" type="text">
		</div>
	    <button type="button" onclick="tareas('/tablon/tareas.php?tipo=8','cp','Buscando...');" class="btn btn-default btn-sm">
			<span class="glyphicon glyphicon-search"></span> Buscar 
        </button>
	</div>
    <div class="col-sm-4"> 
        <a href="/tablon/"><button type="button" style="float:left" class="btn btn-default btn-sm">
			<span class="glyphicon glyphicon-home"></span>
        </button></a>
		<div class="dropdown" style="float:left;max-width:20%;">
			<button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
				<span class="glyphicon glyphicon-th-list"></span>
			</button>		
			<ul class="dropdown-menu">
				<li><a href="#" data-toggle="modal" data-target="#mod_perfil">Opciones del Perfil</a></li>
				<li><a href="#" data-toggle="modal" data-target="#politicas_privacidad">Privacidad</a></li>
				<li><a href="#" data-toggle="modal" data-target="#contactanos">Contáctanos</a></li>

			</ul>
		</div>
		<a href="/tablon/closesesion.php"><button type="button" class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-off"></span>
        </button></a>
	</div>
  </div>
  
  <div class="container" id="cp">
    <div class="col-sm-4" style="text-align:center;">
		<div class="panel panel-info">
			
			<div class="panel-heading">Informacion del perfil</div>
				<div class="panel-body">
					<?php
						if($_SESSION['tipo'] == "empresa")
						{
							$sql="SELECT nombre, direccion, correo, url_foto, nif FROM usuarios where id = '".$_SESSION['id']."' limit 1";
							$busqueda=$conexion->query($sql);
							if ($busqueda->num_rows == 00) 
							{	
							echo "usted no esta logeado";
							}
							else
							{
								$fila=mysqli_fetch_row($busqueda);									
								if($fila[3] != "")
								{
									$imagen=$fila[3];
								}						
								else
								{
									$imagen="/recursos/img/defaultu.jpg";
								}
								
								if($fila[4] == "")
								{
									$nif=$fila[4];
								}						
								else
								{
									$nif="No Especificado";
								}
								echo '<img src="'.$imagen.'" class="img-circle" alt="Imagen de perfil" width="150" height="150"/>';
								echo "<br/>Informacion:<br/>Nombre:".$fila[0]."<br/>Direccion:".$fila[1]."<br/>Correo:".$fila[2]."<br/>Nif:".$nif."<br/><br/>";	
								?>
								<button type='button' onclick="tareas('/tablon/tareas.php?tipo=11','pan','Cargando Buzon de Currriculums');" class='btn btn-default btn-sm'><span class='glyphicon glyphicon-inbox'></span> Abrir Buzon</button>
								<button type='button' onclick="tareas('/tablon/tareas.php?tipo=1','pan','Mensajeria cargando...');" class='btn btn-default btn-sm'><span class='glyphicon glyphicon-envelope'></span>MP</button>
								<?php
							}
						}
						if($_SESSION['tipo'] == "usuario")
						{
							$sql="SELECT nombre, apellido, correo, url_foto FROM usuarios where id = '".$_SESSION['id']."' limit 1";
							$busqueda=$conexion->query($sql);
							if ($busqueda->num_rows == 00) 
							{	
								header('Location: /index.php');
								echo "usted no esta logeado";
							}
							else
							{
								$fila=mysqli_fetch_row($busqueda);									
								if($fila[3] != "")
								{
									$imagen=$fila[3];
								}						
								else
								{
									$imagen="/recursos/img/defaultu.jpg";
								}
								echo '<img src="'.$imagen.'" class="img-circle" alt="Imagen de perfil" width="150" height="150"/>';
								echo "<br/>Informacion:<br/>Nombre:".$fila[0]."<br/>Apellidos:".$fila[1]."<br/>Correo:".$fila[2]."<br/><br/>";
								?><a target="_blank" href="/tablon/editor.php"><button type="button" class='btn btn-default btn-sm'><span class='glyphicon glyphicon-list-alt'></span>Curriculum</button></a>&nbsp;<button type='button' onclick="tareas('/tablon/tareas.php?tipo=1','pan','Mensajeria cargando...');" class='btn btn-default btn-sm'><span class='glyphicon glyphicon-envelope'></span>MP</button><br/><br/>
								
								<button type="button" onclick="tareas('/tablon/tareas.php?tipo=12','pan','Cargando estado de curriculums enviados...');" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-share"></span>Estado de Curriculums</button>
								<?php
							}
						}
					?>
				</div>
			<div class="panel-footer"><a href="#">Mas Informacion del perfil</a></div>
		</div>
	</div>
    <div class="col-sm-8">
	
		<div class="panel panel-default" id="contenedor">
			<div class="panel-heading"><span id="pandes">Activadades Recientes</span><div id="carga" style="line-height:0;float:right;"></div></div>
			<div class="panel-body" id="pan">
				<div class="list-group" id="lista">
				  <?php 
						$id=$_SESSION['id'];
						$numero=6;	
						$sql2="SELECT id, id_tipo_actividad, actividad, fecha, visto, id_desti FROM actividades where id_user = '".$_SESSION['id']."' ORDER BY id desc limit ".$numero;
						$busqueda2=$conexion->query($sql2);
						while ($fila = mysqli_fetch_row($busqueda2)) {
								if($fila[4] == 0)
								{
									$conexion->query("UPDATE actividades set visto=1 where id=".$fila[0]);
									if($fila[1] == 20)
									{
										?><a href="#Mostrar" class="list-group-item"><h4 class="list-group-item-heading"><span class="label label-default">Nuevo</span><?php echo $fila[2]; ?></h4><p class="list-group-item-text"><?php echo $fila[3]; ?></p></a><?php
									}
									else
									{
										?><a href="#Mostrar" onclick="tareas('/tablon/tareas.php?tipo=<?php echo $fila[1]; ?>&id=<?php echo $fila[5]; ?>','pan','Mostrando tarea..');" class="list-group-item"><h4 class="list-group-item-heading"><span class="label label-default">Nuevo</span><?php echo $fila[2]; ?></h4><p class="list-group-item-text"><?php echo $fila[3]; ?></p></a><?php
									}
								}
								else
								{
									if($fila[1] == 20)
									{
										?><a href="#Mostrar" class="list-group-item"><h4 class="list-group-item-heading"><?php echo $fila[2]; ?></h4><p class="list-group-item-text"><?php echo $fila[3]; ?><span class="label label-info">Visto</span></p></a><?php
									}
									else
									{
										?><a href="#Mostrar" onclick="tareas('/tablon/tareas.php?tipo=<?php echo $fila[1]; ?>&id=<?php echo $fila[5]; ?>','pan','Mostrando tarea..');" class="list-group-item"><h4 class="list-group-item-heading"><?php echo $fila[2]; ?></h4><p class="list-group-item-text"><?php echo $fila[3]; ?><span class="label label-info">Visto</span></p></a><?php
									}
								}
						}
						mysqli_close($conexion);
					?>
				</div>
			</div>
		</div>
	
		<ul class="pager" id="activi">
			<li><a href="#" onclick="reload(6);">+ Actividades</a></li>
		</ul>
	</div>
  </div>
</div>
</body>
</html>
