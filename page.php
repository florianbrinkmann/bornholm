<?php get_header(); ?>
	<main role="main">
		<?php
		while ( have_posts() ) {
			the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<?php bornholm_the_post_header( 'h1', $post ) ?>
				</header>
				<div class="entry-content">
					<?php the_content();
					bornholm_paginated_posts_navigation(); ?>
				</div>
			</article><!-- #post-<?php the_ID(); ?> -->
		<?php } ?>
	</main>
<?php get_sidebar();
get_footer();