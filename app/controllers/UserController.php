<?php

class UserController extends \BaseController {




	/********************************* Login/Logout ***********************************/


	/**
	 * Handle a POST request log the user in.
	 *
	 * @return Response
	 */
	public function postLogin()
	{
		// get all input except for the token
		$email = Input::get('email');
		$password = Input::get('password');
		$remember = Input::get('remember');

		if (Auth::attempt(array('email' => $email, 'password' => $password), $remember)) {

		    return Response::json(
		    	array(
			    	'auth' => true,
			    	'id' => Auth::user()->id,
			    	'username' => Auth::user()->username,
			    	'role' => Auth::user()->role,
			    	'group' => Auth::user()->group,
			    	'remember' => Auth::viaRemember())
		    );

		} else {
			return Response::json(array('auth' => false));
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

    	return Response::json(
    		array(
    			'auth' => false,
    			'id' => false,
    			'username' => false,
    			'role' => 4,
    			'group' => false)
    	);
	}





	/************************************** CRUD ***************************************/

	
	/**
	 * Display a listing of the users.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Response::json(User::get());
	}


	/**
	 * Store a newly created user in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
	    	'email' => 'required|email|unique:users',
	    	'username' => 'required|min:3|unique:users',
	    	'password' => 'required|min:7|regex:/^\S*(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',
	    	'confirmPassword'	=> 'required|same:password',
	    	'role' => 'required|integer|max:3|min:1',
	    	'group' => 'required|min:3|max:3'
	    );

	    $messages = array(
		    'regex' => 'The :attribute must contain at least one lowercase letter, uppercase letter, and number.'
		);

	    $validator = Validator::make(Input::all(), $rules, $messages);


	    if ($validator->fails())
		{
			return Response::json($validator->messages());
		}
		else
		{
			$hashed = Input::get('password');
			$user = new User;
		    $user->username = Input::get('username');
		    $user->password = Hash::make($hashed);
		    $user->email = Input::get('email');
		    $user->role = Input::get('role');
		    $user->group = Input::get('group');
			$user->save();

			return Response::json(array('success' => true));
		}
	}


	/**
	 * Display the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Response::json(User::find($id));
	}


	/**
	 * Update the specified user in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$rules = array(
	    	'email' => 'required|email|unique:users,email,' . $id,
	    	'username' => 'required|min:3|unique:users,username,' . $id,
	    	'role' => 'integer|max:3|min:1'
	    );

		$validator = Validator::make(Input::except('_token'), $rules);

		$user = User::find($id);
	    $user->username = Input::get('username');
	    $user->email = Input::get('email');
	    $user->role = Input::get('role');
	    $user->group = Input::get('group');

		if ($validator->fails())
		{
			return Response::json($validator->messages());
		}
		else
		{
		    $user->save();
		    return Response::json(array('success' => true));
		}	    
	}


	/**
	 * Remove the specified user from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$user = User::find($id);
		$user->delete();

		return Response::json(array('success' => true));
	}





	/************************************** Change Password ***************************************/


	/**
	 * Show the form for changing your password.
	 *
	 * @return Response
	 */
	public function getPassword()
	{
		return View::make('user.password');
	}

	/**
	 * Show the form for changing your password.
	 *
	 * @return Response
	 */
	public function putPassword()
	{


		$id = Auth::user()->id;
		$user = User::find($id);
		$hashedPassword = Auth::user()->password;

		if (Hash::check(Input::get('password'), $hashedPassword)) {

			$rules = array(
		    	'newPassword'		=> 'required|min:7|regex:/^\S*(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/',
		    	'confirmPassword'	=> 'required|same:newPassword'
		    );

		    $messages = array(
			    'regex' => 'The :attribute must contain at least one lowercase letter, uppercase letter, and number.'
			);

		    $validator = Validator::make(
		    	array(
			    	'newPassword'		=> Input::get('newPassword'),
			    	'confirmPassword'	=> Input::get('confirmPassword')
		    	),
		    	$rules,
		    	$messages
		    );


		    if ($validator->fails())
			{
				return Response::json($validator->messages());
			}
			else
			{

			    $user->password = Hash::make(Input::get('newPassword'));
				$user->save();

				return Response::json(array('success' => true));
			}

		}
		else {
			return Response::json(array('password' => ['That does not match your current password.']));
		}
	}
}
