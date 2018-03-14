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
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'Y9bY[DI`M=p#:0!<yS;qpqltftVN@-8O~tIxulfwxx|:})42|D+Hh&sJTZ> shf`');
define('SECURE_AUTH_KEY',  ',dOAu&R|nMw;#qMd~D`xGnMl0Uo88C&)R[j[C#Xbugn%U?1|8.6QI&mK)8I<dR<<');
define('LOGGED_IN_KEY',    ']T #4_FX`_[y}tzO;@:1w|`6FIRL5X 6r7ZC(~VLI[wM[7h7+F4[xmYd]#Dk{c~s');
define('NONCE_KEY',        'XqKdj2wkT]%6r78!lA4m:SE@5iY~PO:9*{U{0u*tAg],*H5aq:@Fq+*g44|pPUZ(');
define('AUTH_SALT',        '}yZ,m0|Z;j+oGnY? gUxe{PoV;7ODjJ:(wl;-wGZ^+,[]*KyH[ZU=m_^AGOKnKT8');
define('SECURE_AUTH_SALT', 'bFBfm)52}Sg:rCmN*aEcA!8A.R76#-4mLK[GEhC.^Y,QG~/$i1;&eR1J8OJX<QtX');
define('LOGGED_IN_SALT',   ' pkRKW&}Y?vj}lV&P^NoR4[s<Tdn-Zrf3pRvK:rlgb>zKRpXi#i[ st/ nj~F3_j');
define('NONCE_SALT',       'oD0sY]z*8+z95TRTx_>~x%nen`cuWQ*sF31#ui[TbUlY&v~]4b-__~LxOk_W3a@d');

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

/** BoaB custom memory limit */
define('WP_MEMORY_LIMIT', '256M');
