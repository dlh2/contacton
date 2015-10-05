<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="description" content="Una red social de empresarios y trabajadores, con ganas de trabajar.">
		<link rel="shortcut icon" href="favicon.ico">
		<title>Contact On - Contactando por ti.</title>
		<meta content="trabajo, empresas, curriculums, emprendedores, autonomo" name="keywords" />
		<link rel="stylesheet" href="/base.css">
	</head>
	<body>
		<?php
		$servername = "mysql.nixiweb.com";
		$username = "u770401726_dbco";
		$password = "LWWYUwhbX8";
		$dbname = "u770401726_dbco";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		?>
		<style>
		#menu{
			height:85px;
		}
		#side_menu{
		width:200px;
		}
		</style>
		<div id="menu" class="w3-topnav w3-small w3-black">
			<a href="#"> <img src="/IMG/banner.png"></a>
			<a href="#"> Search </a>
			<a href="#"> Perfil </a>
			<a href="#"> Mas opciones </a>
		</div>
		 <div class="w3-row">
			<div id="side_menu" class="w3-col w3-red">
				<center>
				 <img src="http://thedirt.co/images/icons/user_profile_placeholder.png" class="w3-circle" style="width:150px"> 
				</center>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
			</div>
			<div class="w3-rest w3-blue">
			<?php

			$sql = "SELECT id, estado FROM estados WHERE id_user='1' and visto=0";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					echo "id: " . $row["id"]. " - Name: " . $row["estado"]. "<br>";
				}
			} else {
				echo "0 results";
			}
			$conn->close();
			?>
			</div>
		</div>
	</body>
</html>