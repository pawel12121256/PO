<?php

require_once('../Dane/bazadanych.php');

$edycja = $_POST['edycja'];
$pesel = $_POST['pesel'];

$db = new Database("mysql.cba.pl","pawel12121234","pawelHUE1234", 'pawel12121234');


if( $edycja=='posted' && !preg_match('/[0-9]{11}/',$pesel)) {
		
		echo "<script type='text/javascript'>
		r = confirm('Błędny PESEL\\n\\n Wpisany numer PESEL jest niepoprawny. Prawdopodobnie pomyliłeś się podczas wpisywania numeru.\\n OK - SPRÓBUJ JESZCZE RAZ\\n Anuluj - POWRÓT DO MENU');
		
		if(r==1){
			window.location.href='ustalanie_terminu.php';
		}
		else{
			window.location.href='start.php';
		}
		</script>";
		
		/*
		if($r==1){}
		else {
			header("location: start.php");
		}
		*/
}
else if( $edycja=='posted' && preg_match('/[0-9]{11}/',$pesel)) {
	
	$sql = "SELECT * FROM `Pacjent` WHERE `pesel`='$pesel'";
	$rezultat = $db->query($sql);
	
	if(($rezultat->num_rows)==0){
		
		echo "<script type='text/javascript'>
		r = confirm('Brak numeru PESEL w bazie danych\\n\\n Nie znaleziono wpisanego numeru PESEL w bazie danych. Być może pacjent nie jest jeszcze zarejestrowany w systemie.\\n OK - SPRÓBUJ JESZCZE RAZ\\n Anuluj - POWRÓT DO MENU');
		
		if(r==1){
			window.location.href='ustalanie_terminu.php';
		}
		else{
			window.location.href='start.php';
		}
		</script>";
		
	}
	else{
		session_start();
		$_SESSION['pesel_pacj'] = $pesel;
		setcookie('sessionID', session_id(), time()+300);
		
		header("location: wyb_lek.php");
	}
}
	
	
function alert($msg) {
    echo "<script type='text/javascript'>r = confirm('$msg');</script>";
	return r;
}
?>


</html>
		<head>
			<title>TWOJA PRZYCHODNIA</title>
			<meta http-equiv="content-type" content="text/html; charset=UTF-8">
			<link rel="icon" type="image/png" href="favicon.png" sizes="16x16" />
			<link rel="stylesheet" href="style_ust_t.css" />
		</head>
	<body>
	<center><br><br><br>
	<h1>Wprowadź numer PESEL pacjenta:</h1>
	
	<form method = "post" action = "ustalanie_terminu.php">
		<p><input type="hidden" name="edycja" value="posted"/><br></p>
		<p><input type="text" name="pesel" required autocomplete="on" /><br></p>
	
		<a href="start.php"><button type="button">POWRÓT</button></a>
		<button type="submit">DALEJ</button>
	</form>
	
	</center>
	
	
	
	</body>
	</html>
