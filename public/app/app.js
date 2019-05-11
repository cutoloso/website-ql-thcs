var app = angular.module('my-app',[],function($interpolateProvider){
	$interpolateProvider.startSymbol('<%');
	$interpolateProvider.endSymbol('%>');

});
//XAMPP-localhost
	app.constant('URL', 'http://localhost/ql-thcs/public/');
	app.constant('URL_Main', 'http://localhost/ql-thcs/public/quan-tri/');

//Heroku

//app.constant('URL', 'http://ql-thcs.herokuapp.com/');
//app.constant('URL_Main', 'http://ql-thcs.herokuapp.com/quan-tri/');

//LAN

 // app.constant('URL_Main', 'http://192.168.1.253:8000');
// app.constant('URL_Main', 'http://192.168.1.253:8000/quan-tri/');
