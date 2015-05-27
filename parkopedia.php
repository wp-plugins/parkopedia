<?php
/*
Plugin Name: parkopedia
Plugin URI: http://wordpress.org/plugins/parkopedia
Description: [parkopedia lat="51.5078238802915" lng="-0.09417821970849796" width="800" height="500" title="London Parking"] shortcode
Version: 1.0
Author: parkopedia
Author URI: http://en.parkopedia.com
License: GPLv3
*/


function parkopedia_embed_shortcode( $atts, $content = null ) {
	$defaults = array(
		'src' => 'http://en.parkopedia.com/widget/',
		'width' => '800',
		'height' => '500',
    'lat' => '51.5078238802915',
    'lng' => '-0.09417821970849796',
    'frameborder' => '0',
    'hidebar' => '1'
	);

	foreach ( $defaults as $default => $value ) { // add defaults
		if ( ! @array_key_exists( $default, $atts ) ) { // mute warning with "@" when no params at all
			$atts[$default] = $value;
		}
	}

	$html .= '<iframe src="http://en.parkopedia.com/widget/?title='.$atts["title"].'&lat='.$atts["lat"].'&lng='.$atts["lng"].'&hidebar='.$atts["hidebar"].'" style="width:100%;border:0;margin-bottom:0;" height="'.$atts["height"].'" frameborder="'.$atts["frameborder"].'"></iframe><div style="width:100%;text-align:right;">';

	return $html;
}
add_shortcode( 'parkopedia', 'parkopedia_embed_shortcode' );


function parkopedia_plugin_meta( $links, $file ) { // add 'Plugin page' and 'Donate' links to plugin meta row
	if ( strpos( $file, 'iframe.php' ) !== false ) {
		$links = array_merge( $links, array( '<a href="http://www.parkopedia.com/build-your-widget" title="Iframe Builder">Map Builder</a>' ) );
		$links = array_merge( $links, array( '<a href="http://www.parkopedia.com/" title="Find Parking">Find Parking</a>' ) );
	}
	return $links;
}
add_filter( 'plugin_row_meta', 'parkopedia_plugin_meta', 10, 2 );
