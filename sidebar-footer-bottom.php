<?php
if ( is_active_sidebar( 'footer-widget-area-bottom' ) ) { ?>
	<aside id="footer-bottom" class="clearfix">
		<?php dynamic_sidebar( 'footer-widget-area-bottom' ); ?>
	</aside>
	<?php
}
?>
<p class="theme-author"><?php _e( 'Theme: Bornholm by <a rel="nofollow" href="http://florianbrinkmann.de">Florian Brinkmann</a>', 'bornholm' ) ?></p>
</footer>