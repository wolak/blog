<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller {

	public function action_login()
	{
		$username = $this->request->post('username');
		$success = Auth::instance()->login($username, 'password');
		// if login was successful, redirect to application. 		 
		if ($success)
		{
			$this->response->body(Route::url('default', array('controller' => 'blog', 'action' => 'readers')));
		}
		else
		{
			//Login was not successful. Try again
			$this->response->body("error");
		}
	}

	public function action_logout()
	{
		Auth::instance()->logout();
		$this->redirect(Route::url('default', array('controller' => 'blog', 'action' => 'login')));
	}

}
