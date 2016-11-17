angular.module('app')
.directive('utnFiltro', function (factBanderas) {

	return {
		restrict: 'E',
		templateUrl: 'scripts/directivas/utnFiltro.html',
		scope: {
			url: "@url",
			nombre: "@nombre"
		},
		replace: true
	}

});