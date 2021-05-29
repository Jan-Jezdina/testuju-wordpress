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
define( 'DB_NAME', 'testwordpress_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'IxO`|:VtQs(,$p2VEPMD2d%K3;Wq):7`BeeB<TwKMMh(qO2Q6DZA<y$q{Y:c*1*X' );
define( 'SECURE_AUTH_KEY',  'Qe1w$z8^$UbgtboB)$MJ7%t&rs<^50PM@)nJ5:}W/RRf2&&nRI(<z fr,mzl%f3O' );
define( 'LOGGED_IN_KEY',    'Ct+{h&8-(#!+LXrVj%7j~W!!}vIj#s:oTyDm0YV$y@=Ix[n`s5*5}DZ)O!(?9l_u' );
define( 'NONCE_KEY',        '~-Mo,TvUQ},~2@Y22)/BX^gzeIjfe(-z0ycr,)]BWtHk_P~29 RssK_ #{W.=[Wm' );
define( 'AUTH_SALT',        'N~XrQ/I~=-~._;FZ:[t6b1mtGwfY7n^R<Rgbs`?wE;i;!HZ`iM-,W.h/L!@tf`S)' );
define( 'SECURE_AUTH_SALT', 'u&a0q-|;O-(nd5DhBpa+k6`n0(LFV3.C-z6dIWY@8G.a7VVi.+aMzJ^h22b)kqGe' );
define( 'LOGGED_IN_SALT',   'GZ=Idi)gW>Gc-df?}0)PkPs+d`Gca ;x!p@S^5w&czj8w&`t>hq3rIJN,V2[{d<[' );
define( 'NONCE_SALT',       'h&A9QY]N$/a{}5<=sDc},W6r4h6hGEx|qNh}zEAyG/oPH1j;5JLSY4/Dlw8+cy]w' );

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
