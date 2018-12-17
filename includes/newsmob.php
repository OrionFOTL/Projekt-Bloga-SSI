<?php require_once( ROOT_PATH . '/includes/general_functions.php') ?>
<?php $posts = getPublishedPosts(); ?>
<div id="newsmob">
				<h1>Najnowsze artykuły</h1>
				<ul>
					<?php foreach ($posts as $post): ?>
						<li><a href="post.php?post-slug=<?php echo $post['slug']; ?>"><?php echo $post['title']; ?></a></li>
						<li class="separator"><img src="static/media/menu_oddzielacz2.gif" alt="::" /></li>
					<?php endforeach ?>
				</ul>
		</div>	 	