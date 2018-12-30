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
//zwraca tablicę asoc. z id tematu, nazwą tematu, slugiem tematu dla posta
function getPostTopic($post_id){
	global $conn;
	$sql = "SELECT * FROM topics WHERE id=
			(SELECT topic_id FROM post_topic WHERE post_id=$post_id)";
	$result = mysqli_query($conn, $sql);
    $topic = mysqli_fetch_assoc($result);
	return $topic;
}

/* * * * * * * * * * * * * * * *
* @param:  slug tematu
* @return: tablica asoc. z wszystkim postami pod tematem
* * * * * * * * * * * * * * * * */
function getPublicPostsFromTopicSlug($topic_slug) {
	global $conn;
	$sql = "SELECT * FROM posts p WHERE p.id IN
                (
                SELECT pt.post_id FROM post_topic pt WHERE pt.topic_id IN
                    (
                    SELECT t.id FROM topics t WHERE t.slug ='$topic_slug'
                    )
                GROUP BY pt.post_id
                ) AND p.published = 1";
	$result = mysqli_query($conn, $sql);
    
    //wrzuc posty do tablicy asoc.
	$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //dodaj pole z nazwą tematu
	$final_posts = array();
	foreach ($posts as $post) {
		$post['topic'] = getPostTopic($post['id']); 
		array_push($final_posts, $post);
	}
	return $final_posts;
}
/* * * * * * * * * * * * * * * *
* @param: slug tematu
* @return: nazwa tematu
* * * * * * * * * * * * * * * * */
function getTopicNameBySlug($topic_slug)
{
	global $conn;
	$sql = "SELECT name FROM topics WHERE slug='$topic_slug'";
	$result = mysqli_query($conn, $sql);
	$topic = mysqli_fetch_assoc($result);
	return $topic['name'];
}
/* * * * * * * * * * * * * * * *
* @param: brak
* @return: tablica asoc. z tematami
* * * * * * * * * * * * * * * * */
function getAllTopics() {
	global $conn;
	$sql = "SELECT * FROM topics";
    $result = mysqli_query($conn, $sql);
    
    $topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $topics;
}
/* * * * * * * * * * * * * * * *
* @param: slug posta
* @return: tablica asoc. z danymi posta
* * * * * * * * * * * * * * * * */
function getPost($slug){
	global $conn;
	
	$sql = "SELECT * FROM posts WHERE slug='$slug'";
	$result = mysqli_query($conn, $sql);

	$post = mysqli_fetch_assoc($result);
	if ($post) {
		$post['topic'] = getPostTopic($post['id']);
	}
	return $post;
}
/* * * * * * * * * * * * * * *
* Komentarze
* * * * * * * * * * * * * * */
function getCommentsForPost($post_id) {
	global $conn;
	$sql = "SELECT * FROM comments WHERE post_id=$post_id";
	$result = mysqli_query($conn, $sql);
	$comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $comments;
}
function deleteComment($comment_id){
	global $conn;
    $sql = "DELETE FROM comments WHERE id=$comment_id";
    mysqli_query($conn, $sql);
	header('location: post.php?post-slug='.$_GET['post-slug']);
}
?>