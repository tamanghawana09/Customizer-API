<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'customizer_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'v{6&u5pkY#kA*S<D1i{g~y{mf-U`fb~Y(E]?]X_bWY6ZjJXj:e-,IK%THsOn{x(N' );
define( 'SECURE_AUTH_KEY',  'Q{W`nZgHzDw-t9znZG$cw;].+ZbL.^>@8C6ioS12+Y9ZN&W+VNG/MyUWvQRoE1:N' );
define( 'LOGGED_IN_KEY',    '`@YFlE7hK!_D62l_f1^!i?iXA^6X[`^abPA~;qV7Qhx^_Zhck]VTF3{w 7y;~L[4' );
define( 'NONCE_KEY',        '@Ao*a.S/0x*g3*eJPpL28ODG:pP4zed/3LMp&PPzHE?@{8G:[-r1eH[A215V}pbD' );
define( 'AUTH_SALT',        'oK8ebfP7Hg@Tp*B[FHaCSL90>K,6n`LDO/-14o}/n&Y-1!Z)c}Z))77 Q*Tv2i,,' );
define( 'SECURE_AUTH_SALT', 'WW5_#G h]ad/Uv|b(hHG5{=eOn e;4hQE&db1^;SSj/JsE<kyniCu9IJlhTxFLdY' );
define( 'LOGGED_IN_SALT',   'bj;yI?kwelt}[u54rNtGB;q/k(aOow.>sB.Ex]nQ}U6PkYv>K}^0IF9jx|g4RB%N' );
define( 'NONCE_SALT',       'xs*=!`n?skr,|dXpvdAzG(POM dJ8zO})9C<(5#y*{@Ashvenm 8;~MQvcP$V)5V' );

/**#@-*/

/**
 * WordPress database table prefix.
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
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
