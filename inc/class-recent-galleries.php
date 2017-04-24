<?php
/**
 * Class for recent galleries widget.
 *
 * @package Bornholm
 */

/**
 * Recent_Galleries widget class
 */
class Bornholm_Recent_Galleries extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_recent_galleries',
			'description' => _x( 'Your site’s most recent galleries.', 'Description of the recent galleries widget', 'bornholm' )
		);
		parent::__construct( 'recent-galleries', _x( 'Recent Galleries', 'Name of the recent galleries widget', 'bornholm' ), $widget_ops );
	}

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 2;
		if ( ! $number ) {
			$number = 2;
		}

		/**
		 * Filter the arguments for the Recent Galleries widget
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$result = new WP_Query( apply_filters( 'widget_galleries_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'tax_query'           => array(
				array(
					'taxonomy' => 'post_format',
					'field'    => 'slug',
					'terms'    => 'post-format-gallery'
				)
			)
		) ) );

		if ( $result->have_posts() ) {
			echo $args['before_widget'];
			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			}
			while ( $result->have_posts() ) {
				$result->the_post();
				$post   = get_post( get_the_ID() );
				$images = bornholm_get_gallery_images( $post->ID );
				if ( $images ) {
					$hide_gallery_titles_on_recent_galleries_widget = get_theme_mod( 'hide_gallery_titles_on_recent_galleries_widget' ); ?>
					<div>
						<?php if ( $hide_gallery_titles_on_recent_galleries_widget == 1 ) {
							bornholm_gallery_header( '', $images, 'thumbnail', $post );
						} else {
							bornholm_gallery_header( 'h4', $images, 'thumbnail', $post );
						} ?>
					</div>
				<?php }
			}
			echo $args['after_widget'];
// Reset the global $the_post as this query will have stomped on it
			wp_reset_postdata();
		}
	}


	public function update( $new_instance, $old_instance ) {
		$instance           = $old_instance;
		$instance['title']  = strip_tags( $new_instance['title'] );
		$instance['number'] = (int) $new_instance['number'];

		return $instance;
	}

	public function form( $instance ) {
		$title  = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 2;
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'bornholm' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>"/>
		</p>

		<p><label
				for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of galleries to show:', 'bornholm' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'number' ); ?>"
			       name="<?php echo $this->get_field_name( 'number' ); ?>" type="number"
			       value="<?php echo $number; ?>"/></p>

		<?php
	}
}
