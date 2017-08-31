<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package _UCLQ
 */
?>
<footer id="colophon" class="site-footer" role="contentinfo">
<?php // substitute the class "container-fluid" below if you want a wider content area ?>
	<div class="container-fluid">
		<div class="row">
			<div class="site-footer-inner col-sm-8 no-padded-col">
				<div class="site-info">
					<?php do_action( '_UCLQ_credits' ); ?>
					<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', '_UCLQ' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', '_UCLQ' ), 'WordPress' ); ?></a>
					<br>
					<a class="credits" href="http://github.com/padraic-padraic/_UCLQ" target="_blank" title="Theme and Plugins developed by Padraic Calpin" alt="Theme and Plugins developed by Padraic Calpin">Theme and plugins developed by Padraic Calpin, </a>
                    <a class="credits" href="http://themekraft.com/" target="_blank" title="Themes and Plugins developed by Themekraft" alt="Themes and Plugins developed by Themekraft"><?php _e('and based on the _tk theme, developed by Themekraft.','_UCLQ') ?> </a><br>
                    <a class="credits" href="mailto:j.mohanty@ucl.ac.uk"> Layout and design by Aparajita Mohanty</a>
				</div><!-- close .site-info -->
			</div>
			<div class="site-footer-inner col-sm-4 no-padded-col social-icons text-right">
			<a href="https://twitter.com/UCLQuantum"><i class="fa fa-twitter fa-2x" aria-hidden="true"></i></a>
			<a href="https://www.youtube.com/channel/UCuw7eoi7mRyXH6ItWfBSkLg"><i class="fa fa-youtube fa-2x" aria-hidden="true"></i></a>
			</div>
		</div>
	</div><!-- close .container -->
</footer><!-- close #colophon -->

<?php wp_footer(); ?>

</body>
</html>
