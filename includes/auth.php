<?php 
	$login = "";
	$email    = "";
    $regerrors = array(); 
    $logerrors = array();

    /* * * * * * * * * * * * * * * *
    * Rejestracja
    * * * * * * * * * * * * * * * * */
	if (isset($_POST['register'])) {

		// wszystkie wpisane wartosci escape'owane dla bezpieczeństwa
		$login = esc($_POST['login']);
		$email = esc($_POST['email']);
		$password_1 = esc($_POST['password_1']);
		$password_2 = esc($_POST['password_2']);

		// walidacja formularza
		if (empty($login)) { array_push($regerrors, "Nie podano loginu"); }
		if (empty($email)) { array_push($regerrors, "Nie podano emaila"); }
		if (empty($password_1)) { array_push($regerrors, "Nie podano hasła"); }
		if ($password_1 != $password_2) { array_push($regerrors, "Hasła do siebie nie pasują");}

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
					  VALUES('$login', '$email', 'User', '$password', now(), now())";
			mysqli_query($conn, $query);

            //zaloguj od razu
			$reg_user_id = mysqli_insert_id($conn); 
			$_SESSION['user'] = getUserById($reg_user_id);

			// przejdz do panelu admina jesli jest adminem
			if ( in_array($_SESSION['user']['role'], ["Admin", "Autor"])) {
				$_SESSION['message'] = "Zalogowano";
				header('location: ' . BASE_URL . 'admin/panel.php');
				exit(0);
			} else {
				$_SESSION['message'] = "Zalogowano";
				header('location: ' . BASE_URL . 'index.php');				
				exit(0);
			}
		}
	}

    /* * * * * * * * * * * * * * * *
    * Logowanie
    * * * * * * * * * * * * * * * * */
	if (isset($_POST['login_button'])) {
		$login = esc($_POST['login']);
		$password = esc($_POST['password']);
		if (empty($login)) { array_push($logerrors, "Pusty login!"); }
		if (empty($password)) { array_push($logerrors, "Puste hasło!"); }
		if (empty($logerrors)) {

            //wybranie tablicy z userem odpowiadajacym loginowi
            $sql = "SELECT * FROM users WHERE username='$login'";
            $query = mysqli_query($conn, $sql);
            $user = mysqli_fetch_assoc($query);
            
            //sprawdzenie czy haslo w formularzu logowania zgadza sie z hashem usera
            $valid = password_verify($password, $user['password']);

            if ($valid) {
                //logowanie do sesji
				$_SESSION['user'] = $user; 

				// przejdz do panelu jesli to admin
				if ( in_array($_SESSION['user']['role'], ["Admin", "Autor"])) {
					$_SESSION['message'] = "Zalogowano";
					header('location: ' . BASE_URL . 'admin/panel.php');
					exit(0);
				} else {
					$_SESSION['message'] = "Zalogowano";
					header('location: ' . BASE_URL . 'index.php');				
					exit(0);
				}
			} else {
				array_push($logerrors, 'Login lub hasło niepoprawne');
			}
		}
	}
	function esc(String $value)
	{	
		global $conn;

		$val = trim($value);
		$val = mysqli_real_escape_string($conn, $value);

		return $val;
	}
	function getUserById($id) {
		global $conn;
		$sql = "SELECT * FROM users WHERE id=$id";
		$result = mysqli_query($conn, $sql);
		$user = mysqli_fetch_assoc($result);
		return $user;
	}
?>