<?php

require_once('../Dane/bazadanych.php');

$db = new Database("mysql.cba.pl","pawel12121234","pawelHUE1234", 'pawel12121234');

session_start($_COOKIE["sessionID"]);
setcookie('sessionID', session_id(), time()+300);

$lekarzID = $_GET['lekarzID'];
$_SESSION['lekarzID'] = $lekarzID;

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
