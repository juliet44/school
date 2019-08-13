<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0
 */

						// Widgets area inside page content
						greenville_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					greenville_create_widgets_area('widgets_below_page');

					$greenville_body_style = greenville_get_theme_option('body_style');
					if ($greenville_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$greenville_footer_style = greenville_get_theme_option("footer_style");
			if (strpos($greenville_footer_style, 'footer-custom-')===0) $greenville_footer_style = 'footer-custom';
			get_template_part( "templates/{$greenville_footer_style}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (greenville_is_on(greenville_get_theme_option('debug_mode')) && greenville_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(greenville_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>