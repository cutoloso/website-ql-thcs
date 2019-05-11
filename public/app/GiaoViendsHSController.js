app.controller('GiaoViendsHSController',function($scope,$http,URL_Main){
	$scope.gv_ma = user_name;

	var d = new Date();
	var yearNow = d.getFullYear();
	var monthNow = d.getMonth();

	function khoi(kh_khoaHoc){
		if (monthNow <6 ) {
			var y = yearNow;
		}
		else {
			var y = yearNow+1;
		}
		switch (y - parseInt(kh_khoaHoc)){
			case 4: 
				$scope.khoi = 9;
				break;
			case 3: 
				$scope.khoi = 8;
				break;
			case 2: 
				$scope.khoi = 7;
				break;
			case 1: 
				$scope.khoi = 6;
				break;
		}
		if (y - parseInt(kh_khoaHoc) >4) $scope.khoi = 9;
	}

	function fillData() {
		$http.get(URL_Main + 'lop/ma-gv/'+ $scope.gv_ma ).then(function(response){
			$scope.lop = response.data.message.lop;
		}).then(function(){
			$http.get(URL_Main + 'hoc-sinh/'+ $scope.lop.kh_khoaHoc + '/'+ $scope.lop.l_ma).then(function(response){
				khoi($scope.lop.kh_khoaHoc);
				$scope.ds_hs = response.data.message.ds_HocSinh;
			});
		});
		
		console.log('fillData');
	}

fillData();
// Sắp xếp mã tăng dần hoặc giảm dần
$scope.sortExpression = 'hs_ma';
$scope.sortReverse = false;
$scope.sort = function() {
	$scope.sortReverse = !$scope.sortReverse;
}


});