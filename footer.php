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
	<div class="container">
		<div class="row">
			<div class="site-footer-inner col-sm-12">

				<div class="site-info">
					<?php do_action( '_UCLQ_credits' ); ?>
					<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', '_UCLQ' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', '_UCLQ' ), 'WordPress' ); ?></a>
					<span class="sep"> | </span>
                    <a class="credits" href="http://themekraft.com/" target="_blank" title="Themes and Plugins developed by Themekraft" alt="Themes and Plugins developed by Themekraft"><?php _e('Themes and Plugins developed by Themekraft.','_UCLQ') ?> </a>
				</div><!-- close .site-info -->

			</div>
		</div>
	</div><!-- close .container -->
</footer><!-- close #colophon -->

<?php wp_footer(); ?>

</body>
</html>
