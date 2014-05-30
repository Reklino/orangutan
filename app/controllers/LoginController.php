<?php

class LoginController extends BaseController {

	/**
	 * Display the user login view unless user is logged in.
	 *
	 * @return Response
	 */
	public function getLogin()
	{
		if (Auth::check())
		{
			$id = Auth::user()->id;
			$user = User::find($id);
		    return View::make('user.profile', array('user' => $user));
		}

		else
		{
			return View::make('user.login');
		}
	}

	/**
	 * Handle a POST request log the user in.
	 *
	 * @return Response
	 */
	public function postLogin()
	{
		$credentials = array(
	        'email'		=> Input::get('email'),
	        'password'	=> Input::get('password')
	    );

		if (Auth::attempt($credentials))
		{
			$id = Auth::user()->id;
			$user = User::find($id);
		    return View::make('user.profile', array('user' => $user));
		}
	}


	/**
	 * Handle Logouts and redirect to the login page.
	 *
	 * @return Response
	 */
	public function logout()
	{
		Auth::logout();
    	return Redirect::intended('login');
	}

}
