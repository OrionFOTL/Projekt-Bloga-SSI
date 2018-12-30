<?php
    $posts = getAllPosts();
    $topics = getAllTopics();
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.8.0/ckeditor.js"></script>

<div>
    <h3>Napisane posty:</h3>
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
                <th>Tytuł</th>
                <th>Slug</th>
                <th>Short</th>
                <th>Opub.</th>
                <th>Utworzony</th>
                <th colspan=2>Akcje</th>
            </tr>
            <?php foreach ($posts as $index => $post): ?>
                <tr>
                    <td><?php echo $index+1 ?></td>
                    <td><?php echo $post['title'] ?></td>
                    <td>
                        <a href="<?php echo BASE_URL . 'post.php?post-slug=' . $post['slug'] ?>">
                            <?php echo $post['slug'] ?>
                        </a>
                    </td>
                    <td><?php echo $post['short'] ?></td>
                    <td><?php if($post['published']) echo '✓'; else echo '✗' ?></td>
                    <td><?php echo $post['created_at'] ?></td>
                    <td><a class="edit action" href="panel.php?akcja=posts&edit=<?php echo $post['id'] ?>">Edytuj</a></td>
                    <td><a class="delete action" href="panel.php?akcja=posts&delete=<?php echo $post['id'] ?>">Usuń</a></td>
                </tr>
            <?php endforeach ?>
                <tr>
                    <td colspan=8><a class="add action" href="panel.php?akcja=posts&add=1">Napisz</a>
                </tr>
        </tbody>
    </table>

    <!-- dodawanie -->
    <?php if (isset($_GET['add'])): ?>
        <form class="reg" method="post" action="panel.php?akcja=posts&add=1" >
            <h3>Napisz artykuł</h3>
            <!-- Miejsce na błędy -->
            <?php if (count($posterrors) > 0) : ?>
                <h2>Błąd dodawania!</h2>
                <?php foreach ($posterrors as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach ?>
            <?php endif ?>
            <!-- pola do wypełnienia -->
            <input type="text" name="title" placeholder="Tytuł" required>
            <input type="text" name="slug" placeholder="slug-posta" required>
            <input type="short" name="short" placeholder="Krótki opis" required>
            <textarea name="postbody" id="postbody" cols="30" rows="10" required></textarea>
            <select name="topic" required>
                <option value="null" selected disabled>Wybierz temat</option>
                <?php foreach ($topics as $topic): ?>
                    <option value="<?php echo $topic['id']; ?>"><?php echo $topic['name']; ?></option>
                <?php endforeach ?>
            </select>
            <input type="checkbox" name="published" value="1" checked>Opublikowany?<br/>
            <button type="submit" class="" name="add_post">Zapisz</button>
        </form>

    <!-- edytowanie -->
    <?php elseif (isset($_GET['edit'])): ?>
    <?php $post=getEditedPost($_GET['edit']); ?>
    <form class="reg" method="post" action="panel.php?akcja=posts&edit=<?php echo $post['id'] ?>">
        <h3>Edytuj post <?php echo $post['title'] ?></h3>
        <!-- Miejsce na błędy -->
        <?php if (count($posterrors) > 0) : ?>
            <h2>Błąd edytowania!</h2>
            <?php foreach ($posterrors as $error) : ?>
                <p><?php echo $error ?></p>
            <?php endforeach ?>
        <?php endif ?>
        <!-- pola do wypełnienia -->
        <input type="hidden" name="id" value="<?php echo $post['id'] ?>">
        <input type="text" name="title" placeholder="Tytuł" required value="<?php echo $post['title'] ?>">
        <input type="text" name="slug" placeholder="slug-posta" required value="<?php echo $post['slug'] ?>">
        <input type="short" name="short" placeholder="Krótki opis" required value="<?php echo $post['short'] ?>">
        <textarea name="postbody" id="postbody" cols="30" rows="10" required><?php echo $post['body'] ?></textarea>
        <select name="topic" required>
            <option value="null" selected disabled>Wybierz temat</option>
            <?php foreach ($topics as $topic): ?>
                <option value="<?php echo $topic['id']; ?>"><?php echo $topic['name']; ?></option>
            <?php endforeach ?>
        </select>
        <input type="checkbox" name="published" value="1" checked>Opublikowany?<br/>
        <button type="submit" class="" name="edit_post">Zapisz</button>
    </form>
    <?php endif ?>
</div>
<script>
	CKEDITOR.replace('postbody');
</script>