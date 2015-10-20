<?php 
session_start(); 
$id=$_SESSION['id'];
if(isset($_REQUEST['numero']))
{
	$numero=$_REQUEST['numero'];
}
else
{
	$numero=6;	
}
include_once("conexion.php");
$sql="SELECT id, id_tipo_actividad, actividad, fecha, visto, id_desti FROM actividades where id_user = '".$_SESSION['id']."' ORDER BY id desc limit ".$numero;
$busqueda=$conexion->query($sql);
while ($fila = mysqli_fetch_row($busqueda)) {
								if($fila[4] == 0)
								{
									$conexion->query("UPDATE actividades set visto=1 where id=".$fila[0]);
									if($fila[1] == 20)
									{
										?><a href="#Mostrar" class="list-group-item"><h4 class="list-group-item-heading"><span class="label label-default">Nuevo</span><?php echo $fila[2]; ?></h4><p class="list-group-item-text"><?php echo $fila[3]; ?></p></a><?php
									}
									else
									{
										?><a href="#Mostrar" onclick="tareas('tareas.php?tipo=<?php echo $fila[1]; ?>&id=<?php echo $fila[5]; ?>','pan','Mostrando tarea..');" class="list-group-item"><h4 class="list-group-item-heading"><span class="label label-default">Nuevo</span><?php echo $fila[2]; ?></h4><p class="list-group-item-text"><?php echo $fila[3]; ?></p></a><?php
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
										?><a href="#Mostrar" onclick="tareas('tareas.php?tipo=<?php echo $fila[1]; ?>&id=<?php echo $fila[5]; ?>','pan','Mostrando tarea..');" class="list-group-item"><h4 class="list-group-item-heading"><?php echo $fila[2]; ?></h4><p class="list-group-item-text"><?php echo $fila[3]; ?><span class="label label-info">Visto</span></p></a><?php
									}
								}
}
mysqli_close($conexion);
sleep(4);
?>