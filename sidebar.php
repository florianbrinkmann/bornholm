<?php
/**
 * Template part for displaying the sidebar.
 *
 * @package Bornholm
 */

?>
<aside id="sidebar" role="complementary">
	<div id="sidebar-content">
		<?php if ( is_active_sidebar( 'sidebar-1' ) ) {
			dynamic_sidebar( 'sidebar-1' );
		} ?>
	</div>
</aside>
