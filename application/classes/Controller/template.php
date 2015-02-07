<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Template extends Kohana_Controller_Template {
	/* Holds the scripts to add on page loads. This is very basic. In a complex app, this would ass js and css files, as well be able to add a priority to each file. */
	protected $_scripts = array();

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

	public function after()
	{
		if ( ! $this->request->is_ajax())
		{
			$this->template->scripts = $this->_scripts;
		}
		parent::after();
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

	public function add_script($script)
	{
		$this->_scripts[] = $script;
	}
}