<?php
/**
 * Template for displaying the galleries in a portfolio view.
 *
 * Template Name: Portfolio page
 * Description: Displays all galleries.
 *
 * @package Bornholm
 */

get_header(); ?>
	<main role="main">
		<?php $galleries_on_portfolio_page = get_theme_mod( 'galleries_on_portfolio_page' );
		if ( $galleries_on_portfolio_page == 'portfolio_page_grouped_by_categories' || $galleries_on_portfolio_page == 'portfolio_page_grouped_by_categories_with_hierarchy' ) {
			if ( $galleries_on_portfolio_page == 'portfolio_page_grouped_by_categories' ) {
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
			$number_of_galleries = "";
			foreach ( $categories as $cat ) {
				$title = $cat->name;
				bornholm_get_galleries_from_category( $cat, $exclude_id, $number_of_galleries, 'h2', $title, $show_child_category_hierarchy );
			}
		} else {
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
		}
		?>
	</main>
<?php get_footer();
