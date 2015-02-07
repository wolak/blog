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
		$this->add_script('/assets/js/postview.js');
		$posts = View::factory("posts");
		$posts->posts = ORM::factory('post')->order_by('created_on', 'desc')->find_all();
		$this->template->content = $posts;
	}

	public function action_new()
	{
		$this->add_script('/assets/js/newblog.js');
		$this->template->content = View::factory("newpost");
	}

	public function action_new_post()
	{
		$data = $this->request->post();
		$post = ORM::factory("post");
		$post->title = $data['title'];
		$post->post = $data['content'];
		$post->user_id = Auth::instance()->get_user()->id;
		$post->save();
	}

	public function action_delete_post()
	{
		$data = $this->request->post();
		//Load the post id and try to delete it.
		$post = ORM::factory("post", $data['post_id']);
		$post->delete();
	}
}