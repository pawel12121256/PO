<?php
	require_once('bazadanych.php');

	$db = new Database("mysql.cba.pl","pawel12121256","pawelHUE1234", 'pawel12121256_cba_pl');

	$sql = 'SELECT * FROM lekarze';
	$rezultat = $db->query($sql);
	echo $rezultat->num_rows;
?>
