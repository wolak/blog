<?php defined('SYSPATH') OR die('No direct access allowed.');

class Auth_Blog extends Auth
{
    /* Do username/password check here.  Since passwords are not required for the exercise, skipping password chequing  */
    protected function _login($username, $password = NULL, $remember = FALSE)
    {
        if ( ! is_object($username))
        {
            // Load the user
            $user = ORM::factory('user');
            $user->where('username', '=', $username)
                ->find();
            if ($user->loaded())
            {
                $this->complete_login($user);
                return true;
            }
        }
        //Invalid login
        return FALSE;
    }
 
    //Not implemented but required by abstract class
    public function password($username) {}
    
    //Not implemented but required by abstract class
    public function check_password($password) {}
    
    //Store the user in the session
    public function complete_login($user)
    {
        $this->_session->set($this->_config['session_key'], $user);
    }

    //Return true if the user is logged_in, else false
    public function logged_in($role = NULL)
    {
        return ($this->get_user() !== NULL);
    }
    
    //Return the logged in user from the session
    public function get_user($default = NULL)
    {
        // Get the logged in user, or return the $default if a user is not found
        return $this->_session->get($this->_config['session_key'], $default);
    }
}