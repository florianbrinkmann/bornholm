<aside id="sidebar-gallery" role="sidebar" class="clearfix">
	<div id="sidebar-content">
		<?php $number_of_galleries = 3;
		$category_ids              = bornholm_get_the_category_ids( $post->ID );
		$args                      = array(
			'orderby' => 'name',
			'include' => $category_ids,
		);
		$categories                = get_categories( $args );
		$exclude_id                = $post->ID;
		foreach ( $categories as $cat ) {
			$title = sprintf( _x( 'More galleries from %1$s', '1 = name of category', 'bornholm' ), $cat->name );
			bornholm_get_galleries_from_category( $cat, $exclude_id, $number_of_galleries, 'h3', $title, false );
		}
		if ( is_active_sidebar( 'sidebar-gallery' ) ) { ?>
			<div class="widgets">
				<?php dynamic_sidebar( 'sidebar-gallery' ); ?>
			</div>
		<?php } ?>
	</div>
</aside>