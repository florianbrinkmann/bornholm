<?php
/**
 * Template part for displaying content of normal posts.
 *
 * @package Bornholm
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php bornholm_the_post_header( 'h1', $post ); ?>
	</header>
	<div class="entry-content">
		<?php bornholm_the_content(); ?>
	</div>
	<footer class="entry-meta">
		<?php bornholm_footer_meta() ?>
	</footer>
</article><!-- #post-<?php the_ID(); ?> -->
