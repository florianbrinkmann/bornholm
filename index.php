<?php get_header(); ?>
	<main role="main">
		<?php if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				get_template_part( 'content', get_post_format() );
			}
		}
		the_posts_pagination( array( 'type' => 'list' ) ); ?>
	</main>
<?php get_sidebar();
get_footer();