<!-- przygotowanie, konfiguracja -->
<?php require_once('config.php') ?>
<?php require_once( ROOT_PATH . '/includes/general_functions.php') ?>
<?php 
	if (isset($_GET['post-slug'])) {
		$post = getPost($_GET['post-slug']);
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
                <?php if (isset($_GET['post-slug'])): ?>
                    <?php if ($post['published'] == false): ?>
				        <h2>Ten post nie został jeszcze opublikowany!</h2>
			        <?php else: ?>
                        <h1><?php echo $post['title']; ?></h1>
                        <?php echo html_entity_decode($post['body']); ?>
			         <?php endif ?>
                <?php else: ?>
                    <h1>Błąd - nie wybrano żadnego posta, wróć do listy postów!</h1>
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