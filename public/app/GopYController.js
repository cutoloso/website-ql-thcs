app.controller('GopYController',function($scope,$http,URL_Main){
	
	$scope.gy = {
		'cd_ma':'',
		'gy_nguoiGY':''

	};
	
	var url = window.location.href;
	$scope.gy.cd_ma = url.substring(url.lastIndexOf("/")+1);
	$scope.gy.loai = url.substring(url.lastIndexOf("/")-4,url.lastIndexOf("/"));
	$scope.loai_gy  = $scope.gy.loai ;
	$http.get(URL_Main + 'chu-de-gop-y/'+$scope.gy.loai+'/'+$scope.gy.cd_ma).then(function(response){
		if ($scope.gy.loai == 'gvhs') {
			$scope.chuDe = response.data.message.ChuDe[0].cd_gvhs_ten;
		} else {
			$scope.chuDe = response.data.message.ChuDe[0].cd_gvph_ten;
		}
	});

	function fillData() {
		$http.get(URL_Main + 'dsgopy/'+ $scope.gy.loai +'/'+$scope.gy.cd_ma).then(function(response){
			$scope.ds_gy = response.data.message.ds_GopY;
		});
	}
	fillData();
	$scope.compare = function ($nguoiGY,$name) {
		return $nguoiGY == $name;
	}
	$scope.submit = function($name){
		$scope.gy.gy_nguoiGY = $name;
		var data = $.param($scope.gy);
		$http({
		  	method: 'POST',
		  	url: URL_Main + 'gop-y',
		  	data: data,
		  	headers: {'Content-Type' : 'application/x-www-form-urlencoded'}
		  	}).then(function(response) {
				fillData();
			  	}, function (error) {
			    console.log(error);
			  	});
		$scope.gy.gy_noiDung = "";
	}
});