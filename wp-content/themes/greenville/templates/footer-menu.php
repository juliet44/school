<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0.10
 */

// Footer menu
$greenville_menu_footer = greenville_get_nav_menu('menu_footer');
if (!empty($greenville_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php greenville_show_layout($greenville_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>