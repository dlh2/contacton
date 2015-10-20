<?php 
session_start();
session_destroy();
header('Location: /');
?>
<?php session_start(); ?>
<html>
<head>
<meta charset="utf-8"/> 
 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<meta name="viewport" content="width=device-width, initial-scale=2"/>
<script type="text/javascript">
var idUsuario=<?php if(isset($_SESSION['id'])){echo 1;}else{echo 0;}?>;
function carga(){
	if(idUsuario > 0)
	{
		window.location ="/tablon/";
	}
} 
</script>
</head>
    <body onLoad="setInterval('carga()',100);">
<div class="container-fluid" style="padding-left:0;padding-right:0;">
	<div class="col-sm-12" style="padding-left:0;padding-right:0;">
		 <a href="/"><img class="img-responsive" src="/recursos/img/banner.png" alt="ContactON - Banner"/></a> 
	</div>
		
	<div class="col-sm-12">
		<div id="contenedor">
			<p align="center">Se cerro su sesion <a href="/">Ir a Inicio</a>.</p>
		</div>
	</div>
	
	<div id="footer">
		<div id="creditos" align="center"><br/>Copyright 2015 ContactON</div>
	</div>
</div>
</body>
</html>