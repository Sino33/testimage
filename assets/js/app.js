var myApp = angular.module('myApp',['ngRoute']);
myApp.config(function($routeProvider){
	$routeProvider
	.when('/', {
		templateUrl: 'views/main.html',
		controller: 'main'
	})
	.otherwise({
		redirectTo: '/'
	});
});