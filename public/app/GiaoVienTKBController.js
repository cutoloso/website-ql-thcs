app.controller('GiaoVienTKBController',function($scope,$http,URL_Main){
	$scope.gv_ma = user_name;

	var d = new Date();
	var yearNow = d.getFullYear();
	var monthNow = d.getMonth();

	$scope.khoi = function(kh_khoaHoc){
		var kh;
		if (monthNow <6 ) {
			var y = yearNow;
		}
		else {
			var y = yearNow+1;
		}
		switch (y - parseInt(kh_khoaHoc)){
			case 4: 
				kh = 9;
				break;
			case 3: 
				kh = 8;
				break;
			case 2: 
				kh = 7;
				break;
			case 1: 
				kh = 6;
				break;
		}
		if (y - parseInt(kh_khoaHoc) >4) kh = 9;
		return kh;
	}


	function fillData() {

		$http.get(URL_Main+'tkb-gv/ma-gv/'+$scope.gv_ma+'/hoc-ky/'+$scope.hk_hocKy).then(function(response){
			$scope.ds_tkb = response.data.message.ds_tkb;
			console.log($scope.ds_tkb);
			console.log('fill data');
		});
	}

// // cập nhật lại bảng
$scope.reLoadPage = function() {
	if (typeof $scope.hk_hocKy != "undefined") {
				fillData();
				console.log($scope.hk_hocKy);
	}
}
// Sắp xếp mã tăng dần hoặc giảm dần
$scope.sortExpression = 't_ma';
$scope.sortReverse = false;
$scope.sort = function() {
	$scope.sortReverse = !$scope.sortReverse;
}

});