<?php defined('SYSPATH') or die('No direct script access.');
return array
(
	'default' => array(
		'type' => 'mysql',
		'connection' => array(
			'hostname' => 'localhost',
			'database' => 'blog',
			'username' => 'root',
			'password' => '',
			'persistent' => FALSE,
			),
		'table_prefix' => '',
		'charset' => 'utf8',
		'caching' => FALSE,
		'profiling' => TRUE,
		),
);