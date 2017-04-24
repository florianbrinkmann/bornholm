<?php
/**
 * Comments template.
 *
 * @package Bornholm
 */


if ( post_password_required() ) {
	return;
} ?>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) {
		if ( ! empty( $comments_by_type['comment'] ) ) { ?>
			<h2 id="comments-title">
				<?php echo get_bornholm_comment_count(); ?>
			</h2>

			<ol class="commentlist">
				<?php wp_list_comments( array(
					'callback' => 'bornholm_comment',
					'style'    => 'ol',
					'type'     => 'comment'
				) ); ?>
			</ol>
		<?php }
		if ( ! empty( $comments_by_type['pings'] ) ) { ?>
			<h2 id="trackbacks-title">
				<?php echo get_bornholm_trackback_count(); ?>
			</h2>

			<ol class="commentlist">
				<?php wp_list_comments( array( 'callback' => 'bornholm_comment', 'type' => 'pings' ) ); ?>
			</ol>
		<?php }
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // are there comments to navigate through ?>
			<nav id="comment-nav-below" class="navigation" role="navigation">
				<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'bornholm' ); ?></h1>

				<div
					class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'bornholm' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'bornholm' ) ); ?></div>
			</nav>
		<?php }
		if ( ! comments_open() && get_comments_number() ) { ?>
			<p class="nocomments"><?php _e( 'Comments are closed.', 'bornholm' ); ?></p>
		<?php }

	}
	comment_form( array( 'comment_notes_after' => '', 'label_submit' => __( 'Submit Comment', 'bornholm' ) ) ); ?>
</div>
