angular.module('app')
.controller('UsuariosEditarCtrl', function($scope, $auth, $state, Usuarios, $stateParams){

	$scope.alertas = '';
	$scope.producto = {};

	$scope.user = $auth.getPayload();
	$scope.usuario = {};


	$scope.guardar = function() {

		console.log($scope.usuario);

		Usuarios.guardar($scope.usuario).then(function(success){

			console.log(success);

			if (success) {
				$state.go('usuarios.listar');
			} else {
				$scope.alertas = 'Error al agregar el usuario.';
			}

		})

	}

	function cargarUsuario(id) {

		Usuarios.get(id).then(function(u){

			$scope.usuario = u;
			console.log($scope.usuario);

		});
	}

	cargarUsuario($stateParams.id);

});