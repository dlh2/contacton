<?php session_start();
$target_dir = "avatar/";
$target_file = $target_dir .$_SESSION['id']. "_". basename($_FILES["mp_archivo_perfil"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Si hay archivo hara algo, sino nada.
if($_FILES["mp_archivo_perfil"]["name"]!=""){
	// Check if file already exists
	$number = 1;
	while (file_exists($target_file)) {
		$target_file = $target_dir .$_SESSION['id']. "_" . $number . "_" . basename($_FILES["mp_archivo_perfil"]["name"]);
		$number++;
		$uploadOk = 1;
	}

	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["mp_archivo_perfil"]["tmp_name"]);
		if($check !== false) {
			$uploadOk = 1;
		} else {
			$uploadOk = 0;
		}
	}

	// Check file size
	if ($_FILES["mp_archivo_perfil"]["size"] > 500000) {
		echo "Tu imagen, pesa demasiado.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Lo siento, solo los formatos JPG, JPEG, PNG y GIF estan permitidos.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Lo sentimos, no se ha podido subir el archivo por un error.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["mp_archivo_perfil"]["tmp_name"], $target_file)) {
			echo "La imagen se ha subido correctamente.";
			include("conexion.php");
			$sql = "UPDATE usuarios SET url_foto='".$target_file."' WHERE id = '".$_SESSION['id']."' ";
			if ($conexion->query($sql) === TRUE) {
			
			} else {
				echo "<br> Ha sido un exito";
			}
			mysqli_close($conexion);
		} else {
			echo "Lo sentimos, ha habido un error durante la subida.";
		}
	}
} else {
	
}
?>