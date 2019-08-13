<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0.10
 */

// Footer sidebar
$greenville_footer_name = greenville_get_theme_option('footer_widgets');
$greenville_footer_present = !greenville_is_off($greenville_footer_name) && is_active_sidebar($greenville_footer_name);
if ($greenville_footer_present) { 
	greenville_storage_set('current_sidebar', 'footer');
	$greenville_footer_wide = greenville_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($greenville_footer_name) ) {
		dynamic_sidebar($greenville_footer_name);
	}
	$greenville_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($greenville_out)) {
		$greenville_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $greenville_out);
		$greenville_need_columns = true;	//or check: strpos($greenville_out, 'columns_wrap')===false;
		if ($greenville_need_columns) {
			$greenville_columns = max(0, (int) greenville_get_theme_option('footer_columns'));
			if ($greenville_columns == 0) $greenville_columns = min(6, max(1, substr_count($greenville_out, '<aside ')));
			if ($greenville_columns > 1)
				$greenville_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($greenville_columns).' widget ', $greenville_out);
			else
				$greenville_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($greenville_footer_wide) ? ' footer_fullwidth' : ''; ?>">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$greenville_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($greenville_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'greenville_action_before_sidebar' );
				greenville_show_layout($greenville_out);
				do_action( 'greenville_action_after_sidebar' );
				if ($greenville_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$greenville_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>