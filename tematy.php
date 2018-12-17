<!-- przygotowanie, konfiguracja -->
<?php require_once('config.php') ?>
<?php require_once( ROOT_PATH . '/includes/general_functions.php') ?>
<?php require_once( ROOT_PATH . '/includes/auth.php') ?>
<?php 
	if (isset($_GET['topic'])) {
		$topic_slug = $_GET['topic'];
		$posts = getPublicPostsFromTopicSlug($topic_slug);
	}
	else $topics = getAllTopics();
?>

<!-- layout -->
<?php require_once(ROOT_PATH . '/includes/header.php') ?>
	<title>Posty typu <?php echo getTopicNameBySlug($topic_slug); ?></title>
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
				<?php if (isset($_GET['topic'])): ?>
					<h1>Wszystkie posty typu <?php echo getTopicNameBySlug($topic_slug); ?></h1>
					<?php foreach ($posts as $post): ?>
						<div class="newsitem">
							<!-- obrazek tematu -->
							<a href="tematy.php?topic=<?php echo $post['topic']['slug']; ?>">
								<span class="obrazek poprawej"><img src="<?php echo BASE_URL . 'static/media/' . $post['topic']['slug']. '.png'; ?>" alt="IMG" /></span>
							</a>
							<!-- Tytuł -->
							<a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
								<h1><?php echo $post['title'] ?></h1>
							</a>
							<!-- Krótki opis i link -->
							<p>
								<?php echo $post['short'] ?>
								<a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">Czytaj dalej...</a>
							</p>
							<div class="newsfooter"><p>Napisany <?php echo date('j.m.y', strtotime($post["created_at"])); ?></p></div>
						</div>
					<?php endforeach ?>
				<?php else: ?>
					<h1>Lista kategorii postów:</h1>
					<?php foreach ($topics as $topic): ?>
						<div class="newsitem">
							<a href="tematy.php?topic=<?php echo $topic['slug']; ?>">
								<span class="obrazek poprawej"><img src="<?php echo BASE_URL . 'static/media/' . $topic['slug']. '.png'; ?>" alt="IMG" /></span>
							</a>
							<!-- Tytuł kategorii -->
							<a href="tematy.php?topic=<?php echo $topic['slug']; ?>">
								<h1><?php echo $topic['name'] ?></h1>
							</a>
							<!-- Opis kategorii -->
							<p><?php echo $topic['description'] ?>
						</div>
					<?php endforeach ?>

				<?php endif ?>
			</div>
		</div>
		<!-- lewy i prawy sidebar -->
		<?php include(ROOT_PATH . '/includes/sidebars.php') ?>
	</div>
	<!-- rightmob -->
	<?php include(ROOT_PATH . '/includes/rightmob.php') ?>
	<!-- stopka -->
	<?php include(ROOT_PATH . '/includes/footer.php') ?>