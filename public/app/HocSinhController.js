app.controller('HocSinhController',function($scope,$http,URL_Main){

	var d = new Date();
	var yearNow = d.getFullYear();
	function fillLop() {
		switch ($scope.khoi) {
			case '9':
			$scope.maKhoaHoc = yearNow-4;
			break;
			case '8':
			$scope.maKhoaHoc = yearNow-3;
			break;
			case '7':
			$scope.maKhoaHoc = yearNow-2;
			break;
			case '6':
			$scope.maKhoaHoc = yearNow-1;
			break;
		}
		$http.get(URL+'lop/'+ $scope.maKhoaHoc +'/khoa-hoc').then(function(response){
			$scope.ds_lop = response.data.message.ds_Lop;
		});
	}
	// fillLop();
	
	function fillData() {

		$http.get(URL_Main + 'hoc-sinh/'+ $scope.maKhoaHoc + '/'+ $scope.maLop).then(function(response){
			$scope.ds_hs = response.data.message.ds_HocSinh;
		});
		console.log('fillData');
	}

// cập nhật lại bảng sinh viên
$scope.reLoadPage = function() {
	if (typeof $scope.khoi != "undefined") {
		fillLop();
		if (typeof $scope.hocsinh.l_ma != "undefined") {
			$scope.maLop = $scope.hocsinh.l_ma;
				fillData();
				console.log('kh: '+$scope.maKhoaHoc+' lop:'+ $scope.maLop)
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
$scope.modal = function(state,hs_ma){
	$scope.state  = state;
	$http.get(URL_Main + 'phu-huynh/').then(function(response){
		$scope.ds_ph = response.data.message.ds_PhuHuynh;
	});
	switch(state){
		case "add":
		$scope.frmTitle = "Thêm học sinh";
		$scope.readOnly=false;
		$scope.hocsinh = {
			'hs_ma':'',
			'hs_matKhau':'',
			'hs_hoTen':'',
			'hs_phai':1,
			'hs_diaChi':'',
			'q_ma':'3',
			'l_ma':$scope.maLop,
			'kh_khoaHoc': $scope.maKhoaHoc
		};
		break;
		case "edit":
		$scope.readOnly=true;
		$scope.frmTitle = "Sửa học sinh";
		$scope.hs_ma = hs_ma;
		$http.get(URL_Main + 'hoc-sinh/' + hs_ma).then(function(response){
			$scope.hocsinh = response.data.message.hs;
			var ns = response.data.message.hs.hs_ngaySinh.toString();
			$scope.hocsinh.hs_ngaySinh = new Date(ns);
		});
		break;
	}
		// Hiện form
		$("#myModal").modal('show');
		// Kiểm tra mật khẩu
		$scope.passError = false;
		$scope.compare = function() {
			if (angular.equals($scope.hocsinh.hs_matKhau, $scope.hocsinh.hs_matKhau_repeat)) {
				$scope.passError = false;
			} 
			else {
				$scope.passError = true;
			}
		}
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
			// $scope.maKhoaHoc = '2015';
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