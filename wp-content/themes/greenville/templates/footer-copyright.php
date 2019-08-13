<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0.10
 */

// Copyright area
$greenville_footer_scheme =  greenville_is_inherit(greenville_get_theme_option('footer_scheme')) ? greenville_get_theme_option('color_scheme') : greenville_get_theme_option('footer_scheme');
$greenville_copyright_scheme = greenville_is_inherit(greenville_get_theme_option('copyright_scheme')) ? $greenville_footer_scheme : greenville_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($greenville_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				// Replace {{...}} and [[...]] on the <i>...</i> and <b>...</b>
				$greenville_copyright = greenville_prepare_macros(greenville_get_theme_option('copyright'));
				if (!empty($greenville_copyright)) {
					// Replace {date_format} on the current date in the specified format
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $greenville_copyright, $greenville_matches)) {
						$greenville_copyright = str_replace($greenville_matches[1], date(str_replace(array('{', '}'), '', $greenville_matches[1])), $greenville_copyright);
					}
					// Display copyright
					echo wp_kses_data(nl2br($greenville_copyright));
				}
			?></div>
		</div>
	</div>
</div>
