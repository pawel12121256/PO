<?php

require_once('../Dane/bazadanych.php');

$db = new Database("mysql.cba.pl","pawel12121234","pawelHUE1234", 'pawel12121234');

session_start($_COOKIE["sessionID"]);
setcookie('sessionID', session_id(), time()+300);

$pesel_lek = $_GET['pesel'];

$sql_x = "SELECT * FROM `Lekarz` JOIN `Wizyta` USING(lekarzID) WHERE `Lekarz`.`pesel`='$pesel_lek' AND `login_pacjenta`=''";
$rezultat_x = $db->query($sql_x);

if($pesel_lek != '' && ($rezultat_x->num_rows)==0){
	echo "<script type='text/javascript'>
		r = confirm('Brak terminów.\\n\\n Nie ma wolnych terminów do wybranego lekarza, można spróbować dokonać zapisu do innego lekarza.\\n OK - WYBIERZ INNEGO LEKARZA\\n Anuluj - POWRÓT DO MENU');
		
		if(r==1){
			window.location.href='wyb_lek.php';
		}
		else{
			window.location.href='start.php';
		}
		</script>";
		
	$_SESSION['pesel_lek'] = $pesel_lek;
}

?>

</html>
		<head>
			<title>TWOJA PRZYCHODNIA</title>
			<meta http-equiv="content-type" content="text/html; charset=UTF-8">
			<link rel="icon" type="image/png" href="favicon.png" sizes="16x16" />
			<link rel="stylesheet" href="style_wyb_lek.css" />
		</head>
	<center>
	<h1>Wybierz lekarza:</h1>
	
	<div id="" style="overflow-y: scroll; height:300px; width:900px; border: medium solid black;">
		<ul>
		<?php
		
		$sql = "SELECT pesel,imie,nazwisko FROM `Lekarz` JOIN `Osoba` USING(pesel)";
		$rezultat = $db->query($sql);
		
		
			while ($row = ($rezultat->fetch_assoc()))
			{
			print("<li>");
					
					print("<a href='wyb_lek.php?pesel=$row[pesel]' style='color:black; text-decoration: none;'>$row[imie] $row[nazwisko]</a>");
				
			print("</li>");
			}
		?>
		</ul>
	
	</div>
	
	<a href="ustalanie_terminu.php"><button type="button">POWROT</button></a>
	
	</center>
	</body>
	</html>
