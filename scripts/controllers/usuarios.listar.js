angular.module('app')
.controller('UsuariosListarCtrl', function($scope, $auth, $state, Usuarios){

	$scope.usuarios = [];

	$scope.user = $auth.getPayload();
	$scope.filtroTipo = '';

	$scope.cargarUsuarios = function () {

		Usuarios.listar($scope.filtroTipo).then(function(usuarios) {

			$scope.usuarios = usuarios;

		});

	}

	$scope.borrar = function(id) {

		if (confirm('Desea eliminarlo?')) {
			Usuarios.borrar(id).then(function(r) {

				$scope.cargarUsuarios();

			});
		}
	}

	$scope.cambioFiltroTipo = function() {
		$scope.cargarUsuarios(); 
	}

	$scope.cargarUsuarios();

});