<?php
/**
 * Setup theme-specific fonts and colors
 *
 * @package WordPress
 * @subpackage GREENVILLE
 * @since GREENVILLE 1.0.22
 */

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)
if ( !function_exists('greenville_customizer_theme_setup1') ) {
	add_action( 'after_setup_theme', 'greenville_customizer_theme_setup1', 1 );
	function greenville_customizer_theme_setup1() {
		
		// -----------------------------------------------------------------
		// -- Theme fonts (Google and/or custom fonts)
		// -----------------------------------------------------------------
		
		// Fonts to load when theme start
		// It can be Google fonts or uploaded fonts, placed in the folder /css/font-face/font-name inside the theme folder
		// Attention! Font's folder must have name equal to the font's name, with spaces replaced on the dash '-'
		// For example: font name 'TeX Gyre Termes', folder 'TeX-Gyre-Termes'
		greenville_storage_set('load_fonts', array(
			// Google font
            array(
                'name'	 => 'Fira Sans',
                'family' => 'sans-serif',
                'styles' => '400,400i,500,500i,600,600i'		// Parameter 'style' used only for the Google fonts
            ),
            array(
                'name'	 => 'Montserrat',
                'family' => 'sans-serif',
                'styles' => '300,600,700'		// Parameter 'style' used only for the Google fonts
            ),
            array(
                'name'	 => 'Courgette',
                'family' => 'cursive',
                'styles' => '400'		// Parameter 'style' used only for the Google fonts
            )

		));
		
		// Characters subset for the Google fonts. Available values are: latin,latin-ext,cyrillic,cyrillic-ext,greek,greek-ext,vietnamese
		greenville_storage_set('load_fonts_subset', 'latin,latin-ext');
		
		// Settings of the main tags
		greenville_storage_set('theme_fonts', array(
			'p' => array(
				'title'				=> esc_html__('Main text', 'greenville'),
				'description'		=> esc_html__('Font settings of the main text of the site', 'greenville'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '1rem',
				'font-weight'		=> '300',
				'font-style'		=> 'normal',
				'line-height'		=> '1.6em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0.056px',
				'margin-top'		=> '0em',
				'margin-bottom'		=> '1.6em'
				),
			'h1' => array(
				'title'				=> esc_html__('Heading 1', 'greenville'),
				'font-family'		=> 'Fira Sans, sans-serif',
				'font-size' 		=> '4.643rem',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '5.143rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '',
				'margin-top'		=> '1.57em',
				'margin-bottom'		=> '0.78em'
				),
			'h2' => array(
				'title'				=> esc_html__('Heading 2', 'greenville'),
				'font-family'		=> 'Fira Sans, sans-serif',
				'font-size' 		=> '3.429rem',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '3.929rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.8px',
				'margin-top'		=> '2.14em',
				'margin-bottom'		=> '0.84em'
				),
			'h3' => array(
				'title'				=> esc_html__('Heading 3', 'greenville'),
				'font-family'		=> 'Fira Sans, sans-serif',
				'font-size' 		=> '2.571rem',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '3.429rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-0.4px',
				'margin-top'		=> '2.9em',
				'margin-bottom'		=> '0.7879em'
				),
			'h4' => array(
				'title'				=> esc_html__('Heading 4', 'greenville'),
				'font-family'		=> 'Fira Sans, sans-serif',
				'font-size' 		=> '2.143rem',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '2.857rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '',
				'margin-top'		=> '3.54em',
				'margin-bottom'		=> '0.84em'
				),
			'h5' => array(
				'title'				=> esc_html__('Heading 5', 'greenville'),
				'font-family'		=> 'Fira Sans, sans-serif',
				'font-size' 		=> '1.857rem',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '2.143rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '-1.3px',
				'margin-top'		=> '4.15em',
				'margin-bottom'		=> '0.8em'
				),
			'h6' => array(
				'title'				=> esc_html__('Heading 6', 'greenville'),
				'font-family'		=> 'Fira Sans, sans-serif',
				'font-size' 		=> '1.2143em',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.714rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0.15px',
				'margin-top'		=> '2.3176em',
				'margin-bottom'		=> '1.1412em'
				),
			'logo' => array(
				'title'				=> esc_html__('Logo text', 'greenville'),
				'description'		=> esc_html__('Font settings of the text case of the logo', 'greenville'),
				'font-family'		=> 'Fira Sans, sans-serif',
				'font-size' 		=> '2.143rem',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.25em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'button' => array(
				'title'				=> esc_html__('Buttons', 'greenville'),
				'font-family'		=> 'Fira Sans, sans-serif',
				'font-size' 		=> '15px',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.571rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> ''
				),
			'input' => array(
				'title'				=> esc_html__('Input fields', 'greenville'),
				'description'		=> esc_html__('Font settings of the input fields, dropdowns and textareas', 'greenville'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '1em',
				'font-weight'		=> '400',
				'font-style'		=> 'normal',
				'line-height'		=> '1.2em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'none',
				'letter-spacing'	=> '0px'
				),
			'info' => array(
				'title'				=> esc_html__('Post meta', 'greenville'),
				'description'		=> esc_html__('Font settings of the post meta: date, counters, share, etc.', 'greenville'),
				'font-family'		=> 'Montserrat, sans-serif',
				'font-size' 		=> '14px',
				'font-weight'		=> '600',
				'font-style'		=> 'normal',
				'line-height'		=> '2.143rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px',
				'margin-top'		=> '0.4em',
				'margin-bottom'		=> ''
				),
			'menu' => array(
				'title'				=> esc_html__('Main menu', 'greenville'),
				'description'		=> esc_html__('Font settings of the main menu items', 'greenville'),
				'font-family'		=> 'Fira Sans, sans-serif',
				'font-size' 		=> '15px',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.571rem',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px'
				),
			'submenu' => array(
				'title'				=> esc_html__('Dropdown menu', 'greenville'),
				'description'		=> esc_html__('Font settings of the dropdown menu items', 'greenville'),
				'font-family'		=> 'Fira Sans, sans-serif',
				'font-size' 		=> '15px',
				'font-weight'		=> '500',
				'font-style'		=> 'normal',
				'line-height'		=> '1.5em',
				'text-decoration'	=> 'none',
				'text-transform'	=> 'uppercase',
				'letter-spacing'	=> '0px'
				)
		));
		
		
		// -----------------------------------------------------------------
		// -- Theme colors for customizer
		// -- Attention! Inner scheme must be last in the array below
		// -----------------------------------------------------------------
		greenville_storage_set('schemes', array(
		
			// Color scheme: 'default'
			'default' => array(
				'title'	 => esc_html__('Default', 'greenville'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'				=> '#ffffff',
					'bd_color'				=> '#d9d9d9',
		
					// Text and links colors
					'text'					=> '#5d646b',
					'text_light'			=> '#747c84',
					'text_dark'				=> '#3a3a3a',
					'text_link'				=> '#52b6bc',
					'text_hover'			=> '#ebc306',
		
					// Alternative blocks (submenu, buttons, tabs, etc.)
					'alter_bg_color'		=> '#f2f3f6',
					'alter_bg_hover'		=> '#3a5b5b',
					'alter_bd_color'		=> '#ffffff',
					'alter_bd_hover'		=> '#f2f3f6',
					'alter_text'			=> '#6f787f',
					'alter_light'			=> '#a4a9ae',
					'alter_dark'			=> '#4a545e',
					'alter_link'			=> '#41959a',
					'alter_hover'			=> '#d5b126',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'		=> '#f2f3f6',
					'input_bg_hover'		=> '#f2f3f6',
					'input_bd_color'		=> '#f2f3f6',
					'input_bd_hover'		=> '#ebc306',
					'input_text'			=> '#b7b7b7',
					'input_light'			=> '#e5e5e5',
					'input_dark'			=> '#1d1d1d',
					
					// Inverse blocks (text and links on accented bg)
					'inverse_text'			=> '#1d1d1d',
					'inverse_light'			=> '#333333',
					'inverse_dark'			=> '#000000',
					'inverse_link'			=> '#ffffff',
					'inverse_hover'			=> '#52b6bc',
		
					// Additional accented colors (if used in the current theme)
				
				)
			),
		
			// Color scheme: 'dark'
			'dark' => array(
				'title'  => esc_html__('Dark', 'greenville'),
				'colors' => array(
					
					// Whole block border and background
					'bg_color'				=> '#1f2024',
					'bd_color'				=> '#1c1b1f',
		
					// Text and links colors
					'text'					=> '#a7a7a7',
					'text_light'			=> '#5f5f5f',
					'text_dark'				=> '#ffffff',
					'text_link'				=> '#ebc306',
					'text_hover'			=> '#d5b126',
		
					// Alternative blocks (submenu, buttons, tabs, etc.)
					'alter_bg_color'		=> '#52b6bc',
					'alter_bg_hover'		=> '#f4f5f7',
					'alter_bd_color'		=> '#52b6bc',
					'alter_bd_hover'		=> '#1f2024',
					'alter_text'			=> '#a6a6a6',
					'alter_light'			=> '#5f5f5f',
					'alter_dark'			=> '#ffffff',
					'alter_link'			=> '#ffffff',
					'alter_hover'			=> '#ebc306',
		
					// Input fields (form's fields and textarea)
					'input_bg_color'		=> '#2e2d32',
					'input_bg_hover'		=> '#2e2d32',
					'input_bd_color'		=> '#2e2d32',
					'input_bd_hover'		=> '#d5b126',
					'input_text'			=> '#b7b7b7',
					'input_light'			=> '#5f5f5f',
					'input_dark'			=> '#2c2d30',
					
					// Inverse blocks (text and links on accented bg)
					'inverse_text'			=> '#1d1d1d',
					'inverse_light'			=> '#5f5f5f',
					'inverse_dark'			=> '#000000',
					'inverse_link'			=> '#ffffff',
					'inverse_hover'			=> '#52b6bc',
				
					// Additional accented colors (if used in the current theme)
		
				)
			)
		
		));
	}
}

			
// Additional (calculated) theme-specific colors
// Attention! Don't forget setup custom colors also in the theme.customizer.color-scheme.js
if (!function_exists('greenville_customizer_add_theme_colors')) {
	function greenville_customizer_add_theme_colors($colors) {
		if (substr($colors['text'], 0, 1) == '#') {
			$colors['bg_color_0']  = greenville_hex2rgba( $colors['bg_color'], 0 );
			$colors['bg_color_02']  = greenville_hex2rgba( $colors['bg_color'], 0.2 );
			$colors['bg_color_07']  = greenville_hex2rgba( $colors['bg_color'], 0.7 );
			$colors['bg_color_08']  = greenville_hex2rgba( $colors['bg_color'], 0.8 );
			$colors['bg_color_09']  = greenville_hex2rgba( $colors['bg_color'], 0.9 );
			$colors['alter_bg_color_07']  = greenville_hex2rgba( $colors['alter_bg_color'], 0.7 );
			$colors['alter_bg_color_04']  = greenville_hex2rgba( $colors['alter_bg_color'], 0.5 );
			$colors['alter_bg_color_02']  = greenville_hex2rgba( $colors['alter_bg_color'], 0.2 );
			$colors['alter_bd_color_02']  = greenville_hex2rgba( $colors['alter_bd_color'], 0.2 );
			$colors['alter_bg_hover_01']  = greenville_hex2rgba( $colors['alter_bg_hover'], 0.11 );
			$colors['alter_bd_color_09']  = greenville_hex2rgba( $colors['alter_bd_color'], 0.95 );
			$colors['text_dark_07']  = greenville_hex2rgba( $colors['text_dark'], 0.7 );
			$colors['text_link_02']  = greenville_hex2rgba( $colors['text_link'], 0.2 );
			$colors['text_link_07']  = greenville_hex2rgba( $colors['text_link'], 0.9 );
			$colors['text_link_blend'] = greenville_hsb2hex(greenville_hex2hsb( $colors['text_link'], 2, -5, 5 ));
			$colors['alter_link_blend'] = greenville_hsb2hex(greenville_hex2hsb( $colors['alter_link'], 2, -5, 5 ));
		} else {
			$colors['bg_color_0'] = '{{ data.bg_color_0 }}';
			$colors['bg_color_02'] = '{{ data.bg_color_02 }}';
			$colors['bg_color_07'] = '{{ data.bg_color_07 }}';
			$colors['bg_color_08'] = '{{ data.bg_color_08 }}';
			$colors['bg_color_09'] = '{{ data.bg_color_09 }}';
			$colors['alter_bg_color_07'] = '{{ data.alter_bg_color_07 }}';
			$colors['alter_bg_color_04'] = '{{ data.alter_bg_color_04 }}';
			$colors['alter_bg_color_02'] = '{{ data.alter_bg_color_02 }}';
			$colors['alter_bd_color_02'] = '{{ data.alter_bd_color_02 }}';
			$colors['alter_bg_hover_01'] = '{{ data.alter_bg_hover_01 }}';
			$colors['alter_bd_color_09'] = '{{ data.alter_bd_color_09 }}';
			$colors['text_dark_07'] = '{{ data.text_dark_07 }}';
			$colors['text_link_02'] = '{{ data.text_link_02 }}';
			$colors['text_link_07'] = '{{ data.text_link_07 }}';
			$colors['text_link_blend'] = '{{ data.text_link_blend }}';
			$colors['alter_link_blend'] = '{{ data.alter_link_blend }}';
		}
		return $colors;
	}
}


			
// Additional theme-specific fonts rules
// Attention! Don't forget setup fonts rules also in the theme.customizer.color-scheme.js
if (!function_exists('greenville_customizer_add_theme_fonts')) {
	function greenville_customizer_add_theme_fonts($fonts) {
		$rez = array();	
		foreach ($fonts as $tag => $font) {
			if (substr($font['font-family'], 0, 2) != '{{') {
				$rez[$tag.'_font-family'] 		= !empty($font['font-family']) && !greenville_is_inherit($font['font-family'])
														? 'font-family:' . trim($font['font-family']) . ';' 
														: '';
				$rez[$tag.'_font-size'] 		= !empty($font['font-size']) && !greenville_is_inherit($font['font-size'])
														? 'font-size:' . greenville_prepare_css_value($font['font-size']) . ";"
														: '';
				$rez[$tag.'_line-height'] 		= !empty($font['line-height']) && !greenville_is_inherit($font['line-height'])
														? 'line-height:' . trim($font['line-height']) . ";"
														: '';
				$rez[$tag.'_font-weight'] 		= !empty($font['font-weight']) && !greenville_is_inherit($font['font-weight'])
														? 'font-weight:' . trim($font['font-weight']) . ";"
														: '';
				$rez[$tag.'_font-style'] 		= !empty($font['font-style']) && !greenville_is_inherit($font['font-style'])
														? 'font-style:' . trim($font['font-style']) . ";"
														: '';
				$rez[$tag.'_text-decoration'] 	= !empty($font['text-decoration']) && !greenville_is_inherit($font['text-decoration'])
														? 'text-decoration:' . trim($font['text-decoration']) . ";"
														: '';
				$rez[$tag.'_text-transform'] 	= !empty($font['text-transform']) && !greenville_is_inherit($font['text-transform'])
														? 'text-transform:' . trim($font['text-transform']) . ";"
														: '';
				$rez[$tag.'_letter-spacing'] 	= !empty($font['letter-spacing']) && !greenville_is_inherit($font['letter-spacing'])
														? 'letter-spacing:' . trim($font['letter-spacing']) . ";"
														: '';
				$rez[$tag.'_margin-top'] 		= !empty($font['margin-top']) && !greenville_is_inherit($font['margin-top'])
														? 'margin-top:' . greenville_prepare_css_value($font['margin-top']) . ";"
														: '';
				$rez[$tag.'_margin-bottom'] 	= !empty($font['margin-bottom']) && !greenville_is_inherit($font['margin-bottom'])
														? 'margin-bottom:' . greenville_prepare_css_value($font['margin-bottom']) . ";"
														: '';
			} else {
				$rez[$tag.'_font-family']		= '{{ data["'.$tag.'_font-family"] }}';
				$rez[$tag.'_font-size']			= '{{ data["'.$tag.'_font-size"] }}';
				$rez[$tag.'_line-height']		= '{{ data["'.$tag.'_line-height"] }}';
				$rez[$tag.'_font-weight']		= '{{ data["'.$tag.'_font-weight"] }}';
				$rez[$tag.'_font-style']		= '{{ data["'.$tag.'_font-style"] }}';
				$rez[$tag.'_text-decoration']	= '{{ data["'.$tag.'_text-decoration"] }}';
				$rez[$tag.'_text-transform']	= '{{ data["'.$tag.'_text-transform"] }}';
				$rez[$tag.'_letter-spacing']	= '{{ data["'.$tag.'_letter-spacing"] }}';
				$rez[$tag.'_margin-top']		= '{{ data["'.$tag.'_margin-top"] }}';
				$rez[$tag.'_margin-bottom']		= '{{ data["'.$tag.'_margin-bottom"] }}';
			}
		}
		return $rez;
	}
}


//-------------------------------------------------------
//-- Thumb sizes
//-------------------------------------------------------

if ( !function_exists('greenville_customizer_theme_setup') ) {
	add_action( 'after_setup_theme', 'greenville_customizer_theme_setup' );
	function greenville_customizer_theme_setup() {

		// Enable support for Post Thumbnails
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size(370, 0, false);
		
		// Add thumb sizes
		// ATTENTION! If you change list below - check filter's names in the 'trx_addons_filter_get_thumb_size' hook
		$thumb_sizes = apply_filters('greenville_filter_add_thumb_sizes', array(
			'greenville-thumb-huge'		=> array(1170, 658, true),
			'greenville-thumb-big' 		=> array( 1540, 820, true),
			'greenville-thumb-med' 		=> array( 740, 400, true),
			'greenville-thumb-tiny' 		=> array(  90,  90, true),
			'greenville-thumb-service' 	=> array(  0,  400, true),
			'greenville-thumb-blogger' 	=> array(  0,  552, true),
			'greenville-thumb-team' 	    => array( 270,  270, true),
			'greenville-thumb-masonry-big' => array( 760,   0, false),		// Only downscale, not crop
			'greenville-thumb-masonry'		=> array( 370,   0, false),		// Only downscale, not crop
			)
		);
		$mult = greenville_get_theme_option('retina_ready', 1);
		if ($mult > 1) $GLOBALS['content_width'] = apply_filters( 'greenville_filter_content_width', 1170*$mult);
		foreach ($thumb_sizes as $k=>$v) {
			// Add Original dimensions
			add_image_size( $k, $v[0], $v[1], $v[2]);
			// Add Retina dimensions
			if ($mult > 1) add_image_size( $k.'-@retina', $v[0]*$mult, $v[1]*$mult, $v[2]);
		}

	}
}

if ( !function_exists('greenville_customizer_image_sizes') ) {
	add_filter( 'image_size_names_choose', 'greenville_customizer_image_sizes' );
	function greenville_customizer_image_sizes( $sizes ) {
		$thumb_sizes = apply_filters('greenville_filter_add_thumb_sizes', array(
			'greenville-thumb-huge'		=> esc_html__( 'Fullsize image', 'greenville' ),
			'greenville-thumb-big'			=> esc_html__( 'Large image', 'greenville' ),
			'greenville-thumb-med'			=> esc_html__( 'Medium image', 'greenville' ),
			'greenville-thumb-tiny'		=> esc_html__( 'Small square avatar', 'greenville' ),
			'greenville-thumb-masonry-big'	=> esc_html__( 'Masonry Large (scaled)', 'greenville' ),
			'greenville-thumb-masonry'		=> esc_html__( 'Masonry (scaled)', 'greenville' ),
			)
		);
		$mult = greenville_get_theme_option('retina_ready', 1);
		foreach($thumb_sizes as $k=>$v) {
			$sizes[$k] = $v;
			if ($mult > 1) $sizes[$k.'-@retina'] = $v.' '.esc_html__('@2x', 'greenville' );
		}
		return $sizes;
	}
}

// Remove some thumb-sizes from the ThemeREX Addons list
if ( !function_exists( 'greenville_customizer_trx_addons_add_thumb_sizes' ) ) {
	add_filter( 'trx_addons_filter_add_thumb_sizes', 'greenville_customizer_trx_addons_add_thumb_sizes');
	function greenville_customizer_trx_addons_add_thumb_sizes($list=array()) {
		if (is_array($list)) {
			foreach ($list as $k=>$v) {
				if (in_array($k, array(
								'trx_addons-thumb-huge',
								'trx_addons-thumb-big',
								'trx_addons-thumb-medium',
								'trx_addons-thumb-tiny',
								'trx_addons-thumb-masonry-big',
								'trx_addons-thumb-masonry',
								)
							)
						) unset($list[$k]);
			}
		}
		return $list;
	}
}

// and replace removed styles with theme-specific thumb size
if ( !function_exists( 'greenville_customizer_trx_addons_get_thumb_size' ) ) {
	add_filter( 'trx_addons_filter_get_thumb_size', 'greenville_customizer_trx_addons_get_thumb_size');
	function greenville_customizer_trx_addons_get_thumb_size($thumb_size='') {
		return str_replace(array(
							'trx_addons-thumb-huge',
							'trx_addons-thumb-huge-@retina',
							'trx_addons-thumb-big',
							'trx_addons-thumb-big-@retina',
							'trx_addons-thumb-medium',
							'trx_addons-thumb-medium-@retina',
							'trx_addons-thumb-tiny',
							'trx_addons-thumb-tiny-@retina',
							'trx_addons-thumb-service',
							'trx_addons-thumb-service-@retina',
							'trx_addons-thumb-blogger',
							'trx_addons-thumb-blogger-@retina',
							'trx_addons-thumb-team',
							'trx_addons-thumb-team-@retina',
							'trx_addons-thumb-masonry-big',
							'trx_addons-thumb-masonry-big-@retina',
							'trx_addons-thumb-masonry',
							'trx_addons-thumb-masonry-@retina',
							),
							array(
							'greenville-thumb-huge',
							'greenville-thumb-huge-@retina',
							'greenville-thumb-big',
							'greenville-thumb-big-@retina',
							'greenville-thumb-med',
							'greenville-thumb-med-@retina',
							'greenville-thumb-tiny',
							'greenville-thumb-tiny-@retina',
							'greenville-thumb-service',
							'greenville-thumb-service-@retina',
							'greenville-thumb-blogger',
							'greenville-thumb-blogger-@retina',
							'greenville-thumb-team',
							'greenville-thumb-team-@retina',
							'greenville-thumb-masonry-big',
							'greenville-thumb-masonry-big-@retina',
							'greenville-thumb-masonry',
							'greenville-thumb-masonry-@retina',
							),
							$thumb_size);
	}
}
?>