<?php
/**
 * Plugin Name: wp-permamod
 * Plugin URI: http://wp-permamod.prinetti.it
 * Description: Basically, I add an anchor to the permalinks.
 * Version: 0.1
 * Author: qrawl
 * Author URI: http://qrawl.prinetti.it
 * License: GPLv2
 */

/*  Copyright 2013  Pierre Prinetti  (email : qrawl@prinetti.it)

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

function add_permalink_anchor($url) {
	$anchor = 'content';
	return $url . '#' . $anchor;
}

add_filter('the_permalink', 'add_permalink_anchor');

?>