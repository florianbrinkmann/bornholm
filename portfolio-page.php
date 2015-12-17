<?php
/**
 * Template Name: Portfolio page
 * Description: Displays all galleries.
 */
get_header(); ?>
	<main role="main">
		<?php
		$args = array(
			'posts_per_page' => '-1',
			'tax_query'      => array(
				array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => 'post-format-gallery'
				)
			)
		);

		$galleries = get_posts( $args );
		if ( $galleries ) {
			bornholm_loop_galleries_from_category( $galleries, '', '', '', '' );
		}
		?>
	</main>
<?php get_footer();