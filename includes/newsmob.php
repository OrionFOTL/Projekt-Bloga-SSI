<?php require_once( ROOT_PATH . '/includes/general_functions.php') ?>
<?php $sidebarPosts = getPublishedPosts(); ?>
<div id="newsmob">
				<h1>Najnowsze artykuły</h1>
				<ul>
					<?php foreach ($sidebarPosts as $sidebarPost): ?>
						<li><a href="<?php echo BASE_URL . 'post.php?post-slug=' . $sidebarPost['slug'] ?>"><?php echo $sidebarPost['title']; ?></a></li>
						<li class="separator"><img src="<?php echo BASE_URL . 'static/media/menu_oddzielacz2.gif'?>" alt="::" /></li>
					<?php endforeach ?>
				</ul>
		</div>	 	