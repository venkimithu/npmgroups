<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'u248124199_npm');

/** MySQL database username */
define('DB_USER', 'u248124199_npm');

/** MySQL database password */
define('DB_PASSWORD', 'npm@hosting');

/** MySQL hostname */
define('DB_HOST', 'mysql.hostinger.in');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'Z90i:v<azu%JZL||L/KS?o`-Q$|@|@5nndaHrGtA8w_+o-q~fUfC[+aI]xR@qM#.');
define('SECURE_AUTH_KEY',  'dgc-MdUL&TcOMTiO,uq/JkMDw~&@03KJ5OV5;=KVWw7a(OEfMJ}]8#m]~r+~MJ0 ');
define('LOGGED_IN_KEY',    'J$F7(*A|FYt@+8,_Uos|7a_$y^D@8xBm,V5ufpN[}^,37>:o|S^&KV=I+d^Wg4Lh');
define('NONCE_KEY',        '{ZaZptCELf+o|z8Um]U`.R#z`hw{G[.&b4e7cRM#nG $+PzsFv8Vs[CE/Y4|vYlb');
define('AUTH_SALT',        'xhpR]o-ShWEx0h|2+C2,#8+3[0.6+*I9*-{YNNe-RVD>OVex?n=#_&$hep^^cLmK');
define('SECURE_AUTH_SALT', 'sG&bv`-d9t8PMAj/uM.W6{quAJip>7x3u=3W|#tZ)4HpQuIyu_{m=x.R0cW!qSKx');
define('LOGGED_IN_SALT',   'gu6)Y-ES9#h[|)+*Hqdp{.wjuRnt51eW>+Vsdpp(Xsi):y-_4-vmp(&y|S)nH.Cc');
define('NONCE_SALT',       'y@B^R+Z-$blS%7xR2oEt|D6*gUir!{1BBy3er|u7%m6NFid2^NdO4Gkmg)O$^*4V');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
