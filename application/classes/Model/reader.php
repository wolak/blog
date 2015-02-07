<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Reader extends Model_User {
	
	public function __construct($id = NULL)
	{
		$user_type_id = ORM::factory('user_type')->where('type', '=', 'reader')->find()->id;
		parent::__construct($id);
		$this->where('user_type_id', '=', $user_type_id);
	}
}
