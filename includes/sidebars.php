<?php $posts = getPublishedPosts(); ?>
<div id="left">
			<h1>Najnowsze artykuły</h1>
			<ul>
				<?php foreach ($posts as $post): ?>
				<li><a href="<?php echo BASE_URL . 'post.php?post-slug=' . $post['slug'] ?>"><?php echo $post['title']; ?></a></li>
				<?php endforeach ?>
			</ul>
		</div>	    
		<div id="right">
			<h1>Zobacz też:</h1>
				<ul>
					<li><a href="http://www.techpowerup.com/"><img src="<?php echo BASE_URL . 'static/media/logo/tpu.png' ?>" alt="TechPowerUP" /></a></li>
					<li><a href="http://www.jonnyguru.com/"><img src="<?php echo BASE_URL . 'static/media/logo/jonnyguru.png' ?>" alt="Jonnyguru" /></a></li>
					<li><a href="http://www.computerbase.de/"><img src="<?php echo BASE_URL . 'static/media/logo/computerbase.png' ?>" alt="Computerbase" /></a></li>
					<li><a href="http://www.pcper.com/"><img src="<?php echo BASE_URL . 'static/media/logo/pcper.png' ?>" alt="PCPerspective" /></a></li>
					<li><a href="http://www.kitguru.net/"><img src="<?php echo BASE_URL . 'static/media/logo/kitguru.png' ?>" alt="KitGuru" /></a></li>
				</ul>
		</div> 