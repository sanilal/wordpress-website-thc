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
define('DB_NAME', "thc");

/** MySQL database username */
define('DB_USER', "root");

/** MySQL database password */
define('DB_PASSWORD', "");

/** MySQL hostname */
define('DB_HOST', "localhost");

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
define('AUTH_KEY',         's`k3T?,*@YT,ZN#O^#hB,.kGjI^y.$R@Nz?K(?bZfIs2$VYOn=I:8ES5INk<V9ti');
define('SECURE_AUTH_KEY',  'g$1k_Zid]d(>785u0UP?(1kf6CIK^1M:SB@8FFmIi}+4#^5bX{8bQ0ewqzkIpo_4');
define('LOGGED_IN_KEY',    'jl$fF#55Y{$EJv.XA&_;Lk5xR(a,vhX9.c{pG%72cXo:$4cgjgiH-4x=_7>/)Z,=');
define('NONCE_KEY',        'gg`~Fs<Tsv1_iw6@>fG~HP+[C-|gig@rWqpw}Z*Di+Bgq o*zG`(ULR&|%iW7C_M');
define('AUTH_SALT',        'lo&ARcp+ws. n.A?~E:3D7h)u;8xwn~(m!?9j5or TnxK53t8<im1L>tO)/w_$BN');
define('SECURE_AUTH_SALT', 'Wv-%{$B90:%ZBeFR<FD#sdg$3EBr473|U*bgoyLDi~vYpLBma{K2&] +4g91(pAi');
define('LOGGED_IN_SALT',   'Ps4#`6zsXwOdcKdYEw5iAj03e#kl4J|dQLA;?cw5zefdanxm#/X,Yl,+RQ3UxGE&');
define('NONCE_SALT',       '4$K+.m5{c2w/g@:2dtjo7(@Kr]`f?XM%nt_u3@>w&C[(|B0^* fBuw?F@srX,_79');

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
