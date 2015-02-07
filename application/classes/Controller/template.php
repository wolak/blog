<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Template extends Kohana_Controller_Template {

	public function before()
	{
	    parent::before();
	    if ($this->auto_render === TRUE)
    	{
    		$navbar = View::factory("navigation");
    		$navbar->active = $this->request->action();
    		$this->template->navbar = $navbar;
    		$this->template->logged_in = Auth::instance()->logged_in();
    		$this->template->content = "";
    	}
	}

	public function action_index()
	{
		$auth = Auth::instance();
		$auth->login("reader1","asdf");
		if ($auth->logged_in())
		{
			$msg = "okay";
		}
		else
		{
			$msg = "Nope";
		}
		$this->template->msg =  $msg;
	}

}