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
//Edycja użytkownika
if (isset($_POST['admin_edit'])) {
    // wszystkie wpisane wartosci escape'owane dla bezpieczeństwa
    $login = esc($_POST['login']);
    $email = esc($_POST['email']);
    $password_1 = esc($_POST['password_1']);
    $password_2 = esc($_POST['password_2']);
    $role = $_POST['role'];
    $id = $_GET['edit'];

    // walidacja formularza
    if (empty($login)) { array_push($regerrors, "Nie podano loginu"); }
    if (empty($email)) { array_push($regerrors, "Nie podano emaila"); }
    if (empty($password_1)) { array_push($regerrors, "Nie podano hasła"); }
    if ($password_1 != $password_2) { array_push($regerrors, "Hasła do siebie nie pasują");}
    if (!in_array($role, getAllRoles() )) { array_push($regerrors, "Rola nie istnieje");}

    //faktyczna rejestracja
    if (count($regerrors) == 0) {
        $password = password_hash($password_1, PASSWORD_DEFAULT);  //szyfrowanie hasla
        $query = "UPDATE users SET username='$login', email='$email', password='$password',
                  role='$role', updated_at=now() WHERE id=$id";
        mysqli_query($conn, $query);

        header('location: panel.php?akcja=users&edit=' . $id);
        exit(0);
    }
}
 //Usuwanie użytkownika
function deleteUser($id) {
	global $conn;
    $sql = "DELETE FROM users WHERE id=$id";
    mysqli_query($conn, $sql);
    header('location: panel.php?akcja=users');
    exit(0);
}

//weź wszystkich użytkowników do tablicy asocjacyjnej
function getAllUsers() {
	global $conn;
	$sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $users;
}
// weź edytowanego użytkownika
function getEditedUser($id) {
	global $conn;
	$sql = "SELECT * FROM users WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
	return $user;
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

/**********
 * Zarzadzanie postami
 ***********/

$posterrors = Array();

function getAllPosts() {
	global $conn;
	$sql = "SELECT * FROM posts";
    $result = mysqli_query($conn, $sql);
    
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $posts;
}
function getAllTopics() {
    global $conn;
    $topics = Array();
	$sql = "SELECT * FROM topics";
    $result = mysqli_query($conn, $sql);
    
    $topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $topics;
}
function getTopicIds() {
    global $conn;
    $topic_names = Array();
	$sql = "SELECT id FROM topics";
    $result = mysqli_query($conn, $sql);
    
    while($query = $result->fetch_assoc()){
        $topic_names[] = $query['id'];
    }
    return $topic_names;
}
//weź liczbe postow
function getNumberofPosts() {
	global $conn;
	$sql = "SELECT COUNT(*) FROM posts";
    $result = mysqli_query($conn, $sql);
    
    $query = mysqli_fetch_all($result, MYSQLI_NUM);
    $number = intval($query[0][0]);
	return $number;
}
if (isset($_POST['add_post'])) {
    $title = "";
    $slug = "";
    $short = "";
    $postbody = "";
    $published = 0;

    $title = esc($_POST['title']);
    $slug = esc($_POST['slug']);
    $short = esc($_POST['short']);
    $postbody = esc($_POST['postbody']);
    $topic = esc($_POST['topic']);
    if (isset($_POST['published'])) {
        $published = intval(esc($_POST['published']));
    }

    $editingUserId = intval($_SESSION['user']['id']);

    // walidacja formularza
    if (empty($title)) { array_push($posterrors, "Nie podano tytułu"); }
    if (empty($slug)) { array_push($posterrors, "Nie podano sluga"); }
    if (empty($short)) { array_push($posterrors, "Nie podano krótkiego opisu"); }
    if (empty($postbody)) { array_push($posterrors, "Nie wpisano treści"); }
    if (!in_array($topic, getTopicIds() )) { array_push($posterrors, "Temat nie istnieje");}

    // czy nie był już opublkoiwany
    $sql = "SELECT * FROM topics WHERE slug='$slug'";

    $result = mysqli_query($conn, $sql);
    $postedBefore = mysqli_fetch_assoc($result);

    if ($postedBefore) {
        array_push($posterrors, "Post o takim slugu już istnieje");
    }
    
    //publikowanie do bazy
    if (count($posterrors) == 0) {
        $query = "INSERT INTO posts (user_id, title, slug, short, body, published, created_at, updated_at) 
                  VALUES($editingUserId, '$title', '$slug', '$short', '$postbody', $published, now(), now())";
        mysqli_query($conn, $query);
        $inserted_post_id = mysqli_insert_id($conn);
        $query = "INSERT INTO post_topic (post_id, topic_id) 
                  VALUES($inserted_post_id, $topic)";
        mysqli_query($conn, $query);

        header('location: panel.php?akcja=posts&add=1');
        exit(0);
    }
}