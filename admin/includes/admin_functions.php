<?php

/**********
 * Zarzadzanie użytkownikami
 ***********/

 //Dodawanie nowego
if (isset($_POST['admin_register'])) {
    // wszystkie wpisane wartosci escape'owane dla bezpieczeństwa
    $login = esc($_POST['login']);
    $email = esc($_POST['email']);
    $password_1 = esc($_POST['password_1']);
    $password_2 = esc($_POST['password_2']);
    $role = $_POST['role'];

    // walidacja formularza
    if (empty($login)) { array_push($regerrors, "Nie podano loginu"); }
    if (empty($email)) { array_push($regerrors, "Nie podano emaila"); }
    if (empty($password_1)) { array_push($regerrors, "Nie podano hasła"); }
    if ($password_1 != $password_2) { array_push($regerrors, "Hasła do siebie nie pasują");}
    if (!in_array($role, getAllRoles() )) { array_push($regerrors, "Rola nie istnieje");}

    // czy nie był już zarejestrowany
    $sql = "SELECT * FROM users WHERE username='$login' OR email='$email'";

    $result = mysqli_query($conn, $sql);
    $registeredBefore = mysqli_fetch_assoc($result);

    if ($registeredBefore) {
        if ($registeredBefore['username'] === $login) {
          array_push($regerrors, "Login jest zajęty");
        }
        if ($registeredBefore['email'] === $email) {
          array_push($regerrors, "Email jest zajęty");
        }
    }
    
    //faktyczna rejestracja
    if (count($regerrors) == 0) {
        $password = password_hash($password_1, PASSWORD_DEFAULT);  //szyfrowanie hasla
        $query = "INSERT INTO users (username, email, role, password, created_at, updated_at) 
                  VALUES('$login', '$email', '$role', '$password', now(), now())";
        mysqli_query($conn, $query);

        header('location: panel.php?akcja=users&add=1');
        exit(0);
    }
}
//escape
//weź wszystkich użytkowników do tablicy asocjacyjnej
function getAllUsers() {
	global $conn;
	$sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $users;
}
//weź liczbe użytkowników
function getNumberofUsers() {
	global $conn;
	$sql = "SELECT COUNT(*) FROM users";
    $result = mysqli_query($conn, $sql);
    
    $query = mysqli_fetch_all($result, MYSQLI_NUM);
    $number = intval($query[0][0]);
	return $number;
}
//weż wszystkie role do tablicy
function getAllRoles() {
    global $conn;
    $roles = Array();
	$sql = "SELECT DISTINCT role FROM users";
    $result = mysqli_query($conn, $sql);
    
    while($query = $result->fetch_assoc()){
        $roles[] = $query['role'];
    }
    return $roles;
}
