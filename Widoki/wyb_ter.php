<?php

require_once('../Dane/bazadanych.php');

$db = new Database("mysql.cba.pl","pawel12121234","pawelHUE1234", 'pawel12121234');

setlocale(LC_TIME, "pl_PL");

session_start($_COOKIE["sessionID"]);
setcookie('sessionID', session_id(), time()+300);

/*

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
*/
?>

</html>
		<head>
			<title>TWOJA PRZYCHODNIA</title>
			<meta http-equiv="content-type" content="text/html; charset=UTF-8">
			<link rel="icon" type="image/png" href="favicon.png" sizes="16x16" />
			<link rel="stylesheet" href="style_wyb_lek.css" />
		</head>
	<center>
	<h1>Wybierz termin wizyty:</h1>
	
	<div id="" style="overflow-y: scroll; height:300px; width:900px; border: medium solid black;">
		<ul>
		<?php
		
		$pesel_lek = $_SESSION['pesel_lek'];
		$sql = "SELECT * FROM `Lekarz` JOIN `Wizyta` USING(lekarzID) WHERE `pesel`='$pesel_lek' AND `login_pacjenta`=''";
		$rezultat = $db->query($sql);
		
		
			while ($row = ($rezultat->fetch_assoc()))
			{
			print("<li>");
					
					$dzien_tyg = date('N',$row[data]);
					if($dzien_tyg==1) $dzien_tyg_sl = "Poniedzialek";
					else if($dzien_tyg==2) $dzien_tyg_sl = "Wtorek";
					else if($dzien_tyg==3) $dzien_tyg_sl = "Środa";
					else if($dzien_tyg==4) $dzien_tyg_sl = "Czwartek";
					else if($dzien_tyg==5) $dzien_tyg_sl = "Piątek";
					else if($dzien_tyg==6) $dzien_tyg_sl = "Sobota";
					else if($dzien_tyg==7) $dzien_tyg_sl = "Niedziela";
					
					$godz_st = $row[godzina];
					$godz_end = $row[godzina_k];
					
					print("<a href='wyb_ter.php?wizyta=$row[wizytaID]' style='color:black; text-decoration: none;'>$dzien_tyg_sl $godz_st - $godz_end</a>");
				
			print("</li>");
			}
		?>
		</ul>
	
	</div>
	
	<a href="wyb_lek.php"><button type="button">POWROT</button></a>
	
	</center>
	</body>
	</html>
