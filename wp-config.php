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
define( 'DB_NAME', 'aayushi_practical' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'agc123' );

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
define( 'AUTH_KEY',         'KwncUG7sHl|;b5-EC=Ajt DvzTyX3>1UT<3JK=p(:E|N|#Vl&+8,DQR f2PR(7Nu' );
define( 'SECURE_AUTH_KEY',  'r@=9H2;~k(B?MpwJi6^aGEH3_4@gQ/oD{=7T11LsU?Z$`kwpi]Hb, =Az|o[x=Cc' );
define( 'LOGGED_IN_KEY',    'P~7rI~/0`k,SwyK$5]&,D4IpxFt6A Bi8J>N{iXx*fdrnm1Te82,=ZYiDQkQrVLD' );
define( 'NONCE_KEY',        '<[@<G<?Nc%MkmXUBEb -nMBrTrO~~*(mtwiw-5k?~=g7kVilEn2KC8i1C*p<ju@Y' );
define( 'AUTH_SALT',        'z3f)6BDdIqkr)ja!V)zomunM(v9lH([D`#+>Deb53k{~F]P/:%Gge_{[io`]U^9Z' );
define( 'SECURE_AUTH_SALT', '@n@frod{z~E5Ic#~MU|(1|c+`0YMxjT.b,<xR0gj7i.1ttz^#An]7[6a/];=<pJ6' );
define( 'LOGGED_IN_SALT',   '/m$:)=}c#6;<:~GK]m,sme6&KW2Y0)1u=f$o`o:<1YkzJxx6F94)!=1{~FIbnJ1B' );
define( 'NONCE_SALT',       'H0=EmOGid!7nC,@>~9bH_V~V K=@Ju=f& .+q!DK$oE3Q,.Q%h iiYaISdE;8$#n' );

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

define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
