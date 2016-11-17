angular.module('app')
.controller('UsuariosCtrl', function($scope, $auth, $state){

	$scope.user = {};

	$scope.isAuthenticated = $auth.isAuthenticated();

	if ($scope.isAuthenticated) {
		$scope.user = $auth.getPayload();

		if ($scope.user.tipo != 'administrador') {
			$state.go('productos.listar');
		}

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