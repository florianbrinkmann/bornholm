<?php
/**
 * Template Name: Alternative front page
 * Description: A Page Template for the alternative front page. It displays a brief overview of the portfolio.
 *
 * @package Bornholm
 */

get_header(); ?>
	<main role="main">
		<?php
		$galleries_on_alternative_front_page = get_theme_mod( 'hierarchy_of_gallery_on_alternative_front_page' );
		if ( $galleries_on_alternative_front_page == 0 ) {
			$args                          = array(
				'orderby' => 'name',
			);
			$show_child_category_hierarchy = false;
		} else {
			$args                          = array(
				'orderby' => 'name',
				'parent'  => 0
			);
			$show_child_category_hierarchy = true;
		}
		$categories          = get_categories( $args );
		$exclude_id          = "";
		$number_of_galleries = get_theme_mod( 'number_of_galleries_on_alternative_front_page', 3 );
		foreach ( $categories as $cat ) {
			$title = $cat->name;
			bornholm_get_galleries_from_category( $cat, $exclude_id, $number_of_galleries, 'h2', $title, $show_child_category_hierarchy );
		} ?>
	</main>
<?php get_footer();
