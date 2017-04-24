<?php
/**
 * Archive template.
 *
 * @package Bornholm
 */

get_header(); ?>
	<main role="main">
		<?php if ( have_posts() ) { ?>
			<header class="archive-header">
				<h1>
					<?php echo esc_html( get_the_archive_title() ); ?>
				</h1>
				<?php the_archive_description(); ?>
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
