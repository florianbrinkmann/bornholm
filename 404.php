<?php
/**
 * 404 error template.
 *
 * @package Bornholm
 */

get_header(); ?>
	<main role="main">
		<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Nothing Found', 'bornholm' ); ?></h1>
			</header>
			<div class="entry-content">
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'bornholm' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</article>
	</main>
<?php get_sidebar();
get_footer();
