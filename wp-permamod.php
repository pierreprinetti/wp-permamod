<?php
/**
 * Plugin Name: wp-permamod
 * Plugin URI: https://github.com/qrawl/wp-permamod
 * Description: I add an anchor to page and post permalinks.
 * Version: 0.2
 * Author: qrawl
 * Author URI: http://pierreprinetti.net
 * License: GPLv2
 */

/*  Copyright 2013  Pierre Prinetti  (http://pierreprinetti.net)

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

function append_anchor($url) {
	$anchor = "content";
	if (strpos($url,'#') !== false) {
		return $url;
	}
	else {
		return "{$url}#{$anchor}";
	}
}

function add_post_permalink_anchor( $url, $post ) {
	return append_anchor($url);
}

function add_page_permalink_anchor( $url, $page ) {
	return append_anchor($url);
}

add_filter('post_link', 'add_post_permalink_anchor');
add_filter('page_link', 'add_page_permalink_anchor');

?>
