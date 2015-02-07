<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_User extends ORM {
	protected $_table_name = "users";

	public function is_author()
	{
		return $this->user_type_id === ORM::factory('user_type')->where('type', '=', 'author')->find()->id;
	}
}