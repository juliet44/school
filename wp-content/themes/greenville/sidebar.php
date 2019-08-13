<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0
 */

$greenville_sidebar_position = greenville_get_theme_option('sidebar_position');
if (greenville_sidebar_present()) {
	ob_start();
	$greenville_sidebar_name = greenville_get_theme_option('sidebar_widgets');
	greenville_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($greenville_sidebar_name) ) {
		dynamic_sidebar($greenville_sidebar_name);
	}
	$greenville_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($greenville_out)) {
		?>
		<div class="sidebar <?php echo esc_attr($greenville_sidebar_position); ?> widget_area<?php if (!greenville_is_inherit(greenville_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(greenville_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'greenville_action_before_sidebar' );
				greenville_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $greenville_out));
				do_action( 'greenville_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>