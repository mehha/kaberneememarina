<?php

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (! file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['helpers', 'setup', 'filters', 'admin'])
    ->each(function ($file) {
        $file = "app/{$file}.php";

        if (! locate_template($file, true, true)) {
            wp_die(
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });

/*
|--------------------------------------------------------------------------
| Enable Sage Theme Support
|--------------------------------------------------------------------------
|
| Once our theme files are registered and available for use, we are almost
| ready to boot our application. But first, we need to signal to Acorn
| that we will need to initialize the necessary service providers built in
| for Sage when booting.
|
*/

add_theme_support('sage');

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We are ready to bootstrap the Acorn framework and get it ready for use.
| Acorn will provide us support for Blade templating as well as the ability
| to utilize the Laravel framework and its beautifully written packages.
|
*/

new Roots\Acorn\Bootloader();

//Redirect
function index_redirect()
{
    global $wp_query;
    if (get_current_blog_id() === 1 && $GLOBALS['pagenow'] !== 'wp-login.php' && $GLOBALS['pagenow'] !== 'wp-register.php') {
        if (!is_admin() && !is_page()) {
            wp_redirect(get_bloginfo('url') . '/' . REDIRECT_MAIN_SITE . '/', 301);
            exit;
        }
    }
}

if (defined('REDIRECT_MAIN_SITE')) {
    add_action('wp', 'index_redirect');
}

//Admin styles
function custom_admin_styles()
{
	echo '<style type="text/css">
    #login h1 a {
            background: url(//kaberneememarina.ee/et/wp-content/uploads/sites/2/2020/10/logo.png) no-repeat center top;
            background-size: 123px auto;
            width: 123px;
            height: 122px;
            margin: 0 auto;
        }
         body { background: #fff; }
         .button-primary {
            background: #edcd1f !important;
            color: #000 !important;
            border: none !important;
            text-shadow none;
            border-radius: 0 !important;

            -webkit-box-shadow: none !important;
            box-shadow: none !important;

            text-shadow: none !important;
            padding: 6px 12px;
          }
          .login #login_error, .login .message, .login .success {
            border-left: 4px solid #edcd1f;
          }
        </style>';
}

add_action('login_head', 'custom_admin_styles');
