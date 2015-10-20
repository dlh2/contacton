  <div class="modal-dialog">
    <!-- Modal content-->
	<?php 
		include( $_SERVER['DOCUMENT_ROOT'] . "/recursos/bd/conexion.php");
		$sql = "SELECT nombre, apellido, direccion, fecha, nif, url_foto FROM usuarios where id = '".$_SESSION['id']."' limit 1";
		$result = $conexion->query($sql);
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				$mp_nombre = $row["nombre"];
				$mp_apellido = $row["apellido"];
				$mp_direccion = $row["direccion"];
				$mp_fecha = $row["fecha"];
				$mp_nif = $row["nif"];
				$mp_url_foto = $row["url_foto"];
			}
		} else {
			echo "error";
		}
	?>
		<div id="div_mod_perfil" class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>	
			<h4 class="modal-title">Actualizar perfil de 
			<?php echo $mp_nombre . " " . $mp_apellido;?>
			</h4>
		  </div>
		  <div class="modal-body">
			<form id="form_mod_perfil" role="form" action="/" method="post" enctype="multipart/form-data">
			<div class="image-upload">
				<label for="mp_archivo_perfil">
					<img id="mp_temp_perfil" src="<?php if($mp_url_foto != "")
								{
									echo $mp_url_foto;
								}						
								else
								{
									echo "/recursos/img/defaultu.jpg";
								}?>" class="img-circle" alt="Imagen de perfil" width="150" height="150"/>
				</label>
				<input type="file" name="mp_archivo_perfil" id="mp_archivo_perfil"/>
			</div>		
			<div class="form-group">
				<label for="domicilio">Domicilio principal</label><input type="text" name="domicilio" class="form-control" id="domicilio" placeholder="ejemplo:Calle Los rosales 24 C" value="<?php echo $mp_direccion;?>"/>
			</div>	
			<div class="form-group">
				<label for="fec_nac">Fecha de nacimiento:</label><input type="text" name="fec_nac" class="form-control" id="fec_nac" placeholder="ejemplo:1992-02-03" value="<?php echo $mp_fecha;?>"/>
			</div>	
			<div class="form-group">
				<label for="nif">NIF:</label><input type="text" name="nif" class="form-control" id="nif" placeholder="NIF" value="<?php echo $mp_nif;?>"/>
			</div>
			<?php
			if($_SESSION['tipo'] == "empresa"){
			echo "<div class=\"form-group\">
				<label for=\"descripcion\">Descripción:</label><input type=\"text\" name=\"descripcion\" class=\"form-control\" id=\"descripcion\" placeholder=\"descripcion\"/>
			</div>";
			}
			?>
			</form>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-default" onclick="tareas('/tablon/mod_perfil_submit.php','div_mod_perfil','Actualizando perfil...');">Enviar</button>
		  </div>
		</div>
		<?php mysqli_close($conexion);?>
  </div>
  
<script>
/*$('#mod_perfil').on('hidden.bs.modal', function () {
    $("#mod_perfil").load("/tablon/mod_perfil.php .modal-dialog");
});
*/
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#mp_temp_perfil').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#mp_archivo_perfil").change(function(){
    readURL(this);
});
</script>
<style>
.image-upload > input
{
    display: none;
}
</style>