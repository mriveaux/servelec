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
define( 'DB_NAME', 'servelec' );

/** MySQL database username */
define( 'DB_USER', 'gesicu' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Gesicu123/*-' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          ')9^?_(V&5^#LUtQV~ermdt4zZ~7nN`bjT*+2m^6p:!9q9HaUW:}U%(*))7Oo3Ho]' );
define( 'SECURE_AUTH_KEY',   'viZ^m|}huW71wJx&b&D`1}Bn,u||3:$uyXbCVWKY^wr=.mDwQ#i#zi[M/gd@tkkv' );
define( 'LOGGED_IN_KEY',     'r9}4*v$mbL>C qfU>&r}R09P|r+^6I4e+Tlr%u]96jS3?J[XF8F8Qgvfg%XzJ>ys' );
define( 'NONCE_KEY',         'Z$AwMi}m0?L-`+:o[nSXkA[NJ0O*OJM+AkEt:VoxNNkI}n=dm4|?9os1P.Dx~$d4' );
define( 'AUTH_SALT',         '[4oj/El!-l3aVbGFuUW.l_|V`EZioU8LqW8:F:[AQK3O~JKWI*9K)C)84zn:xOlh' );
define( 'SECURE_AUTH_SALT',  'g^`[z)p0v-O Gw~:,k/t;+c8E]p|6eW{Uq`*U+*x+IE~.Oh+mrHcSb<T0/XZ?-h7' );
define( 'LOGGED_IN_SALT',    'KVyP1kkslS&v8o#/hXFDNr[`!{qhgr~,YF3H;#o q}w-U394C)=:^MD*xy_n[fCC' );
define( 'NONCE_SALT',        'sV;UJ}`jT &xNKt)]_VA+b5!tkK]8w]0@yIyr_68ZMLq=68Oct!^*#dN5W:TV}i1' );
define( 'WP_CACHE_KEY_SALT', 'Qj%LHRjp }s@YI,$&%O4P!;$|XV,C/n8F:n)8HSJS< _+VY|k:w;iaro2OQ$dwsX' );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'svl_';

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';

/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', true);
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', false );
@ini_set( 'display_errors', 0 );
// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define( 'SCRIPT_DEBUG', false );

#only the authentication cookies are affected
define( 'WP_SAMESITE_COOKIE', 'Lax' ); // Pick from 'Lax', 'Strict', or 'None'.

#plugins sin ftp
define('FS_METHOD', 'direct');

# Path for wp-super-cache

# Force https
define('FORCE_SSL_ADMIN', true);
define('FORCE_SSL_LOGIN', true);
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
    $_SERVER['HTTPS']='on';
$_SERVER['SERVER_PORT'] = 443;

//define('WP_PROXY_HOST', '127.0.0.1');
//define('WP_PROXY_PORT', '3128');
//define('WP_PROXY_USERNAME', 'miguel.diaz');
//define('WP_PROXY_PASSWORD', 'Leopardo890621+');
//define('WP_PROXY_BYPASS_HOSTS', 'localhost, *.hab.desoft.cu');

# Settings for php
@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );
//Cookie with HTTPOnly and Secure flag in WordPress
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
@ini_set( 'session.cookie_lifetime', 0 );
@ini_set( 'session.use_trans_sid', false );

# Headers security
header( 'Set-Cookie: name=value;HttpOnly;Secure;SameSite=strict' );
header('X-Frame-Options: SAMEORIGIN');
header( 'X-Content-Type-Options: nosniff' );
header( 'X-XSS-Protection: 1; mode=block' );
header( 'Expect-CT: max-age=86400, enforce' );
header( 'Strict-Transport-Security: max-age=31536000; includeSubDomains' );
header('Access-Control-Allow-Headers: Authorization, Content-Type, X-WP-Wpml-Language, X-WP-Nonce, X-Requested-With, X-Token-Auth', true);
header( 'Access-Control-Allow-Methods: POST, GET, PUT, DELETE' );
header( 'Access-Control-Allow-Credentials: true' );

