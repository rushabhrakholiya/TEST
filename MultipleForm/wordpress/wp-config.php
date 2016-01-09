<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

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

define('FS_METHOD','direct');
/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '+sV_kxYr#O^(Lg6mzt*b|B3hyZ4N&.m9{uG.TQ!-?Gs;8!P5WBVrXbTzLe+|(+BB');
define('SECURE_AUTH_KEY',  'qY>>VwDmhGs?.ES?O|G<Z;uBnKoi<ime>uA8+;m#,@T_Slt*=iYBVLM|z}X_<7+$');
define('LOGGED_IN_KEY',    'KOjti7[xX$iZ[pZ6m7E2o[u5K!J>!h}, `T$C@8y~,cyxTGJH>G+kB%#M/&(/.{b');
define('NONCE_KEY',        'Y>8^|}wWLQ>ClAhq~w ps=L3RtZPTN7:2Cga_<Pwyh )!g*2N>yPQ=5TvIk+.qj[');
define('AUTH_SALT',        'gm_,?mc+S9ip`;HU^8|S^-O0TOMA;]=1$)hczK__(7y:7G3}{l h0R6|pV;nUWS1');
define('SECURE_AUTH_SALT', 'j.bt~3i8a<Dov5x([xmW+baw.9bA,UzvirKW/59f_@MmS#8~E]]-hkO ujKFe&[B');
define('LOGGED_IN_SALT',   's1]+C>ic1!5F|6AJ57C_^o%(~(>;lvu+Hr;A*GoxDz<){g+;0#)/>G(;pO-,(+0g');
define('NONCE_SALT',       'YFgy)r?3Zq06!X|Yt+4Ezn3rMm(|(w-#Yln,dm!L#MmYlFPx`]ZfDP7djrj]$c+#');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
