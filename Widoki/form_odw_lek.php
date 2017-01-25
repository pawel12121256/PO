<?php

require_once('../Dane/bazadanych.php');
require_once('../Logika/Poczta.php');

$db = new Database("mysql.cba.pl","pawel12121234","pawelHUE1234", 'pawel12121234');

session_start($_COOKIE["sessionID"]);
setcookie('sessionID', session_id(), time()+300);


$edycja = $_POST['edycja'];

$stan = $_GET['stan'];

if($edycja == '' && $stan == '') {
	$lekarzID = $_GET['lekarzID'];
	$_SESSION['lekarzID'] = $lekarzID;
}

if($edycja == 'posted') {
	$_SESSION['dzien_pocz'] = $_POST['dzien_pocz'];
	$_SESSION['miesiac_pocz'] = $_POST['miesiac_pocz'];
	$_SESSION['rok_pocz'] = $_POST['rok_pocz'];
	$_SESSION['dzien_kon'] = $_POST['dzien_kon'];
	$_SESSION['miesiac_kon'] = $_POST['miesiac_kon'];
	$_SESSION['rok_kon'] = $_POST['rok_kon'];
	$_SESSION['godz_pocz'] = $_POST['godz_pocz'];
	$_SESSION['min_pocz'] = $_POST['min_pocz'];
	$_SESSION['godz_kon'] = $_POST['godz_kon'];
	$_SESSION['min_kon'] = $_POST['min_kon'];
	$_SESSION['usprawiedliwienie'] = $_POST['usprawiedliwienie'];
	
	echo "<script type='text/javascript'>
		r = confirm('Potwierdź odwołanie.\\n\\n Czy na pewno chcesz odwołać wizyty?\\n OK - TAK\\n Anuluj - NIE');
		
		if(r==1){
			window.location.href='form_odw_lek.php?stan=1';
		}
		else{
			window.location.href='form_odw_lek.php';
		}
		</script>";
	
}
else if($stan == 1){
	
	$dzien_pocz = $_SESSION['dzien_pocz'];
	$miesiac_pocz = $_SESSION['miesiac_pocz'];
	$rok_pocz = $_SESSION['rok_pocz'];
	$dzien_kon = $_SESSION['dzien_kon'];
	$miesiac_kon = $_SESSION['miesiac_kon'];
	$rok_kon = $_SESSION['rok_kon'];
	$godz_pocz = $_SESSION['godz_pocz'];
	$min_pocz = $_SESSION['min_pocz'];
	$godz_kon = $_SESSION['godz_kon'];
	$min_kon = $_SESSION['min_kon'];
	$usprawiedliwienie = $_SESSION['usprawiedliwienie'];
	
	$time_d_po_re = mktime ($godz_pocz, $min_pocz, 0, $miesiac_pocz, $dzien_pocz, $rok_pocz);
	$time_d_zak_re = mktime ($godz_kon, $min_kon, 0, $miesiac_kon, $dzien_kon, $rok_kon);
	
	if($time_d_po_re < $time_d_zak_re &&
		$dzien_pocz<=31 && $dzien_pocz>=1 && $miesiac_pocz<= 12 && $miesiac_pocz>=1 && $godz_pocz<=23 && $godz_pocz>=0 && $min_pocz<=59 && $min_pocz>=0 && 
		$dzien_kon<=31 && $dzien_kon>=1 && $miesiac_kon<= 12 && $miesiac_kon>=1 && $godz_kon<=23 && $godz_kon>=0 && $min_kon<=59 && $min_kon>=0 &&
		$time_d_po_re > time() &&
		$time_d_zak_re > time()){
			
		$IDlekarza = $_SESSION['lekarzID'];
			
		$sql_x = "SELECT * FROM `Wizyta` WHERE `lekarzID`='$IDlekarza'";
		$rezultat_x = $db->query($sql_x);
		
			while ($row = ($rezultat_x->fetch_assoc()))
			{
				$IDwiz = $row[wizytaID];
				$date_po = $row[data];
				$g_po = $row[godzina];
				$g_zak = $row[godzina_k];
				
				$time_d_po_bd = strtotime($date_po . $g_po);
				$time_d_zak_bd = strtotime($date_po . $g_zak);
				
				
				if($time_d_zak_bd>$time_d_po_re && $time_d_zak_re>$time_d_po_bd) {
					
					
					$poczta = new Poczta();
					if($poczta->sendMails($usprawiedliwienie)){
						echo "<script type='text/javascript'>
						alert('Potwierdzenie odwołania\\n\\n Poprawnie odwołano wizyty!');
						window.location.href='start.php';
						</script>";
		
						setcookie('sessionID', session_id(), time());
						
						$sql_y = "UPDATE `Wizyta` SET `login_pacjenta` = '' WHERE `Wizyta`.`wizytaID` = '$IDwiz'";
						$db->query($sql_y);
					}
					else
					{
						echo "<script type='text/javascript'>
						r = confirm('Błąd podczas wysyłania\\n\\n Podczas wysyłania wiadomości do pacjentów wystąpił błąd.\\n OK - KONTYNUUJ\\n Anuluj - POWRÓT DO MENU');
		
						if(r==1){
							window.location.href='form_odw_lek.php?stan=2';
						}
						else{
							window.location.href='start.php';
						}
						</script>";
					}
					header("location: start.php");
				}
			}
			
			
	
		
	
	}
	else
	{
		echo "<script type='text/javascript'>
		r = confirm('Niepoprawny czas\\n\\n Wprowadzony zakres czasowy jest niepoprawny.\\n OK - SPRÓBUJ JESZCZE RAZ\\n Anuluj - POWRÓT DO MENU');
		
		if(r==1){
			window.location.href='form_odw_lek.php';
		}
		else{
			window.location.href='start.php';
		}
		</script>";
	}
}
else if($stan == 2){
	echo "<script type='text/javascript'>
		r = confirm('Błąd podczas wysyłania\\n\\n Chcesz spróbować jeszcze raz czy odwołać bez powiadamiania pacjentów?\\n OK - ODWOŁAJ BEZ POWIADAMIANIA\\n Anuluj - SPRÓBUJ JESZCZE RAZ');
		
		if(r==1){
			window.location.href='powiadom.php';
		}
		else{
			window.location.href='form_odw_lek.php';
		}
		</script>";
}


/*

$pesel_pacjen = $_SESSION['pesel_pacj'];
$sql_y = "SELECT login FROM `Pacjent` WHERE `pesel`='$pesel_pacjen'";
$rezultat_y = $db->query($sql_y);
$row = ($rezultat_y->fetch_assoc());
$login_pacj = $row[login];

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
		
}
else if($pesel_lek != '' && ($rezultat_x->num_rows)>0){
	$_SESSION['pesel_lek'] = $pesel_lek;
	$_SESSION['login_pacj'] = $login_pacj;
	header("location: wyb_ter.php?check=ok");
}

*/

?>

</html>
		<head>
			<title>TWOJA PRZYCHODNIA</title>
			<meta http-equiv="content-type" content="text/html; charset=UTF-8">
			<link rel="icon" type="image/png" href="favicon.png" sizes="16x16" />
			<link rel="stylesheet" href="style_form_odw_lek.css" />
		</head>
	<body>
	<center>
	<h1>Wybierz zakres absencji:</h1>
	
	
	
	
	<form method = "post" action = "form_odw_lek.php">
	
	<table style="width:100%">
		<tr>
			<th style="width:500px"><h2>Początek:</h2></th>
			<th></th> 
			<th style="width:500px"><h2>Koniec:</h2></th>
		</tr>
		<tr>
			<td>
				<table style="width:100%">
					<tr>
						<td style="width:100px"></td>
						<td><h6>Dzień</h6></td>
						<td><h6>Miesiąc</h6></td>
						<td><h6>Rok</h6></td>
						<td style="width:100px"></td>
					</tr>
					<tr>
						<td style="width:100px"></td>
						<td><input type="text" name="dzien_pocz" required /></td>
						<td><input type="text" name="miesiac_pocz" required /></td>
						<td><input type="text" name="rok_pocz" required /></td>
						<td style="width:100px"></td>
					</tr>
				</table>
			</td>
			
			<td></td>
			
			<td>
				<table style="width:100%">
					<tr>
						<td style="width:100px"></td>
						<td><h6>Dzień</h6></td>
						<td><h6>Miesiąc</h6></td>
						<td><h6>Rok</h6></td>
						<td style="width:100px"></td>
					</tr>
					<tr>
						<td style="width:100px"></td>
						<td><input type="text" name="dzien_kon" required /></td>
						<td><input type="text" name="miesiac_kon" required /></td>
						<td><input type="text" name="rok_kon" required /></td>
						<td style="width:100px"></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>
				<table style="width:100%">
					<tr>
						<td style="width:150px"></td>
						<td><h6>Godz.</h6></td>
						<td><h6>Min.</h6></td>
						<td style="width:150px"></td>
					</tr>
					<tr>
						<td style="width:150px"></td>
						<td><input type="text" name="godz_pocz" required /></td>
						<td><input type="text" name="min_pocz" required /></td>
						<td style="width:150px"></td>
					</tr>
				</table>
			</td>
			
			<td></td>
			
			<td>
				<table style="width:100%">
					<tr>
						<td style="width:150px"></td>
						<td><h6>Godz.</h6></td>
						<td><h6>Min.</h6></td>
						<td style="width:150px"></td>
					</tr>
					<tr>
						<td style="width:150px"></td>
						<td><input type="text" name="godz_kon" required /></td>
						<td><input type="text" name="min_kon" required /></td>
						<td style="width:150px"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	
	
	<h1>Powód nieobecności:</h1>
	
	<textarea rows="4" cols="120" name="usprawiedliwienie" placeholder="Tutaj wpisz powód nieobecności... "></textarea>
	
		<a href="odw_lek.php"><button type="button">POWRÓT</button></a>
		<button type="submit">DALEJ</button>
		
		<p><input type="hidden" name="edycja" value="posted"/><br></p>
		
	</form>
	
	
	
	</center>
	</body>
	</html>
