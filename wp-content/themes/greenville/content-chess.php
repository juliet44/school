<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0
 */

$greenville_blog_style = explode('_', greenville_get_theme_option('blog_style'));
$greenville_columns = empty($greenville_blog_style[1]) ? 1 : max(1, $greenville_blog_style[1]);
$greenville_expanded = !greenville_sidebar_present() && greenville_is_on(greenville_get_theme_option('expand_content'));
$greenville_post_format = get_post_format();
$greenville_post_format = empty($greenville_post_format) ? 'standard' : str_replace('post-format-', '', $greenville_post_format);
$greenville_animation = greenville_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($greenville_columns).' post_format_'.esc_attr($greenville_post_format) ); ?>
	<?php echo (!greenville_is_off($greenville_animation) ? ' data-animation="'.esc_attr(greenville_get_animation_classes($greenville_animation)).'"' : ''); ?>
	>

	<?php
	// Add anchor
	if ($greenville_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'"]');
	}

	// Featured image
	greenville_show_post_featured( array(
											'class' => $greenville_columns == 1 ? 'trx-stretch-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => greenville_get_thumb_size(
																	strpos(greenville_get_theme_option('body_style'), 'full')!==false
																		? ( $greenville_columns > 1 ? 'huge' : 'original' )
																		: (	$greenville_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 

			
			do_action('greenville_action_before_post_meta');

			// Post meta
			$greenville_post_meta = greenville_show_post_meta(array(
                    'categories' => false,
                    'date' => true,
                    'edit' => false,
                    'seo' => false,
                    'share' => false,
                    'author' => true,
                    'counters' => 'comments'	//comments,likes,views - comma separated in any combination
                )
            );
			greenville_show_layout($greenville_post_meta);

				do_action('greenville_action_before_post_title');

				// Post title
				the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$greenville_show_learn_more = !in_array($greenville_post_format, array('link', 'aside', 'status', 'quote'));
				if (has_excerpt()) {
					the_excerpt();
				} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
					the_content( '' );
				} else if (in_array($greenville_post_format, array('link', 'aside', 'status', 'quote'))) {
					the_content();
				} else if (substr(get_the_content(), 0, 1)!='[') {
					the_excerpt();
				}
				?>
			</div>
			<?php
			// Post meta
			if (in_array($greenville_post_format, array('link', 'aside', 'status', 'quote'))) {
				greenville_show_layout($greenville_post_meta);
			}
			// More button
			if ( $greenville_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Keep reading', 'greenville'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>