angular.module('app')
.controller('AuthCtrl', function($scope, $auth, $state){

	$scope.user = {};

	$scope.isAuthenticated = $auth.isAuthenticated();

	if ($scope.isAuthenticated) {
		$state.go('productos.listar');
	}

	$scope.logout = function () {

		$auth.logout().then(function(){

			$scope.isAuthenticated = false;
			$scope.user = {};
			$state.go('auth.login');

		});

	}

});