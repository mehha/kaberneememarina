<?php
/*
 * Plugin Name: CryptX
 * Plugin URI: http://weber-nrw.de/wordpress/cryptx/
 * Description: No more SPAM by spiders scanning you site for email adresses. With CryptX you can hide all your email adresses, with and without a mailto-link, by converting them using javascript or UNICODE. Although you can choose to add a mailto-link to all unlinked email adresses with only one klick at the settings. That's great, isn't it?
 * Version: 3.3.3.2
 * Requires at least: 4.6
 * Author: Ralf Weber
 * Author URI: http://weber-nrw.de/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: cryptx
*/

//avoid direct calls to this file, because now WP core and framework has been used
if ( ! function_exists('add_action') ) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

/**
 * some basics
 */
global $wp_version;
/** @const CryptX version */
define( 'CRYPTX_VERSION', "3.3.2");
define( 'CRYPTX_BASENAME', plugin_basename( __FILE__ ) );
define( 'CRYPTX_BASEFOLDER', plugin_basename( dirname( __FILE__ ) ) );
define( 'CRYPTX_DIR_URL', rtrim( plugin_dir_url( __FILE__ ), "/" )."/" );
define( 'CRYPTX_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'CRYPTX_FILENAME', str_replace( CRYPTX_BASEFOLDER.'/', '', plugin_basename(__FILE__) ) );

require_once(CRYPTX_DIR_PATH . 'include/functions.php');

require_once(CRYPTX_DIR_PATH . 'include/admin_option_page.php');

$cryptX_var = get_option('cryptX');
/**
 *  check for needed updates
 */
if( isset( $cryptX_var['version'] ) && version_compare(CRYPTX_VERSION, $cryptX_var['version']) > 0 ) {
    cryptx_do_updates();
}
$cryptX_var = rw_loadDefaults();

$is_js_needed = false;

foreach($cryptX_var['filter'] as $filter) {
    if (@$cryptX_var[$filter]) {
        rw_cryptx_filter($filter);
    }
}

add_action( 'activate_' . CRYPTX_BASENAME, 'rw_cryptx_install' );

// Hook into the 'wp_enqueue_scripts' action
add_action( 'wp_enqueue_scripts', 'cryptx_javascripts_load' );


if (@$cryptX_var['metaBox']) {
    add_action('admin_menu',         'rw_cryptx_meta_box');
    add_action('wp_insert_post',     'rw_cryptx_insert_post' );
    add_action('wp_update_post',     'rw_cryptx_insert_post' );
}

add_filter( 'plugin_row_meta', 'rw_cryptx_init_row_meta', 10, 2 );

add_filter( 'init', 'rw_cryptx_init_tinyurl');
// add_action( 'parse_request', 'rw_cryptx_parse_request');

add_shortcode( 'cryptx', 'rw_cryptx_shortcode');