angular.module('app')
.controller('ProductosCtrl', function($scope, $auth, $state){

	$scope.user = {};

	$scope.isAuthenticated = $auth.isAuthenticated();

	if ($scope.isAuthenticated) {
		$scope.user = $auth.getPayload();
	} else {
		$state.go('auth.login');
	}

	$scope.logout = function () {

		$auth.logout().then(function(){

			$scope.isAuthenticated = false;
			$scope.user = {};
			$state.go('auth.login');

		});

	}

});