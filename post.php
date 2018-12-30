<?php require_once('config.php') ?>
<?php require_once( ROOT_PATH . '/includes/auth.php') ?>
<?php require_once( ROOT_PATH . '/includes/general_functions.php') ?>
<?php 
	if (isset($_GET['post-slug'])) {
		$post = getPost($_GET['post-slug']);
		$comments = getCommentsForPost($post['id']);
		$_SESSION['post'] = $post;
	}
	if (isset($_SESSION['user'])) $userRole = $_SESSION['user']['role'];
	else $userRole = 'Anon';
	if (isset($_GET['delete-comment']) && $userRole == 'Admin') {
		deleteComment($_GET['delete-comment']);
	}
?>

<!-- layout -->
<?php require_once(ROOT_PATH . '/includes/header.php') ?>
	<title>
        <?php isset($_GET['post-slug']) ? print($post['title']) : print("Nie określono posta"); ?>
    </title>
</head>

<body>
	<div class="wrapper">
		<!-- logo oraz navbar -->
		<?php include(ROOT_PATH . '/includes/navbar.php') ?>
		<!-- login/rejestracja -->
		<?php include(ROOT_PATH . '/includes/login.php') ?>
		<!-- newsmob -->
		<?php include(ROOT_PATH . '/includes/newsmob.php') ?>
		<div id="mainwrapper"> 	  
			<div id="main">
				<div id="post">
					<?php if (isset($_GET['post-slug'])): ?>
						<?php if ($post['published'] == false && $userRole != 'Admin'): ?>
							<h2>Ten post nie został jeszcze opublikowany!</h2>
						<?php else: ?>
							<h1><?php echo $post['title']; ?></h1>
							<?php echo html_entity_decode($post['body']); ?>
						<?php endif ?>
					<?php else: ?>
						<h1>Błąd - nie wybrano żadnego posta, wróć do listy postów!</h1>
					<?php endif ?>
				</div>
				<div id="comments">
					<hr>
					<h2>Komentarze:</h2>
					<?php if ($comments == null) : ?>
						<h3>Brak komentarzy</h3>
					<?php else: ?>
						<?php foreach ($comments as $comment): ?>
							<div class="comment">
								<div class="commentAuthorWrap">
									<span class="commentAuthor"><?php echo $comment['author'] ?></span>
									<span class="commentAuthorDivider">|</span>
									<span class="commentDate">Napisany o <?php echo date('H:i j.m.y', strtotime($comment["created_on"])); ?></span>
									<span class="deleteComment">
										<?php if($userRole == 'Admin') { ?> 
											<a href="post.php?post-slug=<?php echo $post['slug']?>&delete-comment=<?php echo $comment['id']?>">X</a>
										<?php } ?>
									</span>
								</div>
								<div class="commentBody">
									<p><?php echo $comment['body'] ?></p>
								</div>
							</div>
						<?php endforeach ?>
					<?php endif ?>
					<div id="addComment">
						<?php if ($userRole == 'Anon') : ?>
							<h3>Tylko zalogowani użytkownicy mogą dodawać komentarze.</h3>
						<?php else : ?>
							<h3>Dodaj komentarz jako <?php echo $_SESSION['user']['username'] ?></h3>
							<form class="reg" method="post" action="" >
								<!-- pola do wypełnienia -->
								<textarea name="commentbody" id="commentbody" cols="30" rows="10" required></textarea>
								<button type="submit" class="" name="post_comment">Dodaj</button>
							</form>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
		<!-- lewy i prawy sidebar -->
		<?php include(ROOT_PATH . '/includes/sidebars.php') ?>
	</div>
	<!-- rightmob -->
	<?php include(ROOT_PATH . '/includes/rightmob.php') ?>
	<!-- stopka -->
	<?php include(ROOT_PATH . '/includes/footer.php') ?>