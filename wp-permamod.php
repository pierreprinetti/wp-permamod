<?php
/**
 * Plugin Name: wp-permamod
 * Plugin URI: http://www.pierreprinetti.net/wp-permamod/
 * Description: A Wordpress plugin that adds anchor reference to post and page links.
 * Version: 0.2.1
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

add_action( 'admin_menu', 'permamod_add_admin_menu' );
add_action( 'admin_init', 'permamod_settings_init' );


function permamod_add_admin_menu(  ) { 

    add_options_page( 'wp_permamod', 'wp_permamod', 'manage_options', 'wp_permamod', 'wp_permamod_options_page' );

}


function permamod_settings_exist(  ) { 

    if( false == get_option( 'wp_permamod_settings' ) ) { 

        add_option( 'wp_permamod_settings' );

    }

}


function permamod_settings_init(  ) { 

    register_setting( 'pluginPage', 'permamod_settings' );

    add_settings_section(
        'permamod_pluginPage_section', 
        __( '', 'wp_permamod' ), 
        'permamod_settings_section_callback', 
        'pluginPage'
    );

    add_settings_field( 
        'permamod_anchor_name', 
        __( 'Anchor name', 'wp_permamod' ), 
        'permamod_anchor_name_render', 
        'pluginPage', 
        'permamod_pluginPage_section' 
    );


}


function permamod_anchor_name_render(  ) { 

    $options = get_option( 'permamod_settings' );
    ?>
    <input type='text' name='permamod_settings[permamod_anchor_name]' value='<?php echo $options['permamod_anchor_name']; ?>'>
    <?php

}


function permamod_settings_section_callback(  ) { 

    echo __( 'Please enter the text that will be appended to your permalinks,
        omitting the `#`', 'wp_permamod' );

}


function wp_permamod_options_page(  ) { 

    ?>
    <form action='options.php' method='post'>
        
        <h2>wp_permamod</h2>
        
        <?php
        settings_fields( 'pluginPage' );
        do_settings_sections( 'pluginPage' );
        submit_button();
        ?>
        
    </form>
    <?php

}

function append_anchor($url) {
    $anchor = get_option( 'permamod_settings' )['permamod_anchor_name'];
	if (strpos($url,'#') !== false or $anchor == "") {
		return $url;
	}
	else {
		return "{$url}#"  . $anchor;
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
