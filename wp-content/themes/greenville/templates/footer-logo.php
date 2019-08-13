<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0.10
 */

// Logo
if (greenville_is_on(greenville_get_theme_option('logo_in_footer'))) {
	$greenville_logo_image = '';
	if (greenville_get_retina_multiplier(2) > 1)
		$greenville_logo_image = greenville_get_theme_option( 'logo_footer_retina' );
	if (empty($greenville_logo_image)) 
		$greenville_logo_image = greenville_get_theme_option( 'logo_footer' );
	$greenville_logo_text   = get_bloginfo( 'name' );
	if (!empty($greenville_logo_image) || !empty($greenville_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($greenville_logo_image)) {
					$greenville_attr = greenville_getimagesize($greenville_logo_image);
                    $alt = basename($greenville_logo_image);
                    $alt = substr($alt,0,strlen($alt) - 4);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($greenville_logo_image).'" class="logo_footer_image" alt="'.esc_html($alt).'"'.(!empty($greenville_attr[3]) ? sprintf(' %s', $greenville_attr[3]) : '').'></a>' ;
				} else if (!empty($greenville_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($greenville_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>