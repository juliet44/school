<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0.10
 */

$greenville_footer_id = str_replace('footer-custom-', '', greenville_get_theme_option("footer_style"));
if ((int) $greenville_footer_id == 0) {
    $greenville_footer_id = greenville_get_post_id(array(
            'name' => $greenville_footer_id,
            'post_type' => defined('TRX_ADDONS_CPT_LAYOUTS_PT') ? TRX_ADDONS_CPT_LAYOUTS_PT : 'cpt_layouts'
        )
    );
} else {
    $greenville_footer_id = apply_filters('trx_addons_filter_get_translated_layout', $greenville_footer_id);
}


$greenville_footer_scheme =  greenville_is_inherit(greenville_get_theme_option('footer_scheme')) ? greenville_get_theme_option('color_scheme') : greenville_get_theme_option('footer_scheme');
$greenville_footer_id = str_replace('footer-custom-', '', greenville_get_theme_option("footer_style"));
$greenville_footer_meta = get_post_meta($greenville_footer_id, 'trx_addons_options', true);
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($greenville_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($greenville_footer_id))); 
						if (!empty($greenville_footer_meta['margin']) != '') 
							echo ' '.esc_attr(greenville_add_inline_css_class('margin-top: '.esc_attr(greenville_prepare_css_value($greenville_footer_meta['margin'])).';'));
						?> scheme_<?php echo esc_attr($greenville_footer_scheme); 
						?>">
	<?php
    // Custom footer's layout
    do_action('greenville_action_show_layout', $greenville_footer_id);
	?>
</footer><!-- /.footer_wrap -->
