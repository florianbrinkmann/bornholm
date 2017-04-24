<?php
/**
 * Search template.
 *
 * @package Bornholm
 */

get_header(); ?>
	<main role="main">
		<?php if ( have_posts() ) { ?>
			<header class="archive-header">
				<h1>
					<?php printf( __( 'Search Results for: %s', 'bornholm' ), esc_html( get_search_query() ) ); ?>
				</h1>
			</header>
			<?php
			while ( have_posts() ) {
				the_post();
				get_template_part( 'content', get_post_format() );
			}
		}
		the_posts_pagination( array( 'type' => 'list' ) ); ?>
	</main>
<?php get_sidebar();
get_footer();
