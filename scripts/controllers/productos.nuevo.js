angular.module('app')
.controller('ProductosNuevoCtrl', function($scope, $auth, $state, Productos){

	$scope.alertas = '';
	$scope.producto = {};

	$scope.user = $auth.getPayload();

	if ($scope.user.tipo == 'comprador')
 	{
 		$state.go('productos.listar');
 	}


	$scope.guardar = function() {

		console.log($scope.producto);

		Productos.agregar($scope.producto).then(function(success){

			console.log(success);

			if (success) {
				$state.go('productos.listar');
			} else {
				$scope.alertas = 'Error al agregar el producto.';
			}

		})

	}

});