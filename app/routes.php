<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
*/

// Routes for password reset process. See the RemindersController.
Route::controller('password', 'RemindersController');


// Route group for authorization
Route::group(array('before' => 'auth'), function()
{
    
});

Route::get('', function()
{
	return View::make('index'); // will return app/views/index.php
});

// Prefix API and load resource controllers
Route::group(array('prefix' => 'api'), function() {

	Route::get('login', 'UserController@getLogin');
	Route::post('login', 'UserController@postLogin');


	// Require Login
	Route::group(array('before' => 'auth'), function() {

		Route::get('logout', 'UserController@logout');

		// Create a role request (will be used by the custom angularjs Access service)
		Route::get('role', function()
		{
		    return Response::json(
		    	array(
			    	'auth' => true,
			    	'id' => Auth::user()->id,
			    	'username' => Auth::user()->username,
			    	'role' => Auth::user()->role,
			    	'group' => Auth::user()->group,
			    	'remember' => Auth::viaRemember())
		    );
		});


		// Allow any logged in user to view users and their profiles
		Route::resource('users', 'UserController', 
			array('only' => array('index','show')));

		// Set routes for changing passwords
		Route::get('password', 'UserController@getPassword');
		Route::put('password', 'UserController@putPassword');
		

		// Require Admin
		Route::group(array('before' => 'admin'), function() {


			// Require admin for users to create, update, or destroy users
			Route::resource('users', 'UserController', 
				array('only' => array('store', 'update', 'destroy')));


		});
		
	});

});



// =============================================
// CATCH ALL ROUTE =============================
// =============================================
// all routes that are not home or api will be redirected to the frontend
// this allows angular to route them
App::missing(function($exception)
{
	return View::make('index');
});






