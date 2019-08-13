<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0
 */

greenville_storage_set('blog_archive', true);

// Load scripts for both 'Gallery' and 'Portfolio' layouts!
wp_enqueue_script( 'classie', greenville_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
wp_enqueue_script( 'imagesloaded', greenville_get_file_url('js/theme.gallery/imagesloaded.min.js'), array(), null, true );
wp_enqueue_script( 'masonry', greenville_get_file_url('js/theme.gallery/masonry.min.js'), array(), null, true );
wp_enqueue_script( 'greenville-gallery-script', greenville_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$greenville_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$greenville_sticky_out = is_array($greenville_stickies) && count($greenville_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$greenville_cat = greenville_get_theme_option('parent_cat');
	$greenville_post_type = greenville_get_theme_option('post_type');
	$greenville_taxonomy = greenville_get_post_type_taxonomy($greenville_post_type);
	$greenville_show_filters = greenville_get_theme_option('show_filters');
	$greenville_tabs = array();
	if (!greenville_is_off($greenville_show_filters)) {
		$greenville_args = array(
			'type'			=> $greenville_post_type,
			'child_of'		=> $greenville_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $greenville_taxonomy,
			'pad_counts'	=> false
		);
		$greenville_portfolio_list = get_terms($greenville_args);
		if (is_array($greenville_portfolio_list) && count($greenville_portfolio_list) > 0) {
			$greenville_tabs[$greenville_cat] = esc_html__('All', 'greenville');
			foreach ($greenville_portfolio_list as $greenville_term) {
				if (isset($greenville_term->term_id)) $greenville_tabs[$greenville_term->term_id] = $greenville_term->name;
			}
		}
	}
	if (count($greenville_tabs) > 0) {
		$greenville_portfolio_filters_ajax = true;
		$greenville_portfolio_filters_active = $greenville_cat;
		$greenville_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters greenville_tabs greenville_tabs_ajax">
			<ul class="portfolio_titles greenville_tabs_titles">
				<?php
				foreach ($greenville_tabs as $greenville_id=>$greenville_title) {
					?><li><a href="<?php echo esc_url(greenville_get_hash_link(sprintf('#%s_%s_content', $greenville_portfolio_filters_id, $greenville_id))); ?>" data-tab="<?php echo esc_attr($greenville_id); ?>"><?php echo esc_html($greenville_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$greenville_ppp = greenville_get_theme_option('posts_per_page');
			if (greenville_is_inherit($greenville_ppp)) $greenville_ppp = '';
			foreach ($greenville_tabs as $greenville_id=>$greenville_title) {
				$greenville_portfolio_need_content = $greenville_id==$greenville_portfolio_filters_active || !$greenville_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $greenville_portfolio_filters_id, $greenville_id)); ?>"
					class="portfolio_content greenville_tabs_content"
					data-blog-template="<?php echo esc_attr(greenville_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(greenville_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($greenville_ppp); ?>"
					data-post-type="<?php echo esc_attr($greenville_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($greenville_taxonomy); ?>"
					data-cat="<?php echo esc_attr($greenville_id); ?>"
					data-parent-cat="<?php echo esc_attr($greenville_cat); ?>"
					data-need-content="<?php echo (false===$greenville_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($greenville_portfolio_need_content) 
						greenville_show_portfolio_posts(array(
							'cat' => $greenville_id,
							'parent_cat' => $greenville_cat,
							'taxonomy' => $greenville_taxonomy,
							'post_type' => $greenville_post_type,
							'page' => 1,
							'sticky' => $greenville_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		greenville_show_portfolio_posts(array(
			'cat' => $greenville_cat,
			'parent_cat' => $greenville_cat,
			'taxonomy' => $greenville_taxonomy,
			'post_type' => $greenville_post_type,
			'page' => 1,
			'sticky' => $greenville_sticky_out
			)
		);
	}

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>