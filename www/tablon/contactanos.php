  <div class="modal-dialog">
    <!-- Modal content-->
	
		<div id="div_contactanos" class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>	
			<h4 class="modal-title">Contáctanos</h4>
		  </div>
		  <div class="modal-body">
			<form id="form_contactanos" role="form" action="/" method="post" enctype="text/plain">
			<div class="form-group">
				<label for="nombre">Nombre:</label><input type="text" name="nombre" class="form-control" id="nombre" placeholder="ejemplo:Juan Manuel"/>
			</div>	
			<div class="form-group">
				<label for="apellidos">Apellidos:</label><input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="ejemplo:Fernandez García"/>
			</div>	
			<div class="form-group">
				<label for="email">E-mail:</label><input type="text" name="email" class="form-control" id="email" placeholder="ejemplo:juanmanufergar@hotmail.com"/>
			</div>
			<div class="form-group">
				<label for="id_motivo">Motivo de consulta:</label>
				<select id="id_motivo" class="form-control">
				  <option value="1">Quiero cambiar mi nombre</option>
				  <option value="2">Quiero cambiar mis apellidos</option>
				  <option value="3">Me equivoqué al escribir el correo</option>
				  <option value="4">Tengo una sugerencia</option>
				  <option value="5">Tengo una queja</option>
				  <option value="6">Otros</option>
				</select>
			</div>
			<div class="form-group">
				<label for="num_telf">Nº Telf:</label><input type="text" name="num_telf" class="form-control" id="num_telf" placeholder="ejemplo:640424532"/>
			</div>
			<div class="form-group">
				<label for="mensaje">Mensaje:</label><textarea name="mensaje" class="form-control" id="mensaje" placeholder="ejemplo: ¿Podría subir mi curriculum de EuroPass?" rows="5"></textarea >
			</div>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-default" onclick="tareas('/tablon/contactanos_submit.php','div_contactanos','Actualizando perfil...');">Enviar</button>
		  </div>
		</div>
  </div>
<script>
$('#contactanos').on('hidden.bs.modal', function () {
    $("#contactanos").load("/tablon/contactanos.php .modal-dialog");
});
</script>