<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'kabernee_wordpress' );

/** MySQL database username */
define( 'DB_USER', 'kabernee_wp' );

/** MySQL database password */
define( 'DB_PASSWORD', '-?T7u00e7cm-' );

/** MySQL hostname */
define( 'DB_HOST', 'MS01.BEEHOSTING.PRO' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Pj%{al({xut_.szwnl?p_Y8nd_E.%BuzFY/b|`o3j*=p#+Pe@~n>RDmZ-C<?r@Fa' );
define( 'SECURE_AUTH_KEY',  'Y>za5X<d,pM Itu?+$fp2b}iI:O{h f&N 2%bUgA),O>@{aJ`pqOIVZr^R.#8H]n' );
define( 'LOGGED_IN_KEY',    'QjN61$Lo40Hb#1wMCufADeq[D9IK_im}1EOX,Y)xgzg-tQGntb$`J(#)?=2n$m?L' );
define( 'NONCE_KEY',        'b64~T~#LX2-u2j-+rm{~Hwc t.`SP(|^>(=#!h+-9~tUuETBnvB_= x}x^ejD{UJ' );
define( 'AUTH_SALT',        '6=t.OMpC(gsSu8%1?9#YbHh{M*V22cPrP-.^n=#wq!p){0s6X[=d>ovH%gN=.|FR' );
define( 'SECURE_AUTH_SALT', 'ZT>`W$Lx9aW=!oeaG{yk3`;fsa4--S|s/sdqb!BX$kEk)3we:O,G:noq4ZRWv6Xu' );
define( 'LOGGED_IN_SALT',   '5oh{lUok07UK1|Y-:|bToPs;u;)d;?%[4q6n=Mevb7JL3fU4;OSA|mb)n)_~4QaZ' );
define( 'NONCE_SALT',       'sxoKFfDu.qZUW@2mL@3?+~I{y9|Qs#+2YzIGl0U`lc:Riaz6ftMZ(:!-9@jqW@j`' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpkaber20_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );
define( 'WP_DEBUG_DISPLAY', false );

define('WPLANG', '');
define('REDIRECT_MAIN_SITE', 'et');

define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'kaberneememarina.ee');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
