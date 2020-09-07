<?php
# Database Configuration
define( 'DB_NAME', 'wp_healthkart' );
define( 'DB_USER', 'healthkart' );
define( 'DB_PASSWORD', 'o2WmS-HWOSc1uDYzGKi0' );
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         '5LgyY972M,?bdCYX$,rLc4&I-)9y)+uzEQ<vk+3UX}pW6~S6S66IX@y+T^43<?Fd');
define('SECURE_AUTH_KEY',  'dy46c b]Dyv+wcN^T|dEEA1IuN3e3jG(u?e4!42H;^4,$iR%s?4-q1X+uqBY6*sq');
define('LOGGED_IN_KEY',    '007?#S+sDEe+Y@bT?5F[Dv!4|| -,-C!F?N8A1Sd8aMSiuo97ZFyO@mag w,J1dx');
define('NONCE_KEY',        '>,^^D*ek?)B7%JtI)e_5yVnT=/,%y+M+=0UY7W|-a$~PN#Q,lY):b||X6t#9:MT=');
define('AUTH_SALT',        '5v@e[HZx%+9nhv!|Fd-|;o5ORc ?~:[ASOm<wJ9f$2Dfb+ZWCt6[LcG)Z,Wh|`ym');
define('SECURE_AUTH_SALT', '=a0l|GytPK]2Hwl^g>4I-{y+KmK36MW%>3GqxP{<,we+H5[Ve-g< S7F~2ohOakY');
define('LOGGED_IN_SALT',   'OwQ+2Gs,YF.th^x6!mB%&ba-nM@jTvcSP|9W2~aJWi|N}|dgK;-H2-/n36]_36 >');
define('NONCE_SALT',       '3xCaxG^`L;TCJk},ZaBNT?ruv|s2VRyCrS/HW3 cGS3nA}kF*J|y`nw|L+DtzY<0');


# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'healthkart' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'WPE_APIKEY', '43647490c4cc7de55c5fb1226596cadc9c8c0ad7' );

define( 'WPE_CLUSTER_ID', '101272' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_LBMASTER_IP', '' );

define( 'WPE_CDN_DISABLE_ALLOWED', true );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'healthkart.wpengine.com', );

$wpe_varnish_servers=array ( 0 => 'pod-101272', );

$wpe_special_ips=array ( 0 => '35.197.254.151', );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( );
define('WPLANG','');

# WP Engine ID


# WP Engine Settings






# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', __DIR__ . '/');
require_once(ABSPATH . 'wp-settings.php');
