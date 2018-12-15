<!-- przygotowanie, konfiguracja -->
<?php require_once( '../config.php') ?>
<?php require_once( ROOT_PATH . '/admin/includes/admin_functions.php') ?>

<!-- layout -->
<?php require_once(ROOT_PATH . '/includes/header.php') ?>
	<title>Panel administracyjny</title>
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
                <div class="newsitem">
                    <!-- Tytuł -->
                    <a href="panel.php?akcja=users">
                        <h1>Zarządzanie użytkownikami</h1>
                    </a>
                    <!-- Krótki opis i link -->
                    <p>Ileś tam zarejestrowanych użytkowników</p>
                </div>
                <div class="newsitem">
                    <!-- Tytuł -->
                    <a href="panel.php?akcja=posts">
                        <h1>Zarządzanie postami</h1>
                    </a>
                    <!-- Krótki opis i link -->
                    <p>Ileś tam napisanych postów</p>
                </div>
                <div class="newsitem">
                    <!-- Tytuł -->
                    <a href="panel.php?akcja=comments">
                        <h1>Zarządzanie komentarzami</h1>
                    </a>
                    <!-- Krótki opis i link -->
                    <p>Ileś tam napisanych komentarzy</p>
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