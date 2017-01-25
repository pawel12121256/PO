<?php
	require_once('../Logika/Wizyta.php');
	
	$wizyta = new Wizyta('2017-02-01', '10:20', 2);
	
	$wizyta->setDate("2017-02-01");
	
	echo $wizyta->getDateWiz();
	print $wizyta->getDateWiz();
    

?>