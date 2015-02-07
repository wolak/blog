<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Post extends ORM {

	public function delete()
	{
		// Only users that created the post can delete it
		if (Auth::instance()->get_user()->id == $this->user_id)
		{
			parent::delete();
		}
	}

	public function update(Validation $validation = NULL)
	{
		// Only users that created the post can update it
		if (Auth::instance()->get_user()->id == $this->user_id)
		{
			parent::update($validation);
		}
	}
}