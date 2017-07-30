<?php

$attributes = [];
$ssl_ca = $ssl_cert = $ssl_key = '';
if(($ssl_ca = getenv('DB_SSL_CA') && $ssl_ca) &&
	($ssl_cert = getenv('DB_SSL_CERT') && $ssl_cert) &&
	($ssl_key = getenv('DB_SSL_KEY') && $ssl_key)) {
		$attributes[PDO::MYSQL_ATTR_SSL_CA] = $ssl_ca;
		$attributes[PDO::MYSQL_ATTR_SSL_CERT] = $ssl_cert;
		$attributes[PDO::MYSQL_ATTR_SSL_KEY] = $ssl_key;
}

return [
    'class' => 'app\components\DbConnection',
    'dsn' => 'mysql:host='.getenv('DB_HOST').';dbname='.getenv('DB_NAME'),
    'username' => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD'),
    'charset' => 'utf8',
	'attributes' => $attributes,
    'on afterOpen' => function($event) {
	    $event->sender->createCommand("SET time_zone='-05:00';")->execute();
    },
];
