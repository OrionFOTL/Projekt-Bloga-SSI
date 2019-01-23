<?php require_once('config.php') ?>
<?php require_once( ROOT_PATH . '/includes/general_functions.php') ?>
<?php require_once( ROOT_PATH . '/includes/auth.php') ?>

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
				<h1>Hardware Blog</h1>
				<p>Strona gdzie publikujemy informacje na temat sprzętu komputerowego, recenzje, oraz przecieki z branży.</p>
			</div>
		</div>
		<!-- lewy i prawy sidebar -->
		<?php include(ROOT_PATH . '/includes/sidebars.php') ?>
	</div>
	<!-- rightmob -->
	<?php include(ROOT_PATH . '/includes/rightmob.php') ?>
	<!-- stopka -->
	<?php include(ROOT_PATH . '/includes/footer.php') ?>