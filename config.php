<?php 
	session_start();

	$conn = mysqli_connect("localhost", "root", "", "blogSSI");
    $conn->set_charset("utf8");

	if (!$conn) {
		die("Blad laczenia z baza: " . mysqli_connect_error());
	}

	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	define('BASE_URL', 'https://blogssi.000webhostapp.com/');
?>