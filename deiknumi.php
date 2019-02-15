<?php

/**
 *
 * @link              
 * @since             1.0.0
 * @package           deiknumi
 *
 * @wordpress-plugin
 * Plugin Name:       Deíknūmi
 * Plugin URI:        
 * Description:       Displays the current template file (and template parts if any). The name comes from the Proto-Indo-European *deyḱ- (“to show, point out”) +‎ -νῡμῐ (-nūmi), from Proto-Indo-European *-néwti.
 * Version:           0.2
 * Author:            Kostas Vrouvas
 * Contributors:      kosvrouvas
 * Author URI:        https://kosvrouvas.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       deíknūmi
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

//require pluggable.php otherwise this plugin will load before it, breaking everything.
require_once( ABSPATH . '/wp-includes/pluggable.php' ); $user_info = wp_get_current_user();

//Load styles
function deiknumi_css() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'stylesheet', $plugin_url . 'css/style.css' );
}
add_action( 'wp_enqueue_scripts', 'deiknumi_css' );

//Check user capabilities and show the template file only if user is admin
if( current_user_can( 'administrator' ) ) {
    function deiknumi() {
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
    add_action('wp_head', 'deiknumi');
}
