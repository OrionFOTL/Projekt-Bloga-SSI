<?php
    $users = getAllUsers();
    $roles = getAllRoles();
?>

<div>
    <h3>Zarejestrowani użytkownicy:</h3>
    <table class="psutable">
        <colgroup>
            <col class="series">
            <col class="platform">
            <col class="platform">
            <col class="platform">
        </colgroup>
        <tbody>
            <tr id="fst">
                <th>N</th>
                <th>Login</th>
                <th>E-mail</th>
                <th>Rola</th>
                <th colspan=2>Akcje</th>
            </tr>
            <?php foreach ($users as $index => $user): ?>
                <tr>
                    <td><?php echo $index+1 ?></td>
                    <td><?php echo $user['username'] ?></td>
                    <td><?php echo $user['email'] ?></td>
                    <td><?php echo $user['role'] ?></td>
                    <td><a class="edit action" href="panel.php?akcja=users&edit=<?php echo $user['id'] ?>">Edytuj</a></td>
                    <td><a class="delete action" href="panel.php?akcja=users&delete=<?php echo $user['id'] ?>">Usuń</a></td>
                </tr>
            <?php endforeach ?>
                <tr>
                    <td colspan=6><a class="add action" href="panel.php?akcja=users&add=1">Dodaj</a>
                </tr>
        </tbody>
    </table>

    <?php if (isset($_GET['add'])): ?>
        <form class="reg" method="post" action="panel.php?akcja=users&add=1" >
            <h3>Dodaj użytkownika</h3>
            <!-- Miejsce na błędy -->
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
            <select name="role">
                <option value="" selected disabled>Wybierz rolę</option>
                <?php foreach ($roles as $role): ?>
                    <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
                <?php endforeach ?>
			</select>
            <button type="submit" class="" name="admin_register">Zarejestruj</button>
        </form>
    <?php elseif (isset($_GET['edit'])): ?>
        <form class="reg" method="post" action="panel.php?akcja=users&add=1" >
            <h3>Dodaj użytkownika</h3>
            <!-- Miejsce na błędy -->
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
            <select name="role">
                <option value="" selected disabled>Wybierz rolę</option>
                <?php foreach ($roles as $role): ?>
                    <option value="<?php echo $role; ?>"><?php echo $role; ?></option>
                <?php endforeach ?>
			</select>
            <button type="submit" class="" name="admin_register">Zarejestruj</button>
        </form>
    <?php endif ?>
</div>