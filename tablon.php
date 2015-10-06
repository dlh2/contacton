<!DOCTYPE html>
<html lang="es">
<head>
  <title>Tablon</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <link rel="icon" href="img/favicon.ico"/>
</head>
<body>
<div class="container-fluid" style="padding-left:0;padding-right:0;">
  
  <div class="jumbotron" style="background-color:#84c1a3;padding-top:20px;padding-bottom:58px;border-radius:0;padding-left:18%;">
    <div class="col-sm-3">
		<a href="tablon.php"><img class="img-responsive" src="img/iccontact.png" style="max-width:60%;max-height:60%;" alt="Volver al inicio"/></a> 
	</div>
    <div class="col-sm-5">
		<div class="col-xs-8">
			<input class="form-control" id="ex3" type="text">
		</div>
	    <button type="button" class="btn btn-default btn-sm">
			<span class="glyphicon glyphicon-search"></span> Buscar 
        </button>
	</div>
    <div class="col-sm-4"> 
        <button type="button" style="float:left" class="btn btn-default btn-sm">
			<span class="glyphicon glyphicon-home"></span>
        </button>
		<div class="dropdown" style="float:left;max-width:20%;">
			<button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
				<span class="glyphicon glyphicon-th-list"></span>
			</button>		
			<ul class="dropdown-menu">
				<li><a href="#">Opciones del Perfil</a></li>
				<li><a href="#">Privacidad</a></li>
				<li><a href="#">Contactanos</a></li>
			</ul>
		</div>
		<a href="closesesion.php"><button type="button" class="btn btn-default btn-sm">
          <span class="glyphicon glyphicon-off"></span>
        </button></a>
	</div>
  </div>
  
  <div class="container">
    <div class="col-sm-4" style="text-align:center;">
		<div class="panel panel-info">
			<div class="panel-heading">Informacion del perfil</div>
				<div class="panel-body">
					<img src="img/perfil.jpg" class="img-circle" alt="Cinque Terre" width="150" height="150">
				<br/>informacion
				</div>
			<div class="panel-footer"><a href="#">Mas Informacion del perfil</a></div>
		</div>
	</div>
    <div class="col-sm-8">
	
		<div class="panel panel-default">
			<div class="panel-heading">Activadades Recientes</div>
			<div class="panel-body">
				<div class="list-group">
				  <a href="#" class="list-group-item">
					<h4 class="list-group-item-heading">La empresa BurguerKing a revisado su curriculum.</h4>
					<p class="list-group-item-text">19/12/12 10:10</p>
				  </a>
				  <a href="#" class="list-group-item">
					<h4 class="list-group-item-heading">Has enviado tu curriculum a la Nasa</h4>
					<p class="list-group-item-text">21/11/11 15:00</p>
				  </a>
				  <a href="#" class="list-group-item">
					<h4 class="list-group-item-heading">Han desechado tu candidatura para el puesto de encargado en la empresa del Mercadona</h4>
					<p class="list-group-item-text">10/01/10 11:01</p>
				  </a>
				</div>
			</div>
		</div>
	
		<ul class="pager">
			<li><a href="#">+ Actividades</a></li>
		</ul>
	
	</div>
  </div>
</div>
</body>
</html>
