<?php require_once( '../config.php') ?>
<?php require_once( ROOT_PATH . '/includes/auth.php') ?>
<?php require_once( ROOT_PATH . '/includes/general_functions.php') ?>
<?php require_once( ROOT_PATH . '/admin/includes/admin_functions.php') ?>
<?php 
    if($_SESSION['user']['role'] != 'Admin') header('location: ' . BASE_URL . 'index.php');
    if (isset($_GET['deletePost'])) deletePost($_GET['deletePost']);
    if (isset($_GET['deleteUser'])) deleteUser($_GET['deleteUser']);
?>
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
                <!-- Uzytkownicy -->
                <div class="newsitem">
                    <a href="panel.php?akcja=users">
                        <h1>Zarządzanie użytkownikami</h1>
                    </a>
                    <p><?php echo getNumberofUsers() ?> zarejestrowanych użytkowników</p>
                </div>
                <?php if (isset($_GET['akcja'])): ?>
                    <?php if ($_GET['akcja'] == "users") include('includes/users.php') ?>
                <?php endif ?>
                <!-- Posty -->
                <div class="newsitem">
                    <a href="panel.php?akcja=posts">
                        <h1>Zarządzanie postami</h1>
                    </a>
                    <p><?php echo getNumberofPosts() ?> napisanych postów</p>
                </div>
                <?php if (isset($_GET['akcja'])): ?>
                    <?php if ($_GET['akcja'] == "posts") include('includes/posts.php') ?>
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