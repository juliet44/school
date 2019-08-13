<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0
 */

// Page (category, tag, archive, author) title

if ( greenville_need_page_title() ) {
	greenville_sc_layouts_showed('title', true);
	greenville_sc_layouts_showed('postmeta', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title">
						<?php
						// Post meta on the single post
						if ( is_single() )  {
							?><div class="sc_layouts_title_meta"><?php
								greenville_show_post_meta(array(
									'date' => true,
									'categories' => true,
									'seo' => true,
									'share' => false,
									'counters' => 'views,comments,likes'
									)
								);
							?></div><?php
						}
						
						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$greenville_blog_title = greenville_get_blog_title();
							$greenville_blog_title_text = $greenville_blog_title_class = $greenville_blog_title_link = $greenville_blog_title_link_text = '';
							if (is_array($greenville_blog_title)) {
								$greenville_blog_title_text = $greenville_blog_title['text'];
								$greenville_blog_title_class = !empty($greenville_blog_title['class']) ? ' '.$greenville_blog_title['class'] : '';
								$greenville_blog_title_link = !empty($greenville_blog_title['link']) ? $greenville_blog_title['link'] : '';
								$greenville_blog_title_link_text = !empty($greenville_blog_title['link_text']) ? $greenville_blog_title['link_text'] : '';
							} else
								$greenville_blog_title_text = $greenville_blog_title;
							?>
							<h1 class="sc_layouts_title_caption<?php echo esc_attr($greenville_blog_title_class); ?>"><?php
								$greenville_top_icon = greenville_get_category_icon();
								if (!empty($greenville_top_icon)) {
									$greenville_attr = greenville_getimagesize($greenville_top_icon);
                                    $alt = basename($greenville_top_icon);
                                    $alt = substr($alt,0,strlen($alt) - 4);
									?><img src="<?php echo esc_url($greenville_top_icon); ?>" alt="<?php echo esc_html($alt); ?>" <?php if (!empty($greenville_attr[3])) greenville_show_layout($greenville_attr[3]);?>><?php
								}
								echo wp_kses_data($greenville_blog_title_text);
							?></h1>
							<?php
							if (!empty($greenville_blog_title_link) && !empty($greenville_blog_title_link_text)) {
								?><a href="<?php echo esc_url($greenville_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($greenville_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'greenville_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>