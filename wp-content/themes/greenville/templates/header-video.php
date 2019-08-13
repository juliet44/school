<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0.14
 */
$greenville_header_video = greenville_get_header_video();
$greenville_embed_video = '';
if (!empty($greenville_header_video) && !greenville_is_from_uploads($greenville_header_video)) {
	if (greenville_is_youtube_url($greenville_header_video) && preg_match('/[=\/]([^=\/]*)$/', $greenville_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$greenville_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($greenville_header_video) . '[/embed]' ));
			$greenville_embed_video = greenville_make_video_autoplay($greenville_embed_video);
		} else {
			$greenville_header_video = str_replace('/watch?v=', '/embed/', $greenville_header_video);
			$greenville_header_video = greenville_add_to_url($greenville_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$greenville_embed_video = '<iframe src="' . esc_url($greenville_header_video) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php greenville_show_layout($greenville_embed_video); ?></div><?php
	}
}
?>