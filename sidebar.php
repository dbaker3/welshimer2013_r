<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package welshimer2013
 * @since welshimer2013 1.0
 */
?>
		<div id="secondary" class="widget-area widget-text" role="complementary">
			<?php do_action( 'before_sidebar' ); ?>

			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

	<!--Dynamic Content Goes here-->

			<?php endif; // end sidebar widget area ?>

		</div><!-- #secondary .widget-area -->
