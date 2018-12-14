<?php 
/* * * * * * * * * * * * * * *
* Zwroc wszystkie opublikowane posty
* * * * * * * * * * * * * * */
function getPublishedPosts() {
	global $conn;
	$sql = "SELECT * FROM posts WHERE published=true ORDER BY created_at desc";
	$result = mysqli_query($conn, $sql);

    //$posts = tablica asocjacyjna
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //dodaj do tablicy $posts nazwę tematu
    $final_posts = array();
	foreach ($posts as $post) {
		$post['topic'] = getPostTopic($post['id']); 
		array_push($final_posts, $post);
    }
	return $final_posts;
}
function getPostTopic($post_id){
	global $conn;
	$sql = "SELECT * FROM topics WHERE id=
			(SELECT topic_id FROM post_topic WHERE post_id=$post_id)";
	$result = mysqli_query($conn, $sql);
    $topic = mysqli_fetch_assoc($result);
	return $topic;
}
?>