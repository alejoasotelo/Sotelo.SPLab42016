angular.module('app')
.service('Productos', function($http) {
	
	var base_url = '/lab4/Sotelo.SPLab42016/php/api.php';

	this.listar = function () {

		return $http.post(base_url, {datos: {task: 'listar'}}).then(function(r) {

			return r.data.productos;

		});

	}

	this.agregar = function(producto) {

		return $http.post(base_url, { datos: {task: 'agregar', producto: producto}}).then(function(r){

			return r.data.success;

		});
	}

	this.borrar = function(id) {

		return $http.post(base_url, {datos: { task: 'borrar', id: id}}).then(function(r) {

			return r.data.success;

		});

	}

});