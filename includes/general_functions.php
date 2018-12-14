<?php 
/* * * * * * * * * * * * * * *
* Zwroc wszystkie opublikowane posty
* * * * * * * * * * * * * * */
function getPublishedPosts() {
	global $conn;
	$sql = "SELECT * FROM posts WHERE published=true";
	$result = mysqli_query($conn, $sql);

    //$posts = tablica asocjacyjna
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //var_dump($posts);
	return $posts;
}

?>