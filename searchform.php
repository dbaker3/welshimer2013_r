<?php
/**
 * The template for displaying search forms in welshimer2013
 *
 * @package welshimer2013
 * @since welshimer2013 1.0
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
		<label for="s" class="assistive-text"><?php _e( 'Search', 'welshimer2013' ); ?></label>
		<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'welshimer2013' ); ?>" />
		<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'welshimer2013' ); ?>" />
	</form>
