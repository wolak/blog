<?php defined('SYSPATH') OR die('No direct access allowed.');

return array(
	//This is the Auth Driver class to load
	'driver'       => 'blog',
	'hash_method'  => 'sha256',
	'hash_key'     => 'kG4U~Yxg2C}3^f~b$n;[DIw4NhziO=Qy',  //Random hash Key
	'lifetime'     => 1209600,
	'session_type' => Session::$default,
	'session_key'  => 'auth_user',
);
