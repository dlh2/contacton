<?php session_start(); 
if(isset($_SESSION['id']))
{
	if($_SESSION['id'] > 0)
	{
		header('Location: ./tablon.php');
	}
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Inicio ContactON</title>
<meta charset="utf-8"/> 
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="shortcut icon" href="img/favicon.ico"/>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<script type="text/javascript">
var idUsuario=<?php if(isset($_SESSION['id'])){echo 1;}else{echo 0;}?>;
function envio(link)
{
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
		var d = document.getElementById("contenedor");
		while (d.hasChildNodes())
		{
			d.removeChild(d.firstChild);
		}
		document.getElementById("contenedor").innerHTML=conexion.responseText;
		}
	}
	if(link == "loginacceso.php")
	{
		var correo = document.getElementById("correo").value;
		var pass = document.getElementById("pass").value;
		parametros="?correo="+correo+"&pass="+pass;
	}
	else if(link == "registroe.php")
	{
		var nombre = document.getElementById("nombre").value;
		var direccion = document.getElementById("direccion").value;
		var pass = document.getElementById("pass").value;
		var pass2 = document.getElementById("pass2").value;
		var correo = document.getElementById("correo").value;
		if(document.getElementById("politica").checked)
		{
			var politica = document.getElementById("politica").value;
		}
		else
		{
			var politica="no";
		}
		parametros="?correo="+correo+"&pass="+pass+"&pass2="+pass2+"&nombre="+nombre+"&direccion="+direccion+"&politica="+politica;
	}
	else if(link == "registrou.php")
	{
		var nombre = document.getElementById("nombre").value;
		var apellido = document.getElementById("apellido").value;
		var pass = document.getElementById("pass").value;
		var pass2 = document.getElementById("pass2").value;
		var correo = document.getElementById("correo").value;
		if(document.getElementById("politica").checked)
		{
			var politica = document.getElementById("politica").value;
		}
		else
		{
			var politica="no";
		}
		parametros="?correo="+correo+"&pass="+pass+"&pass2="+pass2+"&nombre="+nombre+"&apellido="+apellido+"&politica="+politica;	
	}
	else
	{
		parametros="";
	}
	if(link == "registrou.php" || link == "registroe.php" || link == "loginacceso.php")
	{
		document.getElementById("contenedor").innerHTML=' <br/><div class="progress" style="text-align:center;"><div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="99" aria-valuemin="0" aria-valuemax="100" style="width:100%">Cargando....Por favor espere</div></div>';
	}
	conexion.open("GET",link+parametros,true);
	conexion.send();
};
function carga(){
	if(idUsuario > 0)
	{
		window.location ="tablon.php";
	}
};
function pulsar(e,ruta)
{
	if(e.which == 13)
	{
		if(ruta != undefined)
		{
			envio(ruta);
		}
	}
}
</script>
</head>
<body onLoad="setInterval('carga()',1000);>
<div class="container-fluid" style="padding-left:0;padding-right:0;">
	<div class="col-sm-12" style="padding-left:0;padding-right:0;">
		 <a href="/"><img class="img-responsive" src="img/banner.png" alt="Chania"/></a> 
	</div>
		
	<div class="col-sm-12">
		<div id="contenedor">
			<div class="col-sm-4">
			</div>
			<div class="col-sm-4">
				<br/>
				<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/Cx0lva2Ju2I" frameborder="0" allowfullscreen></iframe>
				</div>
				<br/>
				<hr/>
				<div id="opciones">
				<div class="btn-group btn-group-sm">
					<button type="button" class="btn btn-primary" onclick="envio('empleado.php');">Registrarse como Usuario</button>
					<button type="button" class="btn btn-primary" onclick="envio('empresa.php');">Registrarse como Empresa</button>
				</div><br/><br/>
				<button type="button" class="btn btn-primary btn-sm" id="botonusuario" onclick="envio('login.php');">Entrar(login)</button>
			</div>
			</div>
		</div>
	</div>
	<div class="col-sm-4">
			</div>
	<div class="col-sm-12">
		<div id="footer" style="padding-top:0;>
			<div id="creditos" align="center"><br/>Copyright 2015 ContactON</div>
		</div>
	</div>
</body>
</html>