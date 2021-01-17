<?php
/**
* The Theme Option Functions page
*
* This page is implemented using the Settings API.
*
* @package  framework
* @file     option_functions.php
* @author   makecodework [Oleg Poruchenko]
* @link    [makecodeworkr@gmail.com]
*/

$options = get_option( 'mcw_options' );

/*
 * ==================
 * Set custom favicon.
 * ==================
*/
function mcw_custom_favicon() {
	$options = get_option('mcw_options');
	$favicon_url = $options['mcw_favicon'];

	if (!empty($favicon_url)) {
		echo '<link rel="shortcut icon" href="'. $favicon_url. '" />'. "\n";
	}
}
add_action('wp_head', 'mcw_custom_favicon');

/*
 * ==================
 * Set apple touch icon.
 * ==================
*/
function mcw_apple_touch() {
	$options = get_option('mcw_options');
	$apple_touch = $options['mcw_apple_touch'];

	if (!empty($apple_touch)) {
		echo '<link rel="apple-touch-icon" href="'. $apple_touch. '" />	'. "\n";
	}
}
add_action('wp_head', 'mcw_apple_touch');
/*
 * ==================
 * Set apple touch icon.
 * ==================
*/
function mcw_seo_options() {
	global $post;

	$options = get_option( 'mcw_options' );

	$mcw_meta_title         = $options['mcw_homepage_title'];
	$mcw_meta_description   = $options['mcw_meta_description'];
	$mcw_meta_keywords      = $options['mcw_meta_keywords'];

	if ( !empty($mcw_meta_title) ){
		echo '<meta name="title" content="'. $mcw_meta_title .'"  />' . "\n";
	}

	if ( !empty($mcw_meta_description) ){
		echo '<meta name="description" content=" '. $mcw_meta_description .'"  />' . "\n";
	}

	if ( !empty($mcw_meta_keywords) ){
		echo '<meta name="keywords" content=" '. $mcw_meta_keywords .'"  />' . "\n";
	}
}
add_action( 'wp_head', 'mcw_seo_options' );

function mcw_get_rgb_color($color){

	if ( $color[0] == '#' ) {
		$color = substr( $color, 1 );
	}
	if ( strlen( $color ) == 6 ) {
		list( $r, $g, $b ) = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
	} elseif ( strlen( $color ) == 3 ) {
		list( $r, $g, $b ) = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
	} else {
		return false;
	}

	$r = hexdec( $r );
	$g = hexdec( $g );
	$b = hexdec( $b );


	$rgb =$r.','.$g.','.$b;
	return $rgb;
}
/*
 * ==================
 * Set custom CSS styles
 * ==================
*/
function mcw_custom_styles(){
	$options = get_option( 'mcw_options' );
	$mcw_custom_style = '';
	wp_enqueue_style( 'style', get_template_directory_uri().'style.css' );
	$mcw_bg_color_sofa     = $options['mcw_bg_color_sofa'];
	$mcw_bg_color_carpet   = $options['mcw_bg_color_carpet'];
	$mcw_bg_color_mattress = $options['mcw_bg_color_mattress'];  
	
	$mcw_text_color_sofa = $options['mcw_text_color_sofa'];
	$mcw_text_carpet 	 = $options['mcw_text_color_carpet'];
	$mcw_text_mattress 	 = $options['mcw_text_color_mattress'];

	if( !empty( $mcw_bg_color_sofa ) || !empty( $mcw_text_color_sofa )) {
		$mcw_custom_style .= ".sofa {\n background-color: $mcw_bg_color_sofa;\n}\n\n";
		$mcw_custom_style .= ".sofa a, .sofa h1, .sofa p {\n color: $mcw_text_color_sofa;\n}\n\n";
		$mcw_custom_style .= ".carpet {\n background-color: $mcw_bg_color_carpet;\n}\n\n";
		$mcw_custom_style .= ".carpet h1, .carpet p.link-more, .carpet span,
								.carpet .block-content p {\n color: $mcw_text_carpet;\n}\n\n";
		$mcw_custom_style .= ".mattress {\n background-color: $mcw_bg_color_mattress;\n}\n\n";
		$mcw_custom_style .= ".mattress a, .mattress h1, .mattress p,
								.sofa a, .sofa h1, .sofa p {\n color: $mcw_text_mattress;\n}\n\n";
	}
		wp_add_inline_style( 'style', $mcw_custom_style );
}
add_action( 'wp_enqueue_scripts', 'mcw_custom_styles' );