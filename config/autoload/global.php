<?php
return array(
	'service_manager' => array(
	'factories' => array(
		'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
		),
	),
	'db' => array(
		'driver' => 'Pdo',
    'username' => 'zend',
    'password' => 'zend',
		'dsn' => 'mysql:dbname=iniciandozf2;host=localhost',
 		'driver_options' => array(
 		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
 	),
 ));