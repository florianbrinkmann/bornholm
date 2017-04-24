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
	<?php
	/**
	 * Check if we have comments.
	 */
	if ( have_comments() ) {
		/**
		 * Check if we have also comments, and not only pings or trackbacks.
		 */
		if ( ! empty( $comments_by_type['comment'] ) ) { ?>
			<h2 id="comments-title">
				<?php echo get_bornholm_comment_count(); ?>
			</h2>

			<ol class="commentlist">
				<?php
				/**
				 * Display the comments with the callback function bornholm_comment()
				 */
				wp_list_comments( array(
					'callback' => 'bornholm_comment',
					'style'    => 'ol',
					'type'     => 'comment'
				) ); ?>
			</ol>
		<?php }

		/**
		 * Check if we have pings.
		 */
		if ( ! empty( $comments_by_type['pings'] ) ) { ?>
			<h2 id="trackbacks-title">
				<?php echo get_bornholm_trackback_count(); ?>
			</h2>

			<ol class="commentlist">
				<?php
				/**
				 * Display the pings via the bornholm_comment() callback function.
				 */
				wp_list_comments( array(
					'callback' => 'bornholm_comment',
					'type'     => 'pings'
				) ); ?>
			</ol>
		<?php }

		/**
		 * Check if we need to paginate the comments.
		 */
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
			<nav id="comment-nav-below" class="navigation" role="navigation">
				<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'bornholm' ); ?></h1>

				<div
					class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'bornholm' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'bornholm' ) ); ?></div>
			</nav>
		<?php }

		/**
		 * Check if comments are closed and we have comments.
		 */
		if ( ! comments_open() && get_comments_number() ) { ?>
			<p class="nocomments"><?php _e( 'Comments are closed.', 'bornholm' ); ?></p>
		<?php }

	}

	/**
	 * Display the comment form.
	 */
	comment_form( array(
		'comment_notes_after' => '',
		'label_submit'        => __( 'Submit Comment', 'bornholm' )
	) ); ?>
</div>
