app.controller('HomeController',function($scope,$http,URL_Main){

	$scope.modal = function(){
		console.log('ok');
		// Hiện form
		$('#myModal').modal('show');
	}

});