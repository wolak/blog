<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Author extends Model_User {
	
	public function __construct($id = NULL)
	{
		$user_type_id = ORM::factory('user_type')->where('type', '=', 'author')->find()->id;
		parent::__construct($id);
		$this->where('user_type_id', '=', $user_type_id);
	}
}
