<?php 
	session_start();

	$conn = mysqli_connect("localhost", "id8254169_root", "KTpm)4mNY2b2Cnqnixk$", "id8254169_blogssi");
    $conn->set_charset("utf8");

	if (!$conn) {
		die("Blad laczenia z baza: " . mysqli_connect_error());
	}

	define ('ROOT_PATH', realpath(dirname(__FILE__)));
	define('BASE_URL', 'https://blogssi.000webhostapp.com/');
?>