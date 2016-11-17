angular.module('app')
.controller('UsuariosNuevoCtrl', function($scope, $auth, $state, Usuarios){

	$scope.alertas = '';
	$scope.producto = {};

	$scope.user = $auth.getPayload();
	$scope.usuario = {};


	$scope.guardar = function() {

		console.log($scope.usuario);
		Usuarios.agregar($scope.usuario).then(function(success){

			console.log(success);

			if (success) {
				$state.go('usuarios.listar');
			} else {
				$scope.alertas = 'Error al agregar el usuario.';
			}

		});

	}

});