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
define('DB_NAME', 'lucilledrx928');

/** MySQL database username */
define('DB_USER', 'lucilledrx928');

/** MySQL database password */
define('DB_PASSWORD', 'Ft357yr6GTCa');

/** MySQL hostname */
define('DB_HOST', 'mysql463.sql001:3306');

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
define('AUTH_KEY',         'TO7U8i3fPkKtuDxjtsVD5VLyNglW0YmPieLZ+4OnbhNpoajqPSsIFUTznZlk');
define('SECURE_AUTH_KEY',  'd91x7UEbOGSw3On24w/GwWuFWCw2uUtQAEhRucsDHMY2YVC8raIZVYEFcoOC');
define('LOGGED_IN_KEY',    'hyKqM7XlC39EcCVg5DfGmLEBuJcJEsb+/4k6La+0ciKQysysljhzNcz/8hgE');
define('NONCE_KEY',        'FltaAEu3QTVCbouyKS3KWRKbT7vJ0B7LUfY3nmANWSgjkQK5Iewq+1t6Uh4k');
define('AUTH_SALT',        'JPnDpTcKz/3OrAuKWHBz017yEGjOUXNN68G8tEofSthRqvbvVo7LvFBudNgy');
define('SECURE_AUTH_SALT', 'Jnq3syASr/+rG4sNEBOZB5mY5bJU/fQrzpVT3t3yp2HSSOSy31gAHyD6kS+r');
define('LOGGED_IN_SALT',   'vqt9d0mHnqmZthqjDosyg6pmM2IAmcdKfyc69L/frPUFDdAXx4i36575syeO');
define('NONCE_SALT',       'ZflU2dQQ/Sg6nwa+ly1SGMkOMlmiMg13dstKcODIy/Y6D1Ma4YN+WC5XA3LB');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'mod86_';

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

/* Fixes "Add media button not working", see http://www.carnfieldwebdesign.co.uk/blog/wordpress-fix-add-media-button-not-working/ */
define('CONCATENATE_SCRIPTS', false );

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
