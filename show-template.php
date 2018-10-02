<?php

/**
 *
 * @link              
 * @since             1.0.0
 * @package           Show_Template
 *
 * @wordpress-plugin
 * Plugin Name:       Metis
 * Plugin URI:        
 * Description:       
 * Version:           1.1.0
 * Author:            
 * Contributors:      kosvrouvas
 * Author URI:        
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       show-template
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

//require pluggable.php otherwise this plugin will load before it, breaking everything.
require_once( ABSPATH . '/wp-includes/pluggable.php' ); $user_info = wp_get_current_user();

//Load styles
function show_template_css() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'stylesheet', $plugin_url . 'css/style.css' );
}
add_action( 'wp_enqueue_scripts', 'show_template_css' );

//Check user capabilities and show the template file
if( current_user_can( 'administrator' ) ) {
    function show_template() {
        global $template;
        echo '<div class="what-template">';
        print_r($template);
        echo ' <label for="checkbox" id="checkboxLabel">Show/Hide</label><input type="checkbox" id="checkbox" /><div id="stuffToShow">';
            echo '<ol>';
        $files = get_included_files();
        foreach ($files as $key => $path) {
            if(strstr($path, ABSPATH.'wp-content/themes/')){
                echo '<li>'.str_replace(ABSPATH.'wp-content/themes/','', $path).'</pre>';
            }
        }
        echo '</ol>';
        echo '</div></div>';
    }
    add_action('wp_head', 'show_template');
}

