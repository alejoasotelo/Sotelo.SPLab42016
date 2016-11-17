angular.module('app')
.controller('ProductosListarCtrl', function($scope, $auth, $state, Productos){

	$scope.productos = [];

	$scope.user = $auth.getPayload();

	$scope.cargarProductos = function () {

		Productos.listar().then(function(productos) {

			$scope.productos = productos;

		});

	}

	$scope.borrar = function(id) {

		if (confirm('Desea eliminarlo?')) {
			Productos.borrar(id).then(function(r) {

				$scope.cargarProductos();

			});
		}
	}

	$scope.cargarProductos();

});