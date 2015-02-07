<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Template extends Kohana_Controller_Template {
	/* Holds the scripts to add on page loads. This is very basic. In a complex app, this would ass js and css files, as well be able to add a priority to each file. */
	protected $_scripts = array();

	public function before()
	{
		if ($this->request->is_ajax())
		{
			$this->auto_render = FALSE;
		}
	    parent::before();
    	$auth = Auth::instance();
    	/* If the user is not logged in, redirect them to login*/
	    if ( ! $auth->logged_in())
	    {
    		if ( $this->request->action() !== "login")
    		{
    			$this->redirect(Route::url('default', array('controller' => 'blog', 'action' => 'login')));
    		}
	    }
	    if ($this->auto_render === TRUE)
    	{
    		$is_author = FALSE;
    		if ($auth->logged_in())
    		{
    			$is_author = $auth->get_user()->is_author();
    		}
    		$navbar = View::factory("navigation");
    		$navbar->is_author = $is_author;
    		$navbar->active = $this->request->action();
    		$this->template->navbar = $navbar;
    		$this->template->logged_in = $auth->logged_in();
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