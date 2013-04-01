<?php
// NOTE: lives outside webroot for additional security
// set the config file based on current environment
if (strpos($_SERVER['HTTP_HOST'], 'dev.massnailit.com') !== false) {
    $config_file = 'config/dev.php';
}
elseif (strpos($_SERVER['HTTP_HOST'], '127.0.0.1') !== false) {
    $config_file = 'config/dev2.php';
}
elseif (strpos($_SERVER['HTTP_HOST'], 'stage.mni.neueway.com') !== false) {
    $config_file = 'config/stage.php';
}
else {
    $config_file = 'config/prod.php';
}

$path = dirname(__FILE__) . '/';
if (file_exists($path . $config_file)) {
    require_once $path . $config_file;
    $table_prefix  = 'wp_';
    define('DB_HOST', 'localhost');
    define('DB_CHARSET', 'utf8');
    define('DB_COLLATE', '');
    define('AUTH_KEY',         'penguin');
    define('SECURE_AUTH_KEY',  'callie');
    define('LOGGED_IN_KEY',    'cat');
    define('NONCE_KEY',        'dog');
    define('AUTH_SALT',        'ice');
    define('SECURE_AUTH_SALT', 'blah');
    define('LOGGED_IN_SALT',   'bruins');
    define('NONCE_SALT',       'asdf');
    define('WPLANG', '');
    define('WP_DEBUG', true);

    if ( !defined('ABSPATH') )
        define('ABSPATH', dirname(__FILE__) . '/');
    require_once(ABSPATH . 'wp-settings.php');
}
