<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php bornholm_the_post_header( 'h1', $post ); ?>
	</header>
	<!-- .entry-header -->
	<div class="entry-content">
		<?php bornholm_the_content(); ?>
	</div>
	<!-- .entry-content -->
	<footer class="entry-meta">
		<?php bornholm_footer_meta() ?>
	</footer>
	<!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->