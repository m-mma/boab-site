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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'brideson_2018-local-DB');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost:8889');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'H~rMey_`FE,9Qgfg<`0*/` ^*,Cppm%+6YnCmz$c;iMC<U%a5ObZm4up{}L{36-b');
define('SECURE_AUTH_KEY',  'x=}rN6%J1akvunZRbQfu4yj3{e]b@2zu~1JQBeRV12Cq:]As|<nLrthLTp(}-O#^');
define('LOGGED_IN_KEY',    '#@n7:+]ub3ZgawYbk`r*+kdJLs@@0IS?]F,(UgQs[e+K)z(>tof-I;t$`m&8~k}#');
define('NONCE_KEY',        '.rzgz!lYggb=z/_oqw(FepqCva#Y6cs3q{D:[1X6tHpvjaEysn8{kFI9W:p=D[^w');
define('AUTH_SALT',        ':bd%7@)Bcam,(7dgz7U;M.Mnh8.D3|>ixUZOCK>[k51S5JeU{~G9 &1Z:z$?EjlR');
define('SECURE_AUTH_SALT', ']jS[-Iz{4z=SMbc0$!EiS5d/supeOTrLrO-4E;7vMfEjp<z30Kj.~ob~+>:MB,j/');
define('LOGGED_IN_SALT',   'p|skqr_ZGTO*R<*z(Y$gG},xb1)1OvG}h3?9><]G&w6FG+>DG1:AQwf~=eQ?FrG?');
define('NONCE_SALT',       'j2|6?^cn73[l@q^<jA|M6pdRg0hNF[V9%#Lo{ Sc zP]t[RN7lE^9nlmu|F)0Zr*');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

// define( 'WP_HOME', 'localhost:8888/boab-site' );
// define( 'WP_SITEURL', 'localhost:8888/boab-site' );


/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
define('ABSPATH', dirname(__FILE__) . '/');
/* THIS IS CUSTOM CODE CREATED AT ZEROFRACTAL TO MAKE SITE ACCESS DYNAMIC */
$currenthost = "http://".$_SERVER['HTTP_HOST'];
$currentpath = preg_replace('@/+$@','',dirname($_SERVER['SCRIPT_NAME']));
$currentpath = preg_replace('/\/wp.+/','',$currentpath);
define('WP_HOME',$currenthost.$currentpath);
define('WP_SITEURL',$currenthost.$currentpath);
define('WP_CONTENT_URL', $currenthost.$currentpath.'/wp-content');
define('WP_PLUGIN_URL', $currenthost.$currentpath.'/wp-content/plugins');
define('DOMAIN_CURRENT_SITE', $currenthost.$currentpath );
@define('ADMIN_COOKIE_PATH', './');
