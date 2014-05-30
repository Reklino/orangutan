angular.module('mainService', [])

.factory('Access', function($http) {

	return {
		// get user role
		get : function() {
			return $http.get('/api/role');
		},

		post : function(loginData) {
			return $http({
				method: 'POST',
				url: '/api/login',
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param(loginData)
			});
		},

		getLogout : function() {
			return $http.get('/api/logout');
		}
	}

})

.factory('User', function($http) {

	return {
		// get all the users
		get : function() {
			return $http.get('/api/users');
		},

		// show a user
		show : function(id) {
			return $http.get('/api/users/' + id);
		},

		// save a user (pass in user data)
		save : function(data) {
			return $http({
				method: 'POST',
				url: '/api/users',
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param(data)
			});
		},

		// update a user (pass in user data and id)
		update : function(id, data) {
			return $http({
				method: 'PUT',
				url: '/api/users/' + id,
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param(data)
			});
		},

		// destroy a user
		destroy : function(id) {
			return $http.delete('/api/users/' + id);
		}
	}

})

.factory('Pass', function($http) {

	return {
		
		// update a password
		update : function(passwordData) {
			return $http({
				method: 'PUT',
				url: '/api/password',
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
				data: $.param(passwordData)
			});
		}

	}

});