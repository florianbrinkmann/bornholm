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
		/**
		 * Get theme mod which stores if the posts should be displayed
		 * hierarchical or not.
		 */
		$galleries_on_alternative_front_page = get_theme_mod( 'hierarchy_of_gallery_on_alternative_front_page' );

		/**
		 * Display galleries without hierarchy if false
		 */
		if ( $galleries_on_alternative_front_page === false ) {
			/**
			 * Create args array for get_categories()
			 */
			$args = array(
				'orderby' => 'name',
			);

			/**
			 * Variable to let the loop know that we do not want
			 * a hierarchical view.
			 */
			$show_child_category_hierarchy = false;
		} else {
			/**
			 * Create args array for get_categories()
			 */
			$args = array(
				'orderby' => 'name',
				'parent'  => 0
			);

			/**
			 * Variable to let the loop know that we want
			 * a hierarchical view.
			 */
			$show_child_category_hierarchy = true;
		}

		/**
		 * Get the categories.
		 */
		$categories = get_categories( $args );

		/**
		 * Empty string for category ids that should be excluded
		 */
		$exclude_id = "";

		/**
		 * Get the number of galleries before the view all link is displayed.
		 */
		$number_of_galleries = get_theme_mod( 'number_of_galleries_on_alternative_front_page', 3 );

		/**
		 * Loop through the categories.
		 */
		foreach ( $categories as $cat ) {
			/**
			 * Save the category name so we can display it later as the title.
			 */
			$title = $cat->name;

			/**
			 * Call the function that displays the galleries.
			 */
			bornholm_get_galleries_from_category( $cat, $exclude_id, $number_of_galleries, 'h2', $title, $show_child_category_hierarchy );
		} ?>
	</main>
<?php get_footer();
