<?php
/**
 * Theme lists
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }



// Return numbers range
if ( !function_exists( 'greenville_get_list_range' ) ) {
	function greenville_get_list_range($from=1, $to=2, $prepend_inherit=false) {
		$list = array();
		for ($i=$from; $i<=$to; $i++)
			$list[$i] = $i;
		return $prepend_inherit ? greenville_array_merge(array('inherit' => esc_html__("Inherit", 'greenville')), $list) : $list;
	}
}



// Return styles list
if ( !function_exists( 'greenville_get_list_styles' ) ) {
	function greenville_get_list_styles($from=1, $to=2, $prepend_inherit=false) {
		$list = array();
		for ($i=$from; $i<=$to; $i++)
			$list[$i] = sprintf(esc_html__('Style %d', 'greenville'), $i);
		return $prepend_inherit ? greenville_array_merge(array('inherit' => esc_html__("Inherit", 'greenville')), $list) : $list;
	}
}

// Return list with 'Yes' and 'No' items
if ( !function_exists( 'greenville_get_list_yesno' ) ) {
	function greenville_get_list_yesno($prepend_inherit=false) {
		$list = array(
			"yes"	=> esc_html__("Yes", 'greenville'),
			"no"	=> esc_html__("No", 'greenville')
		);
		return $prepend_inherit ? greenville_array_merge(array('inherit' => esc_html__("Inherit", 'greenville')), $list) : $list;
	}
}

// Return list with 'On' and 'Of' items
if ( !function_exists( 'greenville_get_list_onoff' ) ) {
	function greenville_get_list_onoff($prepend_inherit=false) {
		$list = array(
			"on"	=> esc_html__("On", 'greenville'),
			"off"	=> esc_html__("Off", 'greenville')
		);
		return $prepend_inherit ? greenville_array_merge(array('inherit' => esc_html__("Inherit", 'greenville')), $list) : $list;
	}
}

// Return list with 'Show' and 'Hide' items
if ( !function_exists( 'greenville_get_list_showhide' ) ) {
	function greenville_get_list_showhide($prepend_inherit=false) {
		$list = array(
			"show" => esc_html__("Show", 'greenville'),
			"hide" => esc_html__("Hide", 'greenville')
		);
		return $prepend_inherit ? greenville_array_merge(array('inherit' => esc_html__("Inherit", 'greenville')), $list) : $list;
	}
}

// Return list with 'Horizontal' and 'Vertical' items
if ( !function_exists( 'greenville_get_list_directions' ) ) {
	function greenville_get_list_directions($prepend_inherit=false) {
		$list = array(
			"horizontal" => esc_html__("Horizontal", 'greenville'),
			"vertical"   => esc_html__("Vertical", 'greenville')
		);
		return $prepend_inherit ? greenville_array_merge(array('inherit' => esc_html__("Inherit", 'greenville')), $list) : $list;
	}
}

// Return custom sidebars list, prepended inherit and main sidebars item (if need)
if ( !function_exists( 'greenville_get_list_sidebars' ) ) {
	function greenville_get_list_sidebars($prepend_inherit=false, $add_hide=false) {
		if (($list = greenville_storage_get('list_sidebars'))=='') {
			global $wp_registered_sidebars;
			$list = array();
			if (is_array($wp_registered_sidebars)) {
				foreach ( $wp_registered_sidebars as $k => $v ) {
					$list[$v['id']] = $v['name'];
				}
			}
			greenville_storage_set('list_sidebars', $list);
		}
		if ($add_hide) $list = greenville_array_merge(array('hide' => esc_html__("- Select widgets -", 'greenville')), $list);
		return $prepend_inherit ? greenville_array_merge(array('inherit' => esc_html__("Inherit", 'greenville')), $list) : $list;
	}
}

// Return sidebars positions
if ( !function_exists( 'greenville_get_list_sidebars_positions' ) ) {
	function greenville_get_list_sidebars_positions($prepend_inherit=false) {
		$list = array(
			'left'  => esc_html__('Left',  'greenville'),
			'right' => esc_html__('Right', 'greenville')
		);
		return $prepend_inherit ? greenville_array_merge(array('inherit' => esc_html__("Inherit", 'greenville')), $list) : $list;
	}
}

// Return header styles
if ( !function_exists( 'greenville_get_list_header_styles' ) ) {
	function greenville_get_list_header_styles($prepend_inherit=false) {
		static $list = false;
		if (!$list) {
			$list = apply_filters('greenville_filter_list_header_styles', array(
																		'header-default' => esc_html__('Default Header', 'greenville')
																		)
								);
		}
		return $prepend_inherit ? greenville_array_merge(array('inherit' => esc_html__("Inherit", 'greenville')), $list) : $list;
	}
}

// Return header positions
if ( !function_exists( 'greenville_get_list_header_positions' ) ) {
	function greenville_get_list_header_positions($prepend_inherit=false) {
		$list = array(
			'default' => esc_html__('Default','greenville'),
			'over' => esc_html__('Over',	'greenville'),
			'under' => esc_html__('Under',	'greenville')
		);
		return $prepend_inherit ? greenville_array_merge(array('inherit' => esc_html__("Inherit", 'greenville')), $list) : $list;
	}
}

// Return footer styles
if ( !function_exists( 'greenville_get_list_footer_styles' ) ) {
	function greenville_get_list_footer_styles($prepend_inherit=false) {
		static $list = false;
		if (!$list) {
			$list = apply_filters('greenville_filter_list_footer_styles', array(
																		'footer-default' => esc_html__('Default Footer', 'greenville')
																		)
								);
		}
		return $prepend_inherit ? greenville_array_merge(array('inherit' => esc_html__("Inherit", 'greenville')), $list) : $list;
	}
}

// Return blog styles list, prepended inherit
if ( !function_exists( 'greenville_get_list_blog_styles' ) ) {
	function greenville_get_list_blog_styles($prepend_inherit=false) {
		$list = apply_filters('greenville_filter_list_blog_styles', array(
			'excerpt'	=> esc_html__('Excerpt','greenville'),
			'classic_2'	=> esc_html__('Classic /2 columns/',	'greenville'),
			'classic_3'	=> esc_html__('Classic /3 columns/',	'greenville'),
			'masonry_2'	=> esc_html__('Masonry /2 columns/',	'greenville'),
			'masonry_3'	=> esc_html__('Masonry /3 columns/',	'greenville'),
			'portfolio_2' => esc_html__('Portfolio /2 columns/','greenville'),
			'portfolio_3' => esc_html__('Portfolio /3 columns/','greenville'),
			'portfolio_4' => esc_html__('Portfolio /4 columns/','greenville'),
			'gallery_2' => esc_html__('Gallery /2 columns/',	'greenville'),
			'gallery_3' => esc_html__('Gallery /3 columns/',	'greenville'),
			'gallery_4' => esc_html__('Gallery /4 columns/',	'greenville'),
			'chess_1'	=> esc_html__('Chess /2 column/',		'greenville'),
			'chess_2'	=> esc_html__('Chess /4 columns/',		'greenville'),
			'chess_3'	=> esc_html__('Chess /6 columns/',		'greenville')
			)
		);
		return $prepend_inherit ? greenville_array_merge(array('inherit' => esc_html__("Inherit", 'greenville')), $list) : $list;
	}
}


// Return list of categories
if ( !function_exists( 'greenville_get_list_categories' ) ) {
	function greenville_get_list_categories($prepend_inherit=false) {
		if (($list = greenville_storage_get('list_categories'))=='') {
			$list = array();
			$taxonomies = get_categories( array(
											'type' => 'post',
											'orderby' => 'name',
											'order' => 'ASC',
											'hide_empty' => 0,
											'hierarchical' => 1,
											'taxonomy' => 'category',
											'pad_counts' => false
											)
										);
			if (is_array($taxonomies) && count($taxonomies) > 0) {
				foreach ($taxonomies as $cat) {
					$list[$cat->term_id] = $cat->name;
				}
			}
			greenville_storage_set('list_categories', $list);
		}
		return $prepend_inherit ? greenville_array_merge(array('inherit' => esc_html__("Inherit", 'greenville')), $list) : $list;
	}
}


// Return list of taxonomies
if ( !function_exists( 'greenville_get_list_terms' ) ) {
	function greenville_get_list_terms($prepend_inherit=false, $taxonomy='category') {
		if (($list = greenville_storage_get('list_taxonomies_'.($taxonomy)))=='') {
			$list = array();
			$taxonomies = get_terms( $taxonomy, array(
													'orderby' => 'name',
													'order' => 'ASC',
													'hide_empty' => 0,
													'hierarchical' => 1,
													'taxonomy' => $taxonomy,
													'pad_counts' => false 
													)
									);
			if (is_array($taxonomies) && count($taxonomies) > 0) {
				foreach ($taxonomies as $cat) {
					$list[$cat->term_id] = $cat->name;
				}
			}
			greenville_storage_set('list_taxonomies_'.($taxonomy), $list);
		}
		return $prepend_inherit ? greenville_array_merge(array('inherit' => esc_html__("Inherit", 'greenville')), $list) : $list;
	}
}

// Return list of post's types
if ( !function_exists( 'greenville_get_list_posts_types' ) ) {
	function greenville_get_list_posts_types($prepend_inherit=false) {
		if (($list = greenville_storage_get('list_posts_types'))=='') {
			$list = apply_filters('greenville_filter_list_posts_types', array(
				'post' => esc_html('Post', 'greenville')
			));
			greenville_storage_set('list_posts_types', $list);
		}
		return $prepend_inherit ? greenville_array_merge(array('inherit' => esc_html__("Inherit", 'greenville')), $list) : $list;
	}
}


// Return list post items from any post type and taxonomy
if ( !function_exists( 'greenville_get_list_posts' ) ) {
	function greenville_get_list_posts($prepend_inherit=false, $opt=array()) {
		$opt = array_merge(array(
			'post_type'			=> 'post',
			'post_status'		=> 'publish',
			'post_parent'		=> '',
			'taxonomy'			=> 'category',
			'taxonomy_value'	=> '',
			'meta_key'			=> '',
			'meta_value'		=> '',
			'meta_compare'		=> '',
			'posts_per_page'	=> -1,
			'orderby'			=> 'post_date',
			'order'				=> 'desc',
			'not_selected'		=> true,
			'return'			=> 'id'
			), is_array($opt) ? $opt : array('post_type'=>$opt));

		$hash = 'list_posts'
				. '_' . (is_array($opt['post_type']) ? join('_', $opt['post_type']) : $opt['post_type'])
				. '_' . (is_array($opt['post_parent']) ? join('_', $opt['post_parent']) : $opt['post_parent'])
				. '_' . ($opt['taxonomy'])
				. '_' . (is_array($opt['taxonomy_value']) ? join('_', $opt['taxonomy_value']) : $opt['taxonomy_value'])
				. '_' . ($opt['meta_key'])
				. '_' . ($opt['meta_compare'])
				. '_' . ($opt['meta_value'])
				. '_' . ($opt['orderby'])
				. '_' . ($opt['order'])
				. '_' . ($opt['return'])
				. '_' . ($opt['posts_per_page']);
		if (($list = greenville_storage_get($hash))=='') {
			$list = array();
			if ($opt['not_selected']!==false) $list['none'] = $opt['not_selected']===true 
																				? esc_html__("- Not selected -", 'greenville')
																				: $opt['not_selected'];
			$args = array(
				'post_type' => $opt['post_type'],
				'post_status' => $opt['post_status'],
				'posts_per_page' => $opt['posts_per_page'],
				'ignore_sticky_posts' => true,
				'orderby'	=> $opt['orderby'],
				'order'		=> $opt['order']
			);
			if (!empty($opt['post_parent'])) {
				if (is_array($opt['post_parent']))
					$args['post_parent__in'] = $opt['post_parent'];
				else
					$args['post_parent'] = $opt['post_parent'];
			}
			if (!empty($opt['taxonomy_value'])) {
				$args['tax_query'] = array(
					array(
						'taxonomy' => $opt['taxonomy'],
						'field' => is_array($opt['taxonomy_value']) 
										? ((int) $opt['taxonomy_value'][0] > 0  ? 'term_taxonomy_id' : 'slug')
										: ((int) $opt['taxonomy_value'] > 0  ? 'term_taxonomy_id' : 'slug'),
						'terms' => is_array($opt['taxonomy_value'])
										? $opt['taxonomy_value'] 
										: ((int) $opt['taxonomy_value'] > 0 ? (int) $opt['taxonomy_value'] : $opt['taxonomy_value'] ) 
					)
				);
			}
			if (!empty($opt['meta_key'])) {
				$args['meta_key'] = $opt['meta_key'];
			}
			if (!empty($opt['meta_value'])) {
				$args['meta_value'] = $opt['meta_value'];
			}
			if (!empty($opt['meta_compare'])) {
				$args['meta_compare'] = $opt['meta_compare'];
			}
			$posts = get_posts( $args );
			if (is_array($posts) && count($posts) > 0) {
				foreach ($posts as $post) {
					$list[$opt['return']=='id' ? $post->ID : $post->post_title] = $post->post_title;
				}
			}
			greenville_storage_set($hash, $list);
		}
		return $prepend_inherit ? greenville_array_merge(array('inherit' => esc_html__("Inherit", 'greenville')), $list) : $list;
	}
}


// Return list of registered users
if ( !function_exists( 'greenville_get_list_users' ) ) {
	function greenville_get_list_users($prepend_inherit=false, $roles=array('administrator', 'editor', 'author', 'contributor', 'shop_manager')) {
		if (($list = greenville_storage_get('list_users'))=='') {
			$list = array();
			$list['none'] = esc_html__("- Not selected -", 'greenville');
			$users = get_users( array(
									'orderby' => 'display_name',
									'order' => 'ASC'
									)
								);
			if (is_array($users) && count($users) > 0) {
				foreach ($users as $user) {
					$accept = true;
					if (is_array($user->roles)) {
						if (is_array($user->roles) && count($user->roles) > 0) {
							$accept = false;
							foreach ($user->roles as $role) {
								if (in_array($role, $roles)) {
									$accept = true;
									break;
								}
							}
						}
					}
					if ($accept) $list[$user->user_login] = $user->display_name;
				}
			}
			greenville_storage_set('list_users', $list);
		}
		return $prepend_inherit ? greenville_array_merge(array('inherit' => esc_html__("Inherit", 'greenville')), $list) : $list;
	}
}

// Return menus list, prepended inherit
if ( !function_exists( 'greenville_get_list_menus' ) ) {
	function greenville_get_list_menus($prepend_inherit=false) {
		if (($list = greenville_storage_get('list_menus'))=='') {
			$list = array();
			$list['default'] = esc_html__("Default", 'greenville');
			$menus = wp_get_nav_menus();
			if (is_array($menus) && count($menus) > 0) {
				foreach ($menus as $menu) {
					$list[$menu->slug] = $menu->name;
				}
			}
			greenville_storage_set('list_menus', $list);
		}
		return $prepend_inherit ? greenville_array_merge(array('inherit' => esc_html__("Inherit", 'greenville')), $list) : $list;
	}
}

// Return iconed classes list
if ( !function_exists( 'greenville_get_list_icons' ) ) {
	function greenville_get_list_icons($prepend_inherit=false) {
		static $list = false;
		if (!is_array($list)) 
			$list = !is_admin() ? array() : greenville_parse_icons_classes(greenville_get_file_dir("css/fontello/css/fontello-codes.css"));
		return $prepend_inherit ? greenville_array_merge(array('inherit' => esc_html__("Inherit", 'greenville')), $list) : $list;
	}
}
?>