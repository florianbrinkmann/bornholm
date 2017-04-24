<?php
/**
 * Functions file.
 *
 * @package Bornholm
 */

/**
 * Load the language files
 */
function bornholm_load_translation() {
	if ( ( ! defined( 'DOING_AJAX' ) && ! 'DOING_AJAX' ) || ! bornholm_is_login_page() || ! bornholm_is_wp_comments_post() ) {
		load_theme_textdomain( 'bornholm' );
	}
}

add_action( 'after_setup_theme', 'bornholm_load_translation' );

if ( ! isset( $content_width ) ) {
	$content_width = 800;
}

/**
 * Add two new images sizes.
 */
add_image_size( 'bornholm_large_gallery_image_for_blog_view', 951, 9999, false );
add_image_size( 'bornholm_large_gallery_image_for_single_view', 1334, 9999, false );

/**
 * Check if we are on the login page
 *
 * @return bool
 */
function bornholm_is_login_page() {
	return in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) );
}

/**
 * Check if we are on the wp-comments-post.pph
 *
 * @return bool
 */
function bornholm_is_wp_comments_post() {
	return in_array( $GLOBALS['pagenow'], array( 'wp-comments-post.php' ) );
}

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
		'name'          => __( 'Gallery Sidebar', 'bornholm' ),
		'id'            => 'sidebar-gallery',
		'description'   => __( 'This sidebar is shown on single gallery pages', 'bornholm' ),
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
 * Displays navigation for paginated posts
 *
 * @return string Formatted output in HTML.
 */
function bornholm_paginated_posts_navigation() {
	wp_link_pages( array(
		'before'      => '<ul class="page-link">',
		'after'       => '</ul>',
		'link_before' => '<li>',
		'link_after'  => '</li>',
	) );
}

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
 * Removes the page jump after clicking on a read more link
 *
 * @param $link
 *
 * @return mixed
 */
function bornholm_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );

	return $link;
}

add_filter( 'the_content_more_link', 'bornholm_remove_more_link_scroll' );

/**
 * Adds the scripts and styles to the header
 */
function bornholm_scripts_styles() {
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


	wp_enqueue_script( 'bornholm-menu', get_template_directory_uri() . '/js/menu.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'bornholm-lightbox', get_template_directory_uri() . '/js/lightbox.js', array( 'jquery' ), false, true );

	/*
	 * Loads our main stylesheet.
	 */
	wp_enqueue_style( 'bornholm-style', get_template_directory_uri() . '/css/bornholm.css', array(), null );

	wp_enqueue_style( 'bornholm-fonts', '//fonts.googleapis.com/css?family=Roboto:300,300italic,500,500italic', array(), null );
}

add_action( 'wp_enqueue_scripts', 'bornholm_scripts_styles' );

/**
 * Fetch image post objects for all gallery images in a post.
 *
 * @param $post_id
 *
 * @return array
 */
function bornholm_get_gallery_images( $post_id ) {

	$post = get_post( $post_id );

	// Den Beitrag gibt es nicht, oder er ist leer.
	if ( ! $post || empty ( $post->post_content ) ) {
		return array();
	}

	$galleries = get_post_galleries( $post, false );
	if ( empty ( $galleries ) ) {
		return array();
	}
	$ids = array();
	foreach ( $galleries as $gallery ) {
		if ( ! empty ( $gallery['ids'] ) ) {
			$ids = array_merge( $ids, explode( ',', $gallery['ids'] ) );
		}
	}
	$ids = array_unique( $ids );
	if ( empty ( $ids ) ) {
		$attachments = get_children( array(
			'post_parent'    => $post_id,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => 'ASC',
			'orderby'        => 'menu_order',
		) );
		if ( empty ( $attachments ) ) {
			return array();
		}
	}

	$images = get_posts(
		array(
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'orderby'        => 'post__in',
			'numberposts'    => 999,
			'include'        => $ids
		)
	);
	if ( ! $images && ! $attachments ) {
		return array();
	} elseif ( ! $images ) {
		$images = $attachments;
	}

	return $images;
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
 * Displays the header of a gallery.
 * If there are $images, the function displays the title with an image.
 * If not, only the title is displayed.
 *
 * @param $heading , $images, $size
 *
 * @return string Formatted output in HTML
 */
function bornholm_gallery_header( $heading, $images, $size, $post ) {
	if ( $images ) {
		bornholm_gallery_title( $heading, $images, $size, $post );
	} else {
		bornholm_post_title( $heading, $post );
	}
}

/**
 * Displays the title of a gallery with an image.
 *
 * @param $heading , $images, $size
 *
 * @return string Formatted output in HTML
 */
function bornholm_gallery_title( $heading, $images, $size, $post ) {
	if ( $size != 'bornholm_large_gallery_image_for_single_view' ) { ?>
		<a href="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
	<?php }
	if ( ! $heading == '' ) {
		echo '<' . $heading . ' class="entry-title gallery-title">';
		echo esc_html( $post->post_title );
		echo '</' . $heading . '>';
	}
	bornholm_gallery_featured_image( $size, $images, $post );
	if ( $size != 'bornholm_large_gallery_image_for_single_view' ) { ?>
		</a>
	<?php }
}

/**
 * Displays the featured image of a gallery
 *
 * @param $size , $images
 *
 * @return string Formatted output in HTML
 */
function bornholm_gallery_featured_image( $size, $images, $post ) {
	$image         = array_shift( $images );
	$image_img_tag = wp_get_attachment_image( $image->ID, $size ); ?>
	<figure class="gallery-thumb clearfix">
		<?php if ( has_post_thumbnail( $post->ID ) ) {
			echo get_the_post_thumbnail( $post->ID, $size );
		} else {
			echo $image_img_tag;
		} ?>
	</figure>
	<?php
}

/**
 * Displays the first images of a gallery
 *
 * @param $size , $images, $number_of_small_images
 *
 * @return string Formatted output in HTML
 */
function bornholm_small_gallery_thumbnails( $size, $images, $number_of_small_images ) {
	global $post;
	if ( $images ) {
		$counter = 0;
		if ( has_post_thumbnail() ) {
			bornholm_thumbnails_from_gallery_with_post_thumbnail( $post, $images, $counter, $size, $number_of_small_images );
		} else {
			bornholm_thumbnails_from_gallery_without_post_thumbnail( $images, $counter, $size, $number_of_small_images );
		}
	}
}

/**
 * Displays the first images from the gallery when a post thumbnail is set without displaying the
 * thumbnail for a second time
 *
 * @param $post , $small_images, $counter, $size, $number_of_small_images
 *
 * @return string Formatted output in HTML
 */
function bornholm_thumbnails_from_gallery_with_post_thumbnail( $post, $small_images, $counter, $size, $number_of_small_images ) {
	$post_thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) );
	$image_list     = '<ul class="gallery-thumbs clearfix">';
	foreach ( $small_images as $single_image ) {
		$single_image_url = wp_get_attachment_image_src( $single_image->ID );
		if ( $counter >= $number_of_small_images ) {
			break;
		}
		if ( $post_thumbnail[0] == $single_image_url[0] ) {
			continue;
		}
		$image_list .= '<li>' . wp_get_attachment_image( $single_image->ID, $size ) . '</li>';
		$counter ++;
	}
	$image_list .= '</ul>';
	echo $image_list;
}

/**
 * Displays the first images from the gallery
 *
 * @param $small_images , $counter, $size, $number_of_small_images
 *
 * @return string Formatted output in HTML
 */
function bornholm_thumbnails_from_gallery_without_post_thumbnail( $small_images, $counter, $size, $number_of_small_images ) {
	$image_list = '<ul class="gallery-thumbs clearfix">';
	foreach ( $small_images as $single_image ) {
		if ( $counter == 0 ) {
			$counter ++;
			continue;
		}
		if ( $counter > $number_of_small_images ) {
			break;
		}
		$image_list .= '<li>' . wp_get_attachment_image( $single_image->ID, $size ) . '</li>';
		$counter ++;
	}
	$image_list .= '</ul>';
	echo $image_list;
}

/**
 * Displays the number of gallery images
 *
 * @param $images
 *
 * @return string Formatted output in HTML
 */
function bornholm_gallery_image_number( $images ) {
	if ( $images ) {
		$total_images = count( $images ); ?>
		<p>
			<em><?php
				printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.',
					'This gallery contains <a %1$s>%2$s photos</a>.',
					$total_images, 'bornholm' ),
					'href="' . esc_url( get_permalink() )
					. '"',
					number_format_i18n( $total_images ) );
				?>
			</em>
		</p>
	<?php }
}

/**
 * Displays the “Display all” link, if there are too many galleries in one category
 *
 * @param $cat
 *
 * @return string Formatted output in HTML
 */
function bornholm_alternative_front_page_more_link( $cat ) {
	$text = _x( 'Display all galleries from “%s”', 's = category title', 'bornholm' );
	$more = sprintf( $text, esc_html( $cat->name ) ); ?>
	<article class="read-more">
		<a href="<?php echo esc_url( get_category_link( $cat->cat_ID ) ) ?>"><?php echo $more ?></a>
	</article>
<?php }

/**
 * Displays a thumbnail from a gallery
 *
 * @param $post
 */
function bornholm_alternative_front_page_gallery_teaser( $post ) { ?>
	<article>
		<?php $images_child                                   = bornholm_get_gallery_images( $post->ID );
		$hide_gallery_titles_on_alternative_front_page        = get_theme_mod( 'hide_gallery_titles_on_alternative_front_page' );
		$hide_gallery_titles_for_galleries_from_same_category = get_theme_mod( 'hide_gallery_titles_for_galleries_from_same_category' );
		$hide_gallery_titles_on_portfolio_page                = get_theme_mod( 'hide_gallery_titles_on_portfolio_page' );
		$page_template                                        = basename( get_page_template( $post->ID ) );
		if ( ( $hide_gallery_titles_on_alternative_front_page == 1 && $page_template == 'alternative-front-page.php' ) ||
		     ( $hide_gallery_titles_for_galleries_from_same_category == 1 && get_post_format() == 'gallery' && is_single() ) ||
		     $hide_gallery_titles_on_portfolio_page == 1 && $page_template == 'portfolio-page.php'
		) {
			bornholm_gallery_header( '', $images_child, 'thumbnail', $post );
		} else {
			bornholm_gallery_header( 'h3', $images_child, 'thumbnail', $post );
		} ?>
	</article>
<?php }

/**
 * Returns a comma seperated string of category ids of the given post
 *
 * @param $post_id
 *
 * @return string
 */
function bornholm_get_the_category_ids( $post_id ) {
	$category_ids = get_the_category( $post_id );
	$counter      = 0;
	foreach ( $category_ids as $category_id ) {
		if ( $counter == 0 ) {
			$category_ids = $category_id->cat_ID;
		} else {
			$category_ids .= ", $category_id->cat_ID";
		}
		$counter ++;
	}

	return $category_ids;
}

/**
 * Returns array with galleries (post format gallery) from given category
 *
 * @param $cat , $exclude_id
 *
 * @return array
 */
function bornholm_galleries_args( $cat, $exclude_id ) {
	$args = array(
		'category__in' => $cat->cat_ID,
		'exclude'      => "$exclude_id", // for the sidebar on a single gallery
		'tax_query'    => array(
			'relation' => 'AND',
			array(
				'taxonomy' => 'category',
				'field'    => 'slug',
				'terms'    => $cat->slug
			),
			array(
				'taxonomy' => 'post_format',
				'field'    => 'slug',
				'terms'    => 'post-format-gallery'
			)
		)
	);

	return $args;
}

/**
 * Displays the galleries from one category
 *
 * @param $cat , $exclude_id ,$number_of_galleries, $heading, $title, $show_child_category_hierarchy
 *
 * @return string Formatted output in HTML
 */
function bornholm_get_galleries_from_category( $cat, $exclude_id, $number_of_galleries, $heading, $title, $show_child_category_hierarchy ) {
	$galleries_args = bornholm_galleries_args( $cat, $exclude_id );
	$galleries      = get_posts( $galleries_args );
	if ( $galleries ) {
		$total_galleries = count( $galleries );
		$gallery_counter = 0; ?>
		<div class="gallery-category clearfix">
		<?php if ( $title != '' ) { ?>
			<<?php echo $heading; ?> class="category-title"><?php echo $title; ?></<?php echo $heading; ?>>
		<?php } ?>
		<?php bornholm_loop_galleries_from_category( $galleries, $total_galleries, $number_of_galleries, $gallery_counter, $cat );
		if ( $show_child_category_hierarchy ) {
			bornholm_get_child_category_galleries( $cat, $number_of_galleries, $exclude_id, $title, $heading );
		} ?>
		</div>
	<?php }
}

/**
 * Loops through the child galleries and calls the functions to display them
 *
 * @param $cat , $number_of_galleries
 *
 * @return string Formatted output in HTML
 */
function bornholm_get_child_category_galleries( $cat, $number_of_galleries, $exclude_id, $title, $heading ) {
	$category_children = get_term_children( $cat->term_id, 'category' );
	if ( $category_children ) {
		foreach ( $category_children as $cat_child ) {
			$cat_child            = get_category( $cat_child );
			$child_galleries_args = bornholm_galleries_args( $cat_child, $exclude_id );
			$child_galleries      = get_posts( $child_galleries_args );
			if ( $child_galleries ) {
				$total_child_galleries = count( $child_galleries );
				$gallery_child_counter = 0; ?>
				<div class="gallery-category child">
				<?php if ( $title != '' ) {
					$title = $cat_child->name; ?>
					<<?php echo $heading; ?>><?php echo $title; ?></<?php echo $heading; ?>>
				<?php }
				bornholm_loop_galleries_from_category( $child_galleries, $total_child_galleries, $number_of_galleries, $gallery_child_counter, $cat_child ); ?>
				</div>
			<?php }
		}
	}
}

/**
 * Loops through the galleries of the given category and calls the functions for displaying the teaser
 * of the galleries and the “Display all” link
 *
 * @param $galleries , $total_galleries, $number_of_galleries, $gallery_counter, $cat
 *
 * @return string Formatted output in HTML
 */
function bornholm_loop_galleries_from_category( $galleries, $total_galleries, $number_of_galleries, $gallery_counter, $cat ) {
	foreach ( $galleries as $post ) {
		if ( $number_of_galleries > 0 ) {
			if ( $total_galleries > $number_of_galleries ) {
				$gallery_counter ++;
				if ( $gallery_counter > $number_of_galleries ) {
					bornholm_alternative_front_page_more_link( $cat );
					break;
				}
			}
		}
		bornholm_alternative_front_page_gallery_teaser( $post );
	}
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
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own bornholm_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function bornholm_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
			// Display trackbacks differently than normal comments.
			?>
			<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p><?php _e( 'Trackback:', 'bornholm' ); ?><?php esc_url( comment_author_link() ); ?><?php esc_url( edit_comment_link( __( '(Edit)', 'bornholm' ), '<span class="edit-link">', '</span>' ) ); ?></p>
			<?php
			break;
		default :
			// Proceed with normal comments.
			global $post;
			?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<header class="comment-meta comment-author vcard clearfix">
					<?php
					echo get_avatar( $comment, 100 ); ?>
					<cite class="fn">
						<?php esc_url( comment_author_link() ); ?>
					</cite>

					<?php printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						sprintf( _x( '%1$s @ %2$s', '1=date 2=time', 'bornholm' ), get_comment_date(), get_comment_time() )
					); ?>
				</header>

				<?php if ( '0' == $comment->comment_approved ) { ?>
					<p class="comment-awaiting-moderation">
						<?php _e( 'Your comment is awaiting moderation.', 'bornholm' ); ?>
					</p>
				<?php } ?>

				<section class="comment-content comment">
					<?php comment_text(); ?>
					<?php esc_url( edit_comment_link( __( 'Edit', 'bornholm' ), '<p class="edit-link">', '</p>' ) ); ?>
				</section>

				<div class="reply">
					<?php esc_url( comment_reply_link(
						array(
							'reply_text' => __( 'Reply', 'bornholm' ),
							'depth'      => $depth,
							'max_depth'  => $args['max_depth']
						)
					) ); ?>
				</div>
			</article>
			<?php
			break;
	endswitch; // end comment_type check
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

require get_template_directory() . '/inc/class-recent-galleries.php';

require get_template_directory() . '/inc/class-featured-galleries.php';


function register_bornholm_widgets() {
	register_widget( 'Bornholm_Recent_Galleries' );
	register_widget( 'Bornholm_Featured_Galleries' );
}

add_action( 'widgets_init', 'register_bornholm_widgets' );

require get_template_directory() . '/inc/customizer.php';
