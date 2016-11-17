angular.module('app')
.controller('AuthLoginCtrl', function($scope, $auth, $state){

	$scope.user = {};

	$scope.UsuariosTest = {

		COMPRADOR: {
			nombre: 'comprador',
			correo: 'comp@comp.com',
			clave: '123'
		},
		ADMIN: {
			nombre: 'admin',
			correo: 'admin@admin.com',
			clave: '321'
		},
		VEND: {
			nombre: 'vend',
			correo: 'vend@vend.com',
			clave: '321'
		}
	};

	$scope.isAuthenticated = $auth.isAuthenticated();

	$scope.login = function() {

		$scope.alertas = '';

		$auth.login($scope.user).then(function(response) {

			console.log('login.success', response);

			if (response.data.mitoken != false) {
				console.log('mitoken != false');

    			// Redirect user here after a successful log in.
    			$scope.isAuthenticated = $auth.isAuthenticated();
				$scope.user = $auth.getPayload();

				$state.go('productos.listar');

			} else {
				$scope.alertas = 'Datos incorrectos.';
			}

    	}).catch(function(response) {

			$scope.alertas = 'No se pudo iniciar sesión.';
		
		});

	}

	$scope.loginTest = function(user_test) {

		$scope.user = user_test;

	}

});