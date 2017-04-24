<?php
/**
 * Class for featured galleries widget.
 *
 * @package Bornholm
 */


/**
 * Featured_Galleries widget class
 */
class Bornholm_Featured_Galleries extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname'   => 'widget_featured_galleries',
			'description' => _x( 'Enter ids of galleries you want to feature.', 'Description of the featured galleries widget', 'bornholm' )
		);
		parent::__construct( 'featured-galleries', _x( 'Featured Galleries', 'Name of the featured galleries widget', 'bornholm' ), $widget_ops );
	}

	public function widget( $args, $instance ) {

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$gallery_ids = ! empty( $instance['gallery_ids'] ) ? explode( ',', $instance['gallery_ids'] ) : array();
		$counter     = 0;
		foreach ( $gallery_ids as $gallery_id ) {
			$post   = get_post( $gallery_id );
			$format = get_post_format( $gallery_id );
			if ( $post && $format == 'gallery' ) {
				if ( $counter == 0 ) {
					echo $args['before_widget'];
					if ( $title ) {
						echo $args['before_title'] . $title . $args['after_title'];
					}
				}
				$images                                           = bornholm_get_gallery_images( $gallery_id );
				$hide_gallery_titles_on_featured_galleries_widget = get_theme_mod( 'hide_gallery_titles_on_featured_galleries_widget' ); ?>
				<div>
					<?php if ( $hide_gallery_titles_on_featured_galleries_widget == 1 ) {
						bornholm_gallery_header( '', $images, 'thumbnail', $post );
					} else {
						bornholm_gallery_header( 'h4', $images, 'thumbnail', $post );
					} ?>
				</div>
				<?php $counter ++;
			}
		}
		if ( $counter != 0 ) {
			echo $args['after_widget'];
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance                = $old_instance;
		$instance['title']       = strip_tags( $new_instance['title'] );
		$instance['gallery_ids'] = strip_tags( $new_instance['gallery_ids'] );

		return $instance;
	}

	public function form( $instance ) {
		$title       = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$gallery_ids = isset( $instance['gallery_ids'] ) ? esc_attr( $instance['gallery_ids'] ) : '';
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'bornholm' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>"/>
		</p>

		<p><label
				for="<?php echo $this->get_field_id( 'gallery_ids' ); ?>"><?php _e( 'Comma seperated ids of galleries you want to feature:', 'bornholm' ); ?></label>
			<input class="widefat" placeholder="523, 547" id="<?php echo $this->get_field_id( 'gallery_ids' ); ?>"
			       name="<?php echo $this->get_field_name( 'gallery_ids' ); ?>" type="text"
			       value="<?php echo $gallery_ids; ?>"/></p>

		<?php
	}
}
