angular.module('mainCtrl', ['ui.bootstrap'])

.run(function($rootScope, breadcrumbs) {

	// Bind Access variables ----------------------------------------------------

    $rootScope.lvl1 = false;
	$rootScope.lvl2 = false;
	$rootScope.lvl3 = false;
	$rootScope.lvl4 = true;

	$rootScope.authId = false;
	$rootScope.authUsername = false;
	$rootScope.authGroup = false;

	// Bind Breadcrumbs  ----------------------------------------------------

	$rootScope.breadcrumbs = breadcrumbs;

	// UI functionality  ----------------------------------------------------

	$rootScope.sidebar = "sidebar-collapse";
    
    $rootScope.expandSidebar = function(){
        if ($rootScope.sidebar === "sidebar-expand")
            $rootScope.sidebar = "sidebar-collapse";
         else
            $rootScope.sidebar = "sidebar-expand";
    };

})

.controller('accessController', function($rootScope, $scope, $location, $routeParams, $http, Access) {

	$rootScope.pageTitle = '';

	// Define access setter function ----------------------------------------------------

	var setAccess = function(user) {
		$rootScope.authId = user.id;
		$rootScope.authUsername = user.username;
		$rootScope.authGroup = user.group;

		switch (user.role) {
			case 1:
				$rootScope.lvl1 = true;
			case 2:
				$rootScope.lvl2 = true;
			case 3:
				$rootScope.lvl3 = true;
				$rootScope.lvl4 = false;
				break;
			default:
				$rootScope.lvl1 = false;
				$rootScope.lvl2 = false;
				$rootScope.lvl3 = false;
				$rootScope.lvl4 = true;
		}
	}


	// Get User Access Variables -----------------------------------------------

	Access.get()
		.success(function(data) {
			setAccess(data);
		});


	// Define loginData scope object

	$scope.loginData = {};

	// switch flag and failure message

	$scope.switchBool = function(value) {
	   $scope[value] = !$scope[value];
	};

	$scope.failureTextAlert = "We can't find that Email/Password combo. Try again.";



	// Post Login ----------------------------------------------------

	$scope.submitLogin = function() {

		Access.post($scope.loginData)
			.success(function(data) {

				if (data.auth === true) {

					setAccess(data);
					$location.path('/users/' + data.id);
					$scope.loginData.password = '';
				}
				else {
					$scope.showFailureAlert = true;
				}
			});
	};



	// Get Logout ----------------------------------------------------

	$scope.logout = function() {

		Access.getLogout()
			.success(function(data) {

				setAccess(data);
				$location.path('/login');

			});

	};

})



.controller('userController', function($rootScope, $scope, $location, $routeParams, $http, $filter, User, sortable) {

	if ($rootScope.lvl4 === true) {	$location.path('/login'); }

	// Variables ----------------------------------------------------

	$scope.userData = {};

	$scope.params = $routeParams;

	$scope.loading = true;



	// Form Stuff ----------------------------------------------------

	// create values for roles
	$scope.roles = [
		{ label: 'Admin', value: 1 },
		{ label: 'Monkey', value: 2 },
		{ label: 'Sock Monkey', value: 3 }
	];
	$scope.userData.role = $scope.roles[1].value;

	// switch flag
	$scope.switchBool = function(value) {
	   $scope[value] = !$scope[value];
	};

	// create values for groups
	$scope.groups = [
		{ label: 'CSC', value: '381' },
		{ label: 'AdOps', value: '288' },
		{ label: 'Daytona', value: '300' },
		{ label: 'Gadsden', value: '306' },
		{ label: 'Gainesville', value: '309' },
		{ label: 'Hendersonville', value: '312' },
		{ label: 'Houma', value: '315' },
		{ label: 'Lakeland', value: '321' },
		{ label: 'Lexington', value: '324' },
		{ label: 'Ocala', value: '330' },
		{ label: 'Sarasota', value: '342' },
		{ label: 'Spartanburg', value: '354' },
		{ label: 'Tuscaloosa', value: '363' },
		{ label: 'Wilmington', value: '366' },
		{ label: 'Burlington', value: '403' },
		{ label: 'Northwest Florida', value: '410' },
		{ label: 'ENC', value: 'enc' },
		{ label: 'PNC', value: 'pnc' }
	];
	$scope.userData.group = $scope.groups[0].value;



	// SHOW USER PROFILE ----------------------------------------------------

	if($routeParams.id) {

		User.show($routeParams.id)
			.success(function(data) {

				$scope.user = data;
				$scope.userData = angular.copy(data);
				$scope.loading = false;

			});

	}



	// GET ALL USERS ----------------------------------------------------

	else {

		User.get()
			.success(function(data) {
				sortable($scope, data, 7, 'username'); // Implement pagination
			    $scope.numOfItems = '(' + data.length + ')';
				$scope.loading = false;
			});
	}



	// SAVE A USER ----------------------------------------------------

	$scope.submitUser = function() {

		// save the user. pass in user data from the form
		// use the function we created in our service
		User.save($scope.userData)
			.success(function(data) {

				// define the success message
				$scope.successTextAlert = "A new monkey was born today... It was beautiful T_T";

				if(data.success === true) {

					$scope.showSuccessAlert = true;
					$scope.loading = true;

					// if successful, we'll need to refresh the user list
					User.get()
						.success(function(data) {
							sortable($scope, data, 7, 'username');
							$scope.numOfItems = '(' + data.length + ')';
							$scope.loading = false;
						});
				}
				else { $scope.showSuccessAlert = false; }

				// get errors from the response and define it as a scope object.
				$scope.errors = data;
			})
			.error(function(data, status) {
				console.log(data);
			});

	};



	// UPDATE A USER ----------------------------------------------------

	$scope.updateUser = function(id) {

		// update the user. pass in user data from the form
		// use the function we created in our service
		User.update($routeParams.id, $scope.userData)
			.success(function(data) {

				// define the success message
				$scope.successTextAlert = "That Monkey will never be the same :0.";

				if(data.success === true) {

					$scope.showSuccessAlert = true;
					$scope.loading = true;

					// if successful, we'll need to refresh the user list
					User.show($routeParams.id)
						.success(function(data) {
							$scope.user = data;
							$scope.loading = false;
						});
				}
				else { $scope.showSuccessAlert = false; }

				// get errors from the response and define it as a scope object.
				$scope.errors = data;

			})
			.error(function(data) {
				console.log(data);
			});
	};




	// DELETE A USER ----------------------------------------------------

	$scope.deleteUser = function(id) {

		if(confirm("Are you sure to delete this user?")){

			// use the function we created in our service
			User.destroy(id)
				.success(function(data) {

					// define the success message
					$scope.successTextAlert = "And you never saw him again...";

					if(data.success === true) {

						$scope.showSuccessAlert = true;
						$scope.loading = true;

						// if successful, we'll need to refresh the user list
						User.get()
							.success(function(data) {
								sortable($scope, data, 7, 'username');
								$scope.numOfItems = '(' + data.length + ')';
								$scope.loading = false;
							});
					}
					else { $scope.showSuccessAlert = false; }

					// get errors from the response and define it as a scope object.
					$scope.errors = data;

				});
		}
	};

})

.controller('passwordController', function($rootScope, $scope, $location, $http, Pass) {

	if ($rootScope.lvl4 === true) {	$location.path('/login'); }

	// Variables ----------------------------------------------------

	$scope.passwordData = {};


	// Form Stuff ----------------------------------------------------

	// switch flag
	$scope.switchBool = function(value) {
	   $scope[value] = !$scope[value];
	};


	// UPDATE A USER ----------------------------------------------------

	$scope.updatePassword = function() {

		// update the password. pass in user data from the form
		// use the function we created in our service
		Pass.update($scope.passwordData)
			.success(function(data) {

				// define the success message
				$scope.successTextAlert = "Keep it secret! Keep it safe...";

				if(data.success === true) {
					$scope.showSuccessAlert = true;
					$scope.passwordData = {};
				}
				else {	$scope.showSuccessAlert = false; }

				// get errors from the response and define it as a scope object.
				$scope.errors = data;

			})
			.error(function(data) {
				console.log(data);
			});
	};

})

.controller('testController', function($scope, $filter, User, sortable) {

	User.get()
		.success(function(data) {
			sortable($scope, data, 7, 'username');
		});

});