<?php
/**
 * Template Name: Alternative front page
 * Description: A Page Template for the alternative front page. It displays a brief overview of the portfolio.
 */
get_header(); ?>
	<main role="main">
		<?php
		$args                          = array(
			'orderby' => 'name',
			'parent'  => 0
		);
		$show_child_category_hierarchy = true;
		$categories                    = get_categories( $args );
		$exclude_id                    = "";
		$number_of_galleries           = 3;
		foreach ( $categories as $cat ) {
			$title = $cat->name;
			bornholm_get_galleries_from_category( $cat, $exclude_id, $number_of_galleries, 'h2', $title, $show_child_category_hierarchy );
		} ?>
	</main>
<?php get_footer();