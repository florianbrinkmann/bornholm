<?php
/**
 * Author template.
 *
 * @package Bornholm
 */

get_header(); ?>
	<main role="main">
		<?php if ( have_posts() ) { ?>
			<header class="archive-header">
				<h1>
					<?php printf( __( 'All posts by %s', 'bornholm' ), get_the_author() ); ?>
				</h1>
				<?php if ( get_the_author_meta( 'description' ) ) {
					the_author_meta( 'description' );
				} ?>
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
