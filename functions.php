<?php
/**
 * Adds theme support for custom header, feed links, title tag, post formats, HTML5 and post thumbnails
 */
function bornholm_add_theme_support() {
	add_theme_support( 'custom-header' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-formats', array(
		'aside',
		'link',
		'gallery',
		'status',
		'quote',
		'image',
		'video',
		'audio',
		'chat'
	) );
	add_theme_support( 'html5', array(
		'comment-list',
		'comment-form',
		'search-form',
		'gallery',
		'caption',
	) );
	add_theme_support( 'post-thumbnails' );
}

add_action( 'after_setup_theme', 'bornholm_add_theme_support' );

/**
 * Registers the menu
 */
function bornholm_menus() {
	register_nav_menus( array(
		'header-menu' => __( 'Header Menu', 'bornholm' ),
	) );
}

add_action( 'init', 'bornholm_menus' );

/**
 * Registers the sidebar
 */
function bornholm_sidebars() {
	register_sidebar( array(
		'name'          => 'Sidebar',
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div class="widget clearfix %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area (top)', 'bornholm' ),
		'id'            => 'footer-widget-area-top',
		'description'   => __( 'This widget area is shown on the top of the footer', 'bornholm' ),
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area (bottom)', 'bornholm' ),
		'id'            => 'footer-widget-area-bottom',
		'description'   => __( 'This widget area is shown on the bottom of the footer', 'bornholm' ),
		'before_widget' => '<div class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>'
	) );
}

add_action( 'widgets_init', 'bornholm_sidebars' );

/**
 * Displays the content with customized more link
 *
 * @return string Formatted output in HTML
 */
function bornholm_the_content() {
	$text = _x( 'Continue reading “%s”', 's = post title', 'bornholm' );
	$more = sprintf( $text, esc_html( get_the_title() ) );
	the_content( $more );
}

/**
 * Displays the header for normal posts
 *
 * @param $heading
 *
 * @return string Formatted output in HTML
 */
function bornholm_the_post_header( $heading, $post ) {
	if ( has_post_thumbnail() ) {
		if ( ! is_single() ) { ?>
			<a href="<?php esc_url( the_permalink() ); ?>">
		<?php }

		echo '<' . $heading . ' class="entry-title">';
		the_title();
		echo '</' . $heading . '>'; ?>
		<figure class="featured-image">
			<?php the_post_thumbnail(); ?>
		</figure>
		<?php if ( ! is_single() ) { ?>
			</a>
		<?php }
	} else {
		bornholm_post_title( $heading, $post );
	}
}

/**
 * Displays the post title
 *
 * @param $heading
 *
 * @return string Formatted output in HTML
 */
function bornholm_post_title( $heading, $post ) {
	echo '<' . $heading . ' class="entry-title">';
	if ( ! is_single() ) { ?>
		<a href="<?php esc_url( the_permalink() ); ?>">
	<?php }
	the_title();
	if ( ! is_single() ) { ?>
		</a>
	<?php }
	echo '</' . $heading . '>';
}

/**
 * Displays the footer for a post
 *
 * @return string Formatted output in HTML
 */
function bornholm_footer_meta() { ?>
	<p>
		<a href="<?php esc_url( the_permalink() ); ?>"><?php echo sprintf( _x( '%1$s @ %2$s', '1 = date, 2 = time', 'bornholm' ), get_the_date(), get_the_time() ); ?></a>
		<?php
		$show_sep = true;
		bornholm_show_seperator( $show_sep );
		$show_sep      = false;
		$category_list = get_the_category_list( _x( ', ', 'term delimiter', 'bornholm' ) );
		if ( $category_list ) {
			bornholm_category_list( $category_list );
			$show_sep = true;
		}
		$tag_list = get_the_tag_list( '', _x( ', ', 'term delimiter', 'bornholm' ) );
		if ( $tag_list ) {
			bornholm_show_seperator( $show_sep );
			bornholm_tag_list( $tag_list );
			$show_sep = true;
		}
		bornholm_show_seperator( $show_sep ); ?>
		<span class="author">
            <?php _e( 'Author:', 'bornholm' ); ?><?php the_author(); ?>
        </span>
		<?php
		$show_sep = true;
		if ( get_bornholm_comment_count() != 0 ) {
			bornholm_show_seperator( $show_sep ); ?>
			<a href="<?php echo esc_url( get_the_permalink() ) . "#comments-title"; ?>">
				<?php echo get_bornholm_comment_count(); ?>
			</a>
			<?php $show_sep = true;
		}

		if ( get_bornholm_trackback_count() != 0 ) {
			bornholm_show_seperator( $show_sep ); ?>
			<a href="<?php echo esc_url( get_the_permalink() ) . "#trackbacks-title"; ?>">
				<?php echo get_bornholm_trackback_count(); ?>
			</a>

		<?php }
		edit_post_link( __( 'Edit', 'bornholm' ), '<span class="edit-link"> ·  ', '</span>' ); ?>

	</p>
<?php }

/**
 * Displays the category list
 *
 * @param $category_list
 *
 * @return string Formatted output in HTML
 */
function bornholm_category_list( $category_list ) { ?>
	<span class="cat-links">
        <?php _e( 'Posted in ', 'bornholm' );
        echo $category_list; ?>
    </span>
<?php }

/**
 * Displays the tag list
 *
 * @param $tag_list
 *
 * @return string Formatted output in HTML
 */
function bornholm_tag_list( $tag_list ) { ?>
	<span class="tag-links">
        <?php _e( 'Tagged ', 'bornholm' );
        echo $tag_list; ?>
    </span>
<?php }

/**
 * Displays the seperator (for example between tag list and category list
 *
 * @param $show_sep
 *
 * @return string Formatted output in HTML
 */
function bornholm_show_seperator( $show_sep ) {
	if ( $show_sep ) { ?>
		<span class="sep"> · </span>
	<?php }
}

/**
 * Returns the number of comments for a post
 *
 * @return string
 */
function get_bornholm_comment_count() {
	global $post;
	$the_post_id = $post->ID;
	global $wpdb;
	$co_number = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_type = %s
AND comment_post_ID = %d AND comment_approved = %d", ' ', $the_post_id, 1 ) );
	if ( $co_number == 0 ) {
		return $co_number;
	} elseif ( $co_number == 1 ) {
		$co_number = $co_number . __( ' Comment', 'bornholm' );

		return $co_number;
	} else {
		$co_number = $co_number . __( ' Comments', 'bornholm' );

		return $co_number;
	}
}


/**
 * Returns the Number of trackbacks for a post
 *
 * @return string
 */
function get_bornholm_trackback_count() {
	global $post;
	$the_post_id = $post->ID;
	global $wpdb;
	$tb_number = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_type != %s
AND comment_post_ID = %d AND comment_approved = %d", ' ', $the_post_id, 1 ) );
	if ( $tb_number == 0 ) {
		return $tb_number;
	} elseif ( $tb_number == 1 ) {
		$tb_number = $tb_number . __( ' Trackback', 'bornholm' );

		return $tb_number;
	} else {
		$tb_number = $tb_number . __( ' Trackbacks', 'bornholm' );

		return $tb_number;
	}
}