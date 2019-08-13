<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0
 */

$greenville_args = get_query_var('greenville_logo_args');

// Site logo
$greenville_logo_image  = greenville_get_logo_image(isset($greenville_args['type']) ? $greenville_args['type'] : '');
$greenville_logo_text   = greenville_is_on(greenville_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$greenville_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($greenville_logo_image) || !empty($greenville_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($greenville_logo_image)) {
			$greenville_attr = greenville_getimagesize($greenville_logo_image);
            $alt = basename($greenville_logo_image);
            $alt = substr($alt,0,strlen($alt) - 4);
			echo '<img src="'.esc_url($greenville_logo_image).'" alt="'.esc_html($alt).'"'.(!empty($greenville_attr[3]) ? sprintf(' %s', $greenville_attr[3]) : '').'>' ;
		} else {
			greenville_show_layout(greenville_prepare_macros($greenville_logo_text), '<span class="logo_text">', '</span>');
			greenville_show_layout(greenville_prepare_macros($greenville_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>