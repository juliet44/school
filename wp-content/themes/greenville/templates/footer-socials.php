<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0.10
 */


// Socials
if ( greenville_is_on(greenville_get_theme_option('socials_in_footer')) && ($greenville_output = greenville_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php greenville_show_layout($greenville_output); ?>
		</div>
	</div>
	<?php
}
?>