		<div id="psu">
            <form action="index.php" method="post" >
                <ul class="menu">
                    <li class="element"><a href="register.php">Zarejestruj się!</a></li>
                    <li class="separator"><img src="static/media/menu_oddzielacz2.gif" alt="::"></li>
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
                </ul>
            </form>
		</div>