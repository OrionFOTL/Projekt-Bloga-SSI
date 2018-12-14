<!-- przygotowanie, konfiguracja -->
<?php require_once('config.php') ?>
<?php require_once( ROOT_PATH . '/includes/general_functions.php') ?>
<?php $posts = getPublishedPosts(); ?>

<!-- layout -->
<?php require_once(ROOT_PATH . '/includes/header.php') ?>
	<title>Blog o sprzęcie</title>
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
				<?php foreach ($posts as $post): ?>
					<div class="newsitem">
						<!-- obrazek tematu -->
						<a href="tematy.php?topic=<?php echo $post['topic']['slug']; ?>">
							<span class="obrazek poprawej"><img src="<?php echo BASE_URL . 'static/media/' . $post['topic']['slug']; ?>" alt="IMG" /></span>
						</a>
						<!-- Tytuł -->
						<a href="post.php?post-slug=<?php echo $post['slug']; ?>">
							<h1><?php echo $post['title'] ?></h1>
						</a>
						<!-- Krótki opis i link -->
						<p>
							<?php echo $post['short'] ?>
							<a href="post.php?post-slug=<?php echo $post['slug']; ?>">Czytaj dalej...</a>
						</p>
						<div class="newsfooter"><p>Napisany <?php echo date('j.m.y', strtotime($post["created_at"])); ?></p></div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
		<!-- lewy i prawy sidebar -->
		<?php include(ROOT_PATH . '/includes/sidebars.php') ?>
	</div>
	<!-- rightmob -->
	<?php include(ROOT_PATH . '/includes/rightmob.php') ?>
	<!-- stopka -->
	<?php include(ROOT_PATH . '/includes/footer.php') ?>