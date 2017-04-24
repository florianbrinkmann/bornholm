<?php
/**
 * Displays the top footer sidebar.
 *
 * @package Bornholm
 */

?>
<footer id="footer" role="contentinfo">
	<?php	if ( is_active_sidebar( 'footer-widget-area-top' ) ) { ?>
		<aside id="footer-top" class="clearfix">
			<?php dynamic_sidebar( 'footer-widget-area-top' ); ?>
		</aside>
	<?php
	}
