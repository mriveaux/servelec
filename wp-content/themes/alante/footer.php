<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id="main-core".
 *
 * @package ThinkUpThemes
 */
?>

		</div><!-- #main-core -->
		</div><!-- #main -->

		<?php /* Sidebar */ alante_thinkup_sidebar_html(); ?>
	</div>
	</div><!-- #content -->

	<?php /* Call To Action - Outro */ alante_thinkup_input_ctaoutro(); ?>

	<footer>
		<?php /* Custom Footer Layout */ alante_thinkup_input_footerlayout();
		echo	'<!-- #footer -->';  ?>
		
		<div id="sub-footer">
		<div id="sub-footer-core">	
		
			<div class="copyright">
			<?php /* === Add custom footer === */ alante_thinkup_input_copyright(); ?>
			</div>
			<!-- .copyright -->

			<?php if ( has_nav_menu( 'sub_footer_menu' ) ) : ?>
			<?php wp_nav_menu( array( 'depth' => 1, 'container_class' => 'sub-footer-links', 'container_id' => 'footer-menu', 'theme_location' => 'sub_footer_menu' ) ); ?>
			<?php endif; ?>
			<!-- #footer-menu -->

		</div>
		</div>
	</footer><!-- footer -->

</div><!-- #body-core -->

<?php wp_footer(); ?>

</body>
</html>