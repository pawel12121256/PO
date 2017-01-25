<?php

require_once('../Dane/bazadanych.php');

$db = new Database("mysql.cba.pl","pawel12121234","pawelHUE1234", 'pawel12121234');


?>

</html>
		<head>
			<title>TWOJA PRZYCHODNIA</title>
			<meta http-equiv="content-type" content="text/html; charset=UTF-8">
			<link rel="icon" type="image/png" href="favicon.png" sizes="16x16" />
			<link rel="stylesheet" href="style_powiadom.css" />
		</head>
	<center>
	<h1>Powiadom telefonicznie poniższych pacjentów:</h1>
	
	<div id="" style="overflow-y: scroll; height:300px; width:900px; border: medium solid black;">
		<ul>
		<?php
		
		$sql = "SELECT * FROM `Osoba` WHERE `pesel` = '95101912013'";
		$rezultat = $db->query($sql);
		
		
			while ($row = ($rezultat->fetch_assoc()))
			{
			print("<li>");
					
					print("<a href='#' style='color:black; text-decoration: none;'>$row[imie] $row[nazwisko] $row[nr_telefonu]</a>");
				
			print("</li>");
			}
		?>
		</ul>
	
	</div>
	
	<a href="start.php"><button type="button">POWRÓT</button></a>
	
	</center>
	</body>
	</html>
