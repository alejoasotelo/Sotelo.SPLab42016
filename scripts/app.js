angular.module('app', ['ui.router', 'satellizer'])
.config(function ($stateProvider, $urlRouterProvider, $authProvider) {

	$authProvider.loginUrl = '/lab4/Sotelo.SPLab42016/php/auth.php';
	$authProvider.tokenName = 'segundoparcial';
	$authProvider.tokenPrefix = 'Aplicacion';
	$authProvider.authHeader = 'data';

	$stateProvider
	.state('auth', {
		url: '/auth',
		abstract: true,
		templateUrl: 'views/auth.html',
		controller:'AuthCtrl'
	})
	.state('auth.login', {
		url: '/login',
		views: {
			'contenido': {
				templateUrl: 'views/login.html',
				controller:'AuthLoginCtrl'	
			} 
		}
	})
	.state('productos', {
		url: '/productos',
		abstract: true,
		templateUrl: 'views/productos.html',
		controller:'ProductosCtrl'
	})
	.state('productos.listar', {
		url: '/listar',
		views: {
			'contenido': {
				templateUrl: 'views/productos.listar.html',
				controller:'ProductosListarCtrl'	
			} 
		}
	})
	.state('productos.nuevo', {
		url: '/nuevo',
		views: {
			'contenido': {
				templateUrl: 'views/productos.nuevo.html',
				controller:'ProductosNuevoCtrl'	
			} 
		}
	})


	.state('usuarios', {
		url: '/usuarios',
		abstract: true,
		templateUrl: 'views/usuarios.html',
		controller:'UsuariosCtrl'
	})
	.state('usuarios.listar', {
		url: '/listar',
		views: {
			'contenido': {
				templateUrl: 'views/usuarios.listar.html',
				controller:'UsuariosListarCtrl'	
			} 
		}
	})
	.state('usuarios.nuevo', {
		url: '/nuevo',
		views: {
			'contenido': {
				templateUrl: 'views/usuarios.nuevo.html',
				controller:'UsuariosNuevoCtrl'	
			} 
		}
	})
	.state('usuarios.editar', {
		url: '/editar/:id',
		views: {
			'contenido': {
				templateUrl: 'views/usuarios.editar.html',
				controller:'UsuariosEditarCtrl'	
			} 
		}
	})

	$urlRouterProvider.otherwise('auth/login');

})