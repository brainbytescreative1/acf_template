<?php
# Database Configuration
define( 'DB_NAME', 'wp_templatebbc' );
define( 'DB_USER', 'templatebbc' );
define( 'DB_PASSWORD', 'WcNBuN3cWV14wjPfrCcT' );
define( 'DB_HOST', '127.0.0.1:3306' );
define( 'DB_HOST_SLAVE', '127.0.0.1:3306' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         '4NS-K17t][-n]W!{V-@>6p!&RK?WJvLa],89C[I)Cbw}?gq-l/ 5x8zx+:|WO#~_');
define('SECURE_AUTH_KEY',  '1|+C#2!5v|a-dg+-=7[+iV)9kM<T#%kNam#ay#VDQ0K~T8+&?jCf[1heE`.Lp-fj');
define('LOGGED_IN_KEY',    '-?qJOd9s5xE;sGR+y{|9ZTim#.fW~|IxiO.L3OZ4lYs]),!Sw.^+0iT8({#ln|Dr');
define('NONCE_KEY',        'onfUS=4[18t+N5xB+:G;2n:-Qk~]9X8wZN]--s<nT///!y !|Q(LBTWo{8/eHVeb');
define('AUTH_SALT',        'rX,@f]gx8_d<IzbS#k|I#{-/1{$P68,dCq[s4L=|`$of+8^Y?UW|G5-mh(JnWq,f');
define('SECURE_AUTH_SALT', '-!OLYm!um37-AtV(~HFw`p&a|?D0l:VF]M4bsgXgyRJBkD?R-*l2zAy8}nFToOdG');
define('LOGGED_IN_SALT',   'jr-=C^p*JvCZPJ_A*eu/Qz`C-09S`nB9txj&fjUJ&RL?.w<?[^a>?J+&VH 4:-g+');
define('NONCE_SALT',       'f[-97Hs@Tl,d1N6,G}-pq^6R!?8}kxunaQEYg@*KKH=N[)#Vl9@@myb=,eH4eOcC');


# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'templatebbc' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'WPE_APIKEY', '5951403aaff5e39fbfcd556af134e9d2a0e15066' );

define( 'WPE_CLUSTER_ID', '111167' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_SFTP_ENDPOINT', '' );

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

$wpe_all_domains=array ( 0 => 'templatebbc.wpengine.com', 1 => 'templatebbc.wpenginepowered.com', );

$wpe_varnish_servers=array ( 0 => 'pod-111167', );

$wpe_special_ips=array ( 0 => '104.196.159.200', );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( 'default' =>  array ( 0 => 'unix:///tmp/memcached.sock', ), );
define('WPLANG','');

# WP Engine ID


# WP Engine Settings

define( 'WP_DEBUG', true );
define( 'WP_DEBUG_DISPLAY', true );
define('RECOVERY_MODE_EMAIL', 'foo@bar.com');

define('ALLOW_UNFILTERED_UPLOADS', true);


# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', __DIR__ . '/');
require_once(ABSPATH . 'wp-settings.php');
