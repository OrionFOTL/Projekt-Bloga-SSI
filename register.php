<?php require_once('config.php') ?>
<?php require_once( ROOT_PATH . '/includes/auth.php') ?>

<!-- layout -->
<?php require_once(ROOT_PATH . '/includes/header.php') ?>
	<title>Rejestracja</title>
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
                <form class="reg" method="post" action="register.php" >
                    <h1>Rejestracja</h1>
                    <!-- miejsce na błędy -->
                    <?php if (count($regerrors) > 0) : ?>
                        <h2>Błąd rejestracji!</h2>
                        <?php foreach ($regerrors as $error) : ?>
                            <p><?php echo $error ?></p>
                        <?php endforeach ?>
                    <?php endif ?>
                    <!-- pola do wypełnienia -->
                    <input type="text" name="login" value="<?php echo $login; ?>" placeholder="Login" required>
                    <input type="email" name="email" value="<?php echo $email ?>" placeholder="Email" required>
                    <input type="password" name="password_1" placeholder="Hasło" required>
                    <input type="password" name="password_2" placeholder="Powtórz hasło" required>
					<?php generateCaptcha(); ?>
                    <button type="submit" class="" name="register">Zarejestruj</button>
                </form>
			</div>
		</div>
		<!-- lewy i prawy sidebar -->
		<?php include(ROOT_PATH . '/includes/sidebars.php') ?>
	</div>
	<!-- rightmob -->
	<?php include(ROOT_PATH . '/includes/rightmob.php') ?>
	<!-- stopka -->
	<?php include(ROOT_PATH . '/includes/footer.php') ?>