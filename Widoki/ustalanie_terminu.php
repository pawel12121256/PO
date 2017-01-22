<?php
$edycja = $_POST['edycja'];
$pesel = $_POST['pesel'];
if( $edycja=='posted' && !preg_match('/[0-9]{11}/',$pesel)) 
		alert("Wpisany numer PESEL jest niepoprawny. Prawdopodobnie pomyliłeś się podczas wpisywania numeru.");

function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
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
