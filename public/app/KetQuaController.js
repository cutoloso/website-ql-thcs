app.controller('KetQuaController',function($scope,$http,URL_Main){
	var d = new Date();
	var yearNow = d.getFullYear();
	$scope.year = yearNow;
	function fillLop() {
		switch ($scope.khoi) {
			case '9':
			$scope.kh_khoaHoc = yearNow-4;
			break;
			case '8':
			$scope.kh_khoaHoc = yearNow-3;
			break;
			case '7':
			$scope.kh_khoaHoc = yearNow-2;
			break;
			case '6':
			$scope.kh_khoaHoc = yearNow-1;
			break;
		}
		$http.get(URL+'lop/'+ $scope.kh_khoaHoc +'/khoa-hoc').then(function(response){
			$scope.ds_lop = response.data.message.ds_Lop;
		});
	}
	// fillLop();
	
	function fillData() {

		$http.get(URL_Main + 'hoc-sinh/'+ $scope.kh_khoaHoc + '/'+ $scope.l_ma).then(function(response){
			$scope.ds_hs = response.data.message.ds_HocSinh;
		});
	}

	// Tính điểm trung bình cả năm của học sinh
	$scope.diemTBCN = function(hs_ma){
		var diem = 0;
		$http.get(URL+'ket-qua/diemTBCN/'+ hs_ma + '/hs-ma/'+ $scope.hk_hocKy+'/hoc-ky')
		.then(function(response){
			if (typeof response.data.message.diemTBCN != "undefined") {
				diem = response.data.message.diemTBCN;
			}
			setTimeout(function(){ console.log(diem);}, 1000);
		});

	}
// cập nhật lại bảng sinh viên
$scope.reLoadPage = function() {
	if (typeof $scope.khoi != "undefined") {
		fillLop();
		if (typeof $scope.l_ma != "undefined") {
			if (typeof $scope.hk_hocKy != "undefined") {
				fillData();
				console.log('kh: '+$scope.kh_khoaHoc+' lop:'+ $scope.l_ma)
			}
		}
	}
}

// Sắp xếp mã tăng dần hoặc giảm dần
$scope.sortExpression = 'hs_ma';
$scope.sortReverse = false;
$scope.sort = function() {
	$scope.sortReverse = !$scope.sortReverse;
}
// form thêm & sửa 
$scope.modal = function(hs_ma){
	console.log(hs_ma);
	$http.get(URL+'ket-qua/'+ hs_ma +'/hs-ma/'+ $scope.hk_hocKy+'/hoc-ky/all/ma-mh').then(function(response){
		$scope.ds_kq = response.data.message.ds_KetQua;
		// $scope.diemTBCN(hs_ma);
	}).then($http.get(URL+'ket-qua/diemTBCN/'+ hs_ma + '/hs-ma/'+ $scope.hk_hocKy+'/hoc-ky/all/ma-mh')
	.then(function(response){$scope.diemTBCN = response.data.message.diemTBCN.toPrecision(3) }));


		// Hiện form
		$("#myModal").modal('show');
	}
	$scope.save = function(state,hs_ma) {
		switch(state){
			case "add":
			var data = $.param($scope.hocsinh);
			$http({
				method: 'POST',
				url: URL_Main + 'hoc-sinh',
				data: data,
				headers: {'Content-Type' : 'application/x-www-form-urlencoded'}
			}).then(function(response) {
				fillData();
				$scope.alert = {
					'show': true,
					'error' : response.data.error,
					'message' : response.data.message 
				};
			}, function (response) {
				$scope.alert = {
					'show': true,
					'error' : response.data.error,
					'message' : response.data.message 
				};
				
			});
			// $scope.kh_khoaHoc = '2015';
			break;
			case "edit":
			var data = $.param($scope.hocsinh);
			$http({
				method: 'PUT',
				url: URL_Main + 'hoc-sinh/' + hs_ma,
				data: data,
				headers: {'Content-Type' : 'application/x-www-form-urlencoded'}
			}).then(function(response) {
				fillData();
				$scope.alert = {
					'show': true,
					'error' : response.data.error,
					'message' : response.data.message 
				};
			}, function (response) {
				$scope.alert = {
					'show': true,
					'error' : response.data.error,
					'message' : response.data.message 
				};
				
			}); 
			break;
		}
	}

	$scope.confirmDelete = function(hs_ma) {
		if(confirm('Bạn có chắc muốn xóa không ?')){
			$http.delete(URL_Main + 'hoc-sinh/' + hs_ma).
			then(function (response) {
				fillData();
				$scope.alert = {
					'show': true,
					'error' : response.data.error,
					'message' : response.data.message 
				};
			},function (response) {
				$scope.alert = {
					'show': true,
					'error' : response.data.error,
					'message' : response.data.message 
				};
				
			});
		}
	}
});