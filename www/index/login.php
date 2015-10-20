		<h3>Entrar en mi Perfil:</h3>
		<form class="form-horizontal" role="form" action="/" method="post" enctype="text/plain">
		<div class="col-xs-12" style="text-align:center;">
			<label for="correo">Correo electrónico: </label><input onkeypress = "pulsar(event,'/index/loginacceso.php');" class="form-control input-lg" id="correo" type="email" name="correo" placeholder="ejemplo@ejemplo.com"/>
		</div>
		<div class="col-xs-12">
			<label for="pass">Password:</label><input type="password" onkeypress = "pulsar(event,'/index/loginacceso.php');"  name="pass" class="form-control input-lg" id="pass" placeholder="Escoja una contraseña"/>
		</div>
		<div class="col-sm-12">		
		<div class="checkbox">
			<label><input type="checkbox" name="veri" id="veri" value="veri">No volver a pedir verificacion.</label>
		</div>
		<br/>
		<button type="button" class="btn btn-default" onclick="envio('/index/loginacceso.php');">Conectarse</button><br/><br/>
		</div>
		</form>
		<div class="btn-group btn-group-sm">
			<hr/>
			<br/>
			<button type="button" class="btn btn-primary" onclick="envio('/index/empleado.php');">Registrarse como Usuario</button>
			<button type="button" class="btn btn-primary" onclick="envio('/index/empresa.php');">Registrarse como Empresa</button>
		</div>
		