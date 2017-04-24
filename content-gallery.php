<?php
/**
 * Template part for displaying content of galleries.
 *
 * @package Bornholm
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header clearfix">
		<?php
		$images = bornholm_get_gallery_images( $post->ID );
		bornholm_gallery_header( 'h1', $images, 'bornholm_large_gallery_image_for_blog_view', $post );
		?>
	</header>
	<?php
	$number_of_small_images = get_theme_mod( 'number_of_small_images_from_gallery_in_blog_view', 2 );
	if ( $number_of_small_images > 0 ) {
		bornholm_small_gallery_thumbnails( 'thumbnail', $images, $number_of_small_images );
	}
	?>
	<div class="entry-content">
		<?php bornholm_gallery_image_number( $images ); ?>
	</div>
	<footer class="entry-meta">
		<?php bornholm_footer_meta() ?>
	</footer>
</article><!-- #post-<?php the_ID(); ?> -->
