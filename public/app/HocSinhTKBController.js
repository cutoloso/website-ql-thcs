app.controller('HocSinhTKBController',function($scope,$http,URL_Main){
	$scope.tkb = {};
	$scope.user_name = user_name;
	$scope.thu = function(t_ma) {
		switch (t_ma) {
			case 'T2':
			return '2';

			case 'T3':
			return '3';

			case 'T4':
			return '4';

			case 'T5':
			return '5';

			case 'T6':
			return '6';

			case 'T7':
			return '7';
		}
	}

	var d = new Date();
	var yearNow = d.getFullYear();

	$http.get( URL_Main+'hoc-sinh/'+$scope.user_name).then(function(response){
		$scope.hs = response.data.message.hs;
	});


	
	
	function fillData() {
		$http.get(URL+'tkb/'+ $scope.hk_hocKy +'/hoc-ky/'+ $scope.hs.kh_khoaHoc +'/khoa-hoc/'+$scope.hs.l_ma+'/ma-lop').then(function(response){
			$scope.ds_tkb = response.data.message.ds_tkb;
			console.log($scope.ds_tkb);
			console.log('fill data');
		});
	}

// // cập nhật lại bảng
$scope.reLoadPage = function() {
	if (typeof $scope.hk_hocKy != "undefined") {
		fillData();
		console.log($scope.hs.kh_khoaHoc + $scope.hk_hocKy+$scope.hs.l_ma);
	}
}
// Sắp xếp mã tăng dần hoặc giảm dần
$scope.sortExpression = 't_ma';
$scope.sortReverse = false;
$scope.sort = function() {
	$scope.sortReverse = !$scope.sortReverse;
}
});