<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0
 */

// Header sidebar
$greenville_header_name = greenville_get_theme_option('header_widgets');
$greenville_header_present = !greenville_is_off($greenville_header_name) && is_active_sidebar($greenville_header_name);
if ($greenville_header_present) { 
	greenville_storage_set('current_sidebar', 'header');
	$greenville_header_wide = greenville_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($greenville_header_name) ) {
		dynamic_sidebar($greenville_header_name);
	}
	$greenville_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($greenville_widgets_output)) {
		$greenville_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $greenville_widgets_output);
		$greenville_need_columns = strpos($greenville_widgets_output, 'columns_wrap')===false;
		if ($greenville_need_columns) {
			$greenville_columns = max(0, (int) greenville_get_theme_option('header_columns'));
			if ($greenville_columns == 0) $greenville_columns = min(6, max(1, substr_count($greenville_widgets_output, '<aside ')));
			if ($greenville_columns > 1)
				$greenville_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($greenville_columns).' widget ', $greenville_widgets_output);
			else
				$greenville_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($greenville_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$greenville_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($greenville_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'greenville_action_before_sidebar' );
				greenville_show_layout($greenville_widgets_output);
				do_action( 'greenville_action_after_sidebar' );
				if ($greenville_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$greenville_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>