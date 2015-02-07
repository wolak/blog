<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Blog extends Controller_Template {

	public function action_login()
	{
		$login = View::factory("login");
		$this->add_script("/assets/js/login.js");
		$this->template->content = $login;
	}

	public function action_logout()
	{
		$this->template->content ="Logout";
	}

	public function action_readers()
	{
		$this->template->content = $this->userlist("Readers", "reader");
	}

	public function action_authors()
	{
		$this->template->content = $this->userlist("Authors", "author");
	}

	public function userlist($title, $user_type)
	{
		$user = View::factory("users");
		$user->title = $title;
		$user->users = ORM::factory($user_type)->find_all();
		return $user;
	}

	public function action_posts()
	{
	}

	public function action_new()
	{
	}
}