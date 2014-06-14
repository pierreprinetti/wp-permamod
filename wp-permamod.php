<?php
/**
 * Plugin Name: wp-permamod
 * Plugin URI: http://www.pierreprinetti.net/wp-permamod/
 * Description: A Wordpress plugin that adds anchor reference to post and page links.
 * Version: 0.2.3
 * Author: Pierre Prinetti
 * Author URI: http://www.pierreprinetti.net
 * License: GPLv2
 */

/*  Copyright 2013  Pierre Prinetti  (http://www.pierreprinetti.net)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function wp_permamod_settings_exist(  ) {
    if( false == get_option( 'permamod_settings' ) ) {
            add_option( 'permamod_settings' );
    }
}

function permamod_settings_init() {
    register_setting(
        'permalink',
        'permamod_settings',
        'permamod_validate'
    );
    add_settings_field(
        'permamod_anchor',
        __( 'Anchor name', 'wp_permamod' ),
        'permamod_anchor_name_render',
        'permalink',
        'optional'
    );
}

add_action( 'admin_init', 'permamod_settings_init' );

function permamod_anchor_name_render() {
    $option = get_option('permamod_settings');
    $anchor = $option['anchor_name'];
    echo "<input id=\"anchor_name\" name=\"permamod_settings[permamod_anchor_name]\" type=\"text\"  value=\"{$anchor}\" class=\"regular text code\">";
}

function permamod_validate( $input ) {
    $valid = array();
    $anchor_name = $input['anchor_name'];
    if (substr($anchor_name, 0, 1) == "#") {
        $valid['anchor_name'] = substr($anchor_name, 1);
    } else {
        $valid['anchor_name'] = $anchor_name;
    } 
    return $valid;
}

 // ------------------------------------------------------------------
 // Core function
 // ------------------------------------------------------------------
 //
 // This function appends the anchor to a given string
 // 

function append_anchor($url) {
    $anchor = get_option('permamod_settings')['anchor_name'];
	if (strpos($url,'#') !== false or $anchor == "") {
		return $url;
	}
	else {
		return "{$url}#" . $anchor;
	}
}

function add_post_permalink_anchor( $url, $post, $leavename ) {
	return append_anchor($url);
}

function add_page_permalink_anchor( $url, $page ) {
	return append_anchor($url);
}

add_filter('post_link', 'add_post_permalink_anchor', 10, 3);
add_filter('page_link', 'add_page_permalink_anchor', 10, 2);

?>
