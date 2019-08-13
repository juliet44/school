<?php
/**
 * The template to display blog archive
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0
 */

/*
Template Name: Blog archive
*/

/**
 * Make page with this template and put it into menu
 * to display posts as blog archive
 * You can setup output parameters (blog style, posts per page, parent category, etc.)
 * in the Theme Options section (under the page content)
 * You can build this page in the Visual Composer to make custom page layout:
 * just insert %%CONTENT%% in the desired place of content
 */

// Get template page's content
$greenville_content = '';
$greenville_blog_archive_mask = '%%CONTENT%%';
$greenville_blog_archive_subst = sprintf('<div class="blog_archive">%s</div>', $greenville_blog_archive_mask);
if ( have_posts() ) {
	the_post(); 
	if (($greenville_content = apply_filters('the_content', get_the_content())) != '') {
		if (($greenville_pos = strpos($greenville_content, $greenville_blog_archive_mask)) !== false) {
			$greenville_content = preg_replace('/(\<p\>\s*)?'.$greenville_blog_archive_mask.'(\s*\<\/p\>)/i', $greenville_blog_archive_subst, $greenville_content);
		} else
			$greenville_content .= $greenville_blog_archive_subst;
		$greenville_content = explode($greenville_blog_archive_mask, $greenville_content);
		// Add VC custom styles to the inline CSS
		$vc_custom_css = get_post_meta( get_the_ID(), '_wpb_shortcodes_custom_css', true );
		if ( !empty( $vc_custom_css ) ) greenville_add_inline_css(strip_tags($vc_custom_css));
	}
}

// Prepare args for a new query
$greenville_args = array(
	'post_status' => current_user_can('read_private_pages') && current_user_can('read_private_posts') ? array('publish', 'private') : 'publish'
);
$greenville_args = greenville_query_add_posts_and_cats($greenville_args, '', greenville_get_theme_option('post_type'), greenville_get_theme_option('parent_cat'));
$greenville_page_number = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
if ($greenville_page_number > 1) {
	$greenville_args['paged'] = $greenville_page_number;
	$greenville_args['ignore_sticky_posts'] = true;
}
$greenville_ppp = greenville_get_theme_option('posts_per_page');
if ((int) $greenville_ppp != 0)
	$greenville_args['posts_per_page'] = (int) $greenville_ppp;
// Make a new query
query_posts( $greenville_args );
// Set a new query as main WP Query
$GLOBALS['wp_the_query'] = $GLOBALS['wp_query'];

// Set query vars in the new query!
if (is_array($greenville_content) && count($greenville_content) == 2) {
	set_query_var('blog_archive_start', $greenville_content[0]);
	set_query_var('blog_archive_end', $greenville_content[1]);
}

get_template_part('index');
?>