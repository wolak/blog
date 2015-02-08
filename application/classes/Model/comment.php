<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Comment extends ORM {

	protected $_belongs_to = array(
		'post' => array(
			'model' => 'post',
			'foreign_key' => 'post_id'
		),
	);

	public function delete()
	{
		if ($this->can_user_delete())
		{
			parent::delete();
		}
	}

	public function save(Validation $validation = NULL)
	{
		if (isset($this->user_id))
		{
			if (Auth::instance()->get_user()->id !== $this->user_id)
			{
				return FALSE;
			}
		}
		else
		{
			$this->user_id = Auth::instance()->get_user()->id;
		}
		parent::save($validation);
	}
	
	public function update(Validation $validation = NULL)
	{
		// Only users that created the comment can update it
		if (Auth::instance()->get_user()->id === $this->user_id)
		{
			parent::update($validation);
		}
	}

	public function can_user_update()
	{
		return Auth::instance()->get_user()->id === $this->user_id;
	}

	public function can_user_delete()
	{
		//Comments can be deleted by blog post authors or deleted by comment author
		$is_author = $this->can_user_update();
		return ($is_author OR ($this->post->user_id == Auth::instance()->get_user()->id));
	}
}