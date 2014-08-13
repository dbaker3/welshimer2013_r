<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package welshimer2013
 * @since welshimer2013 1.0
 */
?>

	</div><!-- #main -->

	<footer id="colophon" class="site-footer widget-text" role="contentinfo">
			<div class="footer-logo"><img src="<?php bloginfo( 'template_url' ); ?>/images/mc-logo.png" /></div>
		<div class="site-info">
			<?php do_action( 'welshimer2013_credits' ); ?>
            Proudly powered by <a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'welshimer2013' ); ?>"><?php printf( __( '%s', 'welshimer2013' ), 'WordPress' ); ?></a>
		</div><!-- .site-info -->
	</footer><!-- .site-footer .site-footer -->
</div><!-- #page .hfeed .site -->

<?php wp_footer(); ?>
<?php do_action( 'footer_scripts' ); ?>

<noscript><div class="foot-noscript"><p>Some features may not work properly (or at all!) with Javascript disabled or in some older browsers. (<a target="_blank" href="http://enable-javascript.com/">How can I fix this?</a>)</p><p class="old-ie-nojs">Yowza. It's worse than we thought. This site REALLY isn't going to work very well with your current setup. You should probably upgrade your browser.</p></div></noscript>
</body>
</html>