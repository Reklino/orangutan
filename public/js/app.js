var app = angular.module('app', ['mainCtrl', 'mainService', 'ngRoute', 'ngAnimate', 'sortable', 'services.breadcrumbs']);

// configure our routes
	app.config(function($routeProvider, $locationProvider) {
		$routeProvider

			// route for the home page
			.when('/', {
				templateUrl : 'templates/home.html'
			})

			// route for the login page
			.when('/login', {
				templateUrl : 'templates/login.html'
			})

			// route for the users page
			.when('/users', {
				templateUrl : 'templates/users.html',
				controller  : 'userController'
			})

			// route for the profile page
			.when('/users/:id', {
				templateUrl : 'templates/user.html',
				controller  : 'userController'
			})

			// route for the password change page
			.when('/password', {
				templateUrl : 'templates/password.html',
				controller  : 'passwordController'
			})

			// route for the test page
			.when('/test', {
				templateUrl : 'templates/test.html',
				controller  : 'testController'
			})

			// otherwise, go here
			.otherwise({
		        redirectTo: '/'
		    });

		    $locationProvider.html5Mode(true);

	});