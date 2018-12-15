		<div id="psu">
            <form action="<?php echo BASE_URL . 'index.php' ?>" method="post" >
                <ul class="menu">
                    <?php if (isset($_SESSION['user']['username'])): ?>
                        <li class="element">Witaj <?php echo $_SESSION['user']['username'] ?>!</li>
                        <li class="separator"><img src="<?php echo BASE_URL . 'static/media/menu_oddzielacz2.gif' ?>" alt="::"></li>
                        <?php if ($_SESSION['user']['role'] == 'Admin'): ?>
                            <li class="element"><a href="<?php echo BASE_URL . 'admin/panel.php' ?>">Panel administracyjny</a></li>
                            <li class="separator"><img src="<?php echo BASE_URL . 'static/media/menu_oddzielacz2.gif' ?>" alt="::"></li>
                        <?php endif ?>
                        <li class="element"><a href="<?php echo BASE_URL . 'logout.php' ?>">Wyloguj</a></li>
                    <?php else: ?>
                        <li class="element"><a href="<?php echo BASE_URL . 'register.php' ?>">Zarejestruj się!</a></li>
                        <li class="separator"><img src="<?php echo BASE_URL . 'static/media/menu_oddzielacz2.gif' ?>" alt="::"></li>
                        <li class="">Login:</li>
                        <li class=""><input type="text" name="login" placeholder=""></li>
                        <li class="">Hasło:</li>
                        <li class=""><input type="password" name="password" placeholder="***"></li>
                        <li class=""><button class="btn" type="submit" name="login_button">Zaloguj</button></li>
                        <?php if (count($logerrors) > 0) : ?>
                            <?php foreach ($logerrors as $error) : ?>
                                <li class="error"><?php echo $error ?></li>
                            <?php endforeach ?>
                        <?php endif ?>
                    <?php endif ?>
                </ul>
            </form>
		</div>