		<h3>Formulario de registro de Empresas:</h3>
		<form class="form-horizontal" role="form" action="/" method="post" enctype="text/plain">
		<div class="col-xs-6">
			<label for="nombre">Nombre de la Empresa:</label><input onkeypress = "pulsar(event,'/index/registroe.php');" type="text" name="nombre" class="form-control input-lg" id="nombre" placeholder="ejemplo:burguer and chicken"/>
		</div>	
		<div class="col-xs-6">
			<label for="direccion">Direccion de la Empresa:</label><input onkeypress = "pulsar(event,'/index/registroe.php');" type="text" name="direccion" class="form-control input-lg" id="direccion" placeholder="calle 23 primero derecha"/>
		</div>	
		<div class="col-xs-6">
			<label for="pass">Password:</label><input type="password" onkeypress = "pulsar(event,'/index/registroe.php');" name="pass" class="form-control input-lg" id="pass" placeholder="Escoja un Password"/>
		</div>	
		<div class="col-xs-6">
			<label for="pass2">Repetir Password: </label><input onkeypress = "pulsar(event,'/index/registroe.php');" id="pass2" type="password" name="pass2" class="form-control input-lg" placeholder="Vuelve a introducir tu Password"/>
		</div>	
		<div class="col-xs-6">
			<label for="correo">Correo electrónico: </label><input onkeypress = "pulsar(event,'/index/registroe.php');" class="form-control input-lg" id="correo" type="email" name="correo" placeholder="ejemplo@ejemplo.com"/>
		</div><br/><br/>
		<div class="checkbox">
			<label><input type="checkbox" name="politica" id="politica" value="yes">Pulse para aceptar las <a href="#">politicas de uso</a>.</label>
		</div>	
		<button type="button" class="btn btn-default" onclick="envio('/index/registroe.php');">Enviar</button><br/><br/>
		</form>
		<hr/>
		<button type="button" class="btn btn-primary btn-sm" onclick="envio('/index/empleado.php');">Registrarse como Usuario</button>
		<br/><br/>
		<button type="button" class="btn btn-primary btn-sm" id="botonusuario" onclick="envio('/index/login.php');">Entrar(login)</button>