<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Blog extends Controller_Template {

	public function action_login()
	{
		$this->template->content ="Login";
	}

	public function action_logout()
	{
		$this->template->content ="Logout";
	}

	public function action_readers()
	{
	}

	public function action_authors()
	{
	}

	public function action_posts()
	{
	}

	public function action_new()
	{
	}
}