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
define( 'DB_NAME', 'school' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'robisearch2018' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'MYAOEe?GyXU`+TRgY];Mj*;xK<)H#x51S6rk{GY;er#MP=Sxs4_>BhHDRyg4h$/G' );
define( 'SECURE_AUTH_KEY',  '2.; $d/@R@`~T3bMsL7-Q+BT6IWZ6n;wFm(v@&nC!#?39@C<1/fLjH!mrI3jjDx=' );
define( 'LOGGED_IN_KEY',    '~v&Fp_qw BVK@b^g|W8f$;elRp0xh-1>K]n#^yJ 0X1fd<jGBDLG!(l+B^FLoK/X' );
define( 'NONCE_KEY',        'p%R)DD7S9faor=NV324zLfxEJl>1F[zJmHKg2vg%bF|#G-Trt,3/i^KD{_+y?3]w' );
define( 'AUTH_SALT',        '=[snwog/_4PmQWQKyO.Y$1Me(M9zsBl_s3_&SOFE0A2}(s]ClX2wEd;;Suqg1YS=' );
define( 'SECURE_AUTH_SALT', 'sU_29I8^mmn!{UB0aTZeR$?^amGrGcz0byQRpnFv _QHaTA[6^j1`-+P=F,Goyn(' );
define( 'LOGGED_IN_SALT',   'b&Z>48Vzl}r|QAT(Cb.z0k]&(b+/ir.og<H,WZxUk,e 1|GK_dKxew,NOv&l0=Wo' );
define( 'NONCE_SALT',       'rMOXcJ5&|Q708[o~ERr3|[rS:=2rPE|6q?tv bx(lU`29iWFMz}Ea}+5xsH=vwS6' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
