<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Auth extends Controller {

	public function action_login()
	{
		$post = $this->request->post();
		$success = Auth::instance()->login('reader1', 'password');
		// if login was successfull, redirect to application. 		 
		if ($success)
		{
		    $msg = "okay!";
		}
		else
		{
		    $msg = "Nope!";// Login failed, try again
		}
		$this->response->body($msg);
	}
} // End Welcome
