<?php
session_start();
include_once("conexion.php");
$contenido = "Mi Curriculum Vitae";
if(isset($_REQUEST['curri']))
{
$sql="UPDATE curri set contenido = '".htmlspecialchars($_REQUEST['curri'])."' where id = '".$_SESSION['id']."'";
$conexion->query($sql);
$sql3 = "INSERT INTO actividades (id_user,id_tipo_actividad,actividad,fecha) VALUES ('".$_SESSION['id']."','20','Has actualizado tu curriculum.','".date("Y/m/d")."')";
$conexion->query($sql3);
$sql4="SELECT contenido FROM curri where id = '".$_SESSION['id']."' limit 1";
$busqueda4=$conexion->query($sql4);
$fila4=mysqli_fetch_row($busqueda4);	
$contenido=$fila4[0];
}
else
{
	$sql="SELECT contenido FROM curri where id = '".$_SESSION['id']."' limit 1";
	$busqueda=$conexion->query($sql);
	if($busqueda->num_rows == 00)
	{
		$sql2= "INSERT INTO curri (id,contenido) VALUES ('".$_SESSION['id']."','')";
		$sql3 = "INSERT INTO actividades (id_user,id_tipo_actividad,actividad,fecha) VALUES ('".$_SESSION['id']."','20','Has creado tu curriculum.','".date("Y/m/d")."')";
		$conexion->query($sql2);
		$conexion->query($sql3);
	}
	else
	{
			
			$fila=mysqli_fetch_row($busqueda);	
			$contenido=$fila[0];
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Editando Curriculum</title>
<meta charset="utf-8"/>
<link rel="shortcut icon" href="img/favicon.ico"/>
<script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>

</head>
<body style="width:99%;border:0.1em solid;border-color:green;border-radius:0.4em;" align="center">
<div style="width:100%;height:10%;margin:0 0 0 0;background-color:#84c1a3;color:white;font-size:1.2em;vertical-align:middle;" align="center"><div style="float:right;"><a href="tablon.php"><img class="img-responsive" src="img/iccontact.png" style="max-width:14%;max-height:100%;padding-top:0.1em;" alt="Volver al inicio"/></a></div><div><h2 style="margin:0 0 0 0;">Editando tu curriculum vitae</h2></div></div>
<div style="width:100%;height:100%;" align="center"><form action="editor.php" method="POST"><textarea id="curri" name="curri"  rows="10" cols="80"><?php echo $contenido;?></textarea><br/><p>Pulse "Cerrar" para terminar de editar su curriculum.</p><input type="submit" value="Guardar Curriculum"/><input type="button" onclick="cerrar();" value="Cerrar"/></form><h6>Copyright 2015 ContactON</h6></div>
            <script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'curri' );
				function cerrar()
				{
					window.close();
				}
            </script>
</body>
</html>
