<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0
 */

$greenville_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$greenville_post_format = get_post_format();
$greenville_post_format = empty($greenville_post_format) ? 'standard' : str_replace('post-format-', '', $greenville_post_format);
$greenville_full_content = greenville_get_theme_option('blog_content') != 'excerpt' || in_array($greenville_post_format, array('link', 'aside', 'status', 'quote'));
$greenville_animation = greenville_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($greenville_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($greenville_post_format) ); ?>
	<?php echo (!greenville_is_off($greenville_animation) ? ' data-animation="'.esc_attr(greenville_get_animation_classes($greenville_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	greenville_show_post_featured(array(
		'thumb_size' => greenville_get_thumb_size($greenville_columns==1 ? 'big' : ($greenville_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($greenville_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post meta
            greenville_show_post_meta(array(
                    'categories' => false,
                    'date' => true,
                    'edit' => false,
                    'seo' => false,
                    'share' => false,
                    'author' => true,
                    'counters' => 'comments'	//comments,likes,views - comma separated in any combination
                )
            );
			// Post title
			the_title( sprintf( '<h2 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
		<?php


		// Post content
		?><div class="post_content entry-content"><?php
			if ($greenville_full_content) {
				// Post content area
				?><div class="post_content_inner"><?php
				the_content( '' );
				?></div><?php
				// Inner pages
				wp_link_pages( array(
					'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'greenville' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
					'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'greenville' ) . ' </span>%',
					'separator'   => '<span class="screen-reader-text">, </span>',
				) );

			} else {

				$greenville_show_learn_more = !in_array($greenville_post_format, array('link', 'aside', 'status', 'quote'));

				// Post content area
				?><div class="post_content_inner"><?php
				if (has_excerpt()) {
					the_excerpt();
				} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
					the_content( '' );
				} else if (in_array($greenville_post_format, array('link', 'aside', 'status', 'quote'))) {
					the_content();
				} else if (substr(get_the_content(), 0, 1)!='[') {
					the_excerpt();
				}
				?></div><?php
				// More button
				if ( $greenville_show_learn_more ) {
					?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Keep reading', 'greenville'); ?></a></p><?php
				}

			}
			?></div><!-- .entry-content -->
</article></div>