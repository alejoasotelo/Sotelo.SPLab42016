angular.module('app')
.service('Usuarios', function($http) {
	
	var base_url = '/lab4/Sotelo.SPLab42016/php/api.php';

	this.listar = function (filtro) {

		return $http.post(base_url, {datos: {task: 'listarUsuarios'}}).then(function(r) {

			if (filtro == '')
				return r.data.usuarios;
			else {
				var usuarios = r.data.usuarios;
				var ret = [];
				for(var i=0; i < usuarios.length; i++) {

					if(usuarios[i].tipo == filtro)
						ret.push(usuarios[i]);
				}

				return ret;

			}

		});

	}

	this.agregar = function(usuario) {

		return $http.post(base_url, { datos: {task: 'agregarUsuario', usuario: usuario}}).then(function(r){

			return r.data.success;

		});
	}

	this.borrar = function(id) {

		return $http.post(base_url, {datos: { task: 'borrarUsuario', id: id}}).then(function(r) {

			return r.data.success;

		});

	}

	this.get = function (id) {

		return $http.post(base_url, {datos: { task: 'traerUsuario', id: id}}).then(function(r) {

			return r.data.usuario;

		});

	}

	this.guardar = function(usuario) {

		return $http.post(base_url, { datos: {task: 'guardarUsuario', usuario: usuario}}).then(function(r){

			return r.data.success;

		});
	}

});