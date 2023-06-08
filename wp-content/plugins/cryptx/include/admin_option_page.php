<?php
/**
 * Don't load this file direct!
 */
if (!defined('ABSPATH')) {
    return ;
}

/**
 * load required code
 */
require_once(CRYPTX_DIR_PATH . 'include/admin_general.php');
require_once(CRYPTX_DIR_PATH . 'include/admin_presentation.php');
require_once(CRYPTX_DIR_PATH . 'include/admin_howto.php');
require_once(CRYPTX_DIR_PATH . 'include/admin_changelog.php');

/**
 * Add css to header
 */
function rw_cryptx_admin_css_script($hook) {
        // Load only on ?page=cryptx
        if($hook != 'settings_page_cryptx') {
                return;
        }
        wp_enqueue_style( 'cryptx-admin-css', CRYPTX_DIR_URL . 'css/admin.css' );
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'cryptx-admin-js', CRYPTX_DIR_URL . 'js/cryptx-admin.min.js', array( 'jquery', 'wp-color-picker' ), false, true );
        wp_enqueue_media();

}
add_action( 'admin_enqueue_scripts', 'rw_cryptx_admin_css_script' );

/**
 * add links to plugin site
 */
function rw_cryptx_init_row_meta($links, $file) {
    if (CRYPTX_BASENAME == $file) {
        return array_merge(
            $links,
            array(
                sprintf(
                    '<a href="options-general.php?page=%s">%s</a>',
                    CRYPTX_BASEFOLDER,
                    __('Settings')
                )
            ),
            array(
                sprintf(
                    '<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=4026696">%s</a>',
                    __('Donate', 'cryptx')
                )
            )
        );
    }
    return $links;
}

/**
 * add CryptX to Option menu
 */
function rw_cryptx_menu() {
    add_submenu_page(
    	'options-general.php',
    	_x( 'CryptX', 'CryptX settings page', 'cryptx' ),
    	_x( 'CryptX', 'CryptX settings menu', 'cryptx' ),
    	'manage_options',
    	'cryptx',
    	'rw_cryptx_submenu'
    );
}
if (is_admin()) add_action('admin_menu', 'rw_cryptx_menu');

/**
 * save options
 */
function rw_cryptx_saveOptions() {
    global $cryptX_var, $data, $rw_cryptx_active_tab;

    if (isset($_POST) && !empty($_POST)) {
        if (function_exists('current_user_can') === true && current_user_can('manage_options') === false) {
            wp_die("You don't have permission to access!");
        }
        $saveOptions = cryptx_sanitize_data($_POST['cryptX_var']);
        check_admin_referer('cryptX');
        if(isset($_POST['cryptX_var_reset'])) {
            delete_option('cryptX');
            $saveOptions = rw_loadDefaults();
        }
        if(isset($_POST['cryptX_save_general_settings'])) {
            $checkboxes = array(
                'the_content' => 0,
                'the_meta_key' => 0,
                'the_excerpt' => 0,
                'comment_text' => 0,
                'widget_text' => 0,
                'autolink' => 0,
                'metaBox' => 0,
            );
            $saveOptions = wp_parse_args( $saveOptions, $checkboxes );
        }
        $saveOptions = wp_parse_args( $saveOptions, rw_loadDefaults() );
        update_option( 'cryptX', $saveOptions);
        $cryptX_var = rw_loadDefaults();
        ?>
        <div id="message" class="updated fade">
            <p><strong><?php _e('Settings saved.') ?></strong></p>
        </div>
        <?php
    }
}

/**
 * sanitize given options
 */
function cryptx_sanitize_data($data) {
    if( isset( $data['version']) ) $data['version'] = sanitize_text_field($data['version']);
    if( isset( $data['at']) ) $data['at'] = sanitize_text_field($data['at']);
    if( isset( $data['dot']) ) $data['dot'] = sanitize_text_field($data['dot']);
    if( isset( $data['css_id']) ) $data['css_id'] = sanitize_text_field($data['css_id']);
    if( isset( $data['css_class']) ) $data['css_class'] = sanitize_text_field($data['css_class']);
    if( isset( $data['the_content']) ) $data['the_content'] = (int) $data['the_content'];
    if( isset( $data['the_meta_key']) ) $data['the_meta_key'] = (int) $data['the_meta_key'];
    if( isset( $data['the_excerpt']) ) $data['the_excerpt'] = (int) $data['the_excerpt'];
    if( isset( $data['comment_text']) ) $data['comment_text'] = (int) $data['comment_text'];
    if( isset( $data['java']) ) $data['java'] = (int) $data['java'];
    if( isset( $data['load_java']) ) $data['load_java'] = (int) $data['load_java'];
    if( isset( $data['opt_linktext']) ) $data['opt_linktext'] = (int) $data['opt_linktext'];
    if( isset( $data['autolink']) ) $data['autolink'] = (int) $data['autolink'];
    if( isset( $data['alt_linktext']) ) $data['alt_linktext'] = sanitize_text_field($data['alt_linktext']);
    if( isset( $data['http_linkimage_title']) ) $data['http_linkimage_title'] = sanitize_text_field($data['http_linkimage_title']);
    if( isset( $data['alt_linkimage_title']) ) $data['alt_linkimage_title'] = sanitize_text_field($data['alt_linkimage_title']);
    if( isset( $data['excludedIDs']) ) $data['excludedIDs'] = sanitize_text_field($data['excludedIDs']);
    if( isset( $data['metaBox']) ) $data['metaBox'] = (bool) $data['metaBox'];
    if( isset( $data['excludedIDs']) ) $data['excludedIDs'] = sanitize_text_field($data['excludedIDs']);
    if( isset( $data['alt_uploadedimage']) ) $data['alt_uploadedimage'] = sanitize_text_field($data['alt_uploadedimage']);
    if( isset( $data['c2i_font']) ) $data['c2i_font'] = sanitize_text_field($data['c2i_font']);
    if( isset( $data['c2i_fontSize']) ) $data['c2i_fontSize'] = (int) $data['c2i_fontSize'];
    if( isset( $data['c2i_fontRGB']) ) $data['c2i_fontRGB'] = sanitize_text_field($data['c2i_fontRGB']);
    if( isset( $data['echo']) ) $data['echo'] = (int) $data['echo'];
    if( isset( $data['whiteList']) ) $data['whiteList'] = sanitize_text_field($data['whiteList']);
    return $data;
}

/**
 * print CryptX Option Page
 */
function rw_cryptx_submenu() {
    global $cryptX_var, $data, $rw_cryptx_active_tab;
    rw_cryptx_saveOptions();
	$rw_cryptx_active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'general';
    ?>
    <div class="cryptx-option-page">
        <h1><?php _e("CryptX settings",'cryptx'); ?></h1>
        <form method="post" action="">
        <?php wp_nonce_field('cryptX') ?>

    	<h2 class="nav-tab-wrapper">
    	<?php
    		do_action( 'rw_cryptx_settings_tab' );
    	?>
    	</h2>
    	<div class="cryptx-tab-content-wrapper">
    	<?php
    		do_action( 'rw_cryptx_settings_content' );
        ?>
    	</div><!-- /.cryptx-tab-content-wrapper -->
        </form>
    </div><!-- /.cryptx-option-page -->
    <?php
}

/**
 * Option page navigation
 */
function rw_cryptx_settings_tab_presentation(){
	global $rw_cryptx_active_tab; ?>
	<a class="nav-tab <?php echo $rw_cryptx_active_tab == 'general' || '' ? 'nav-tab-active' : ''; ?>" href="<?php echo admin_url( 'options-general.php?page=' . CRYPTX_BASEFOLDER . '&tab=general' ); ?>">
    	<?php _e("General",'cryptx'); ?>
    </a>
	<a class="nav-tab <?php echo $rw_cryptx_active_tab == 'presentation' ? 'nav-tab-active' : ''; ?>" href="<?php echo admin_url( 'options-general.php?page=' . CRYPTX_BASEFOLDER . '&tab=presentation' ); ?>">
    	<?php _e("Presentation",'cryptx'); ?>
    </a>
	<a class="nav-tab <?php echo $rw_cryptx_active_tab == 'howto' ? 'nav-tab-active' : ''; ?>" href="<?php echo admin_url( 'options-general.php?page=' . CRYPTX_BASEFOLDER . '&tab=howto' ); ?>">
    	<?php _e("How to&hellip;",'cryptx'); ?>
    </a>
	<a class="nav-tab <?php echo $rw_cryptx_active_tab == 'changelog' ? 'nav-tab-active' : ''; ?>" href="<?php echo admin_url( 'options-general.php?page=' . CRYPTX_BASEFOLDER . '&tab=changelog' ); ?>">
    	<?php _e("Changelog",'cryptx'); ?>
    </a>
	<?php
}
add_action( 'rw_cryptx_settings_tab', 'rw_cryptx_settings_tab_presentation' );
