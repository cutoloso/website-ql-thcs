app.controller('LopController',function($scope,$http,URL_Main){
	// $scope.lop = {};
	var d = new Date();
	var yearNow = d.getFullYear();
	function fillData() {
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

// cập nhật lại bảng
$scope.reLoadPage = function() {
	console.log("reLoadData");
	if (typeof $scope.khoi != "undefined") {
		fillData();
	}
}

// Sắp xếp mã tăng dần hoặc giảm dần
$scope.sortExpression = 'l_ma';
$scope.sortReverse = false;
$scope.sort = function() {
	$scope.sortReverse = !$scope.sortReverse;
}

// form thêm & sửa 
$scope.modal = function(state, l_ma, kh_khoaHoc, p_ma, gv_ma){
	$scope.state  = state;
	$http.get(URL_Main + 'giao-vien/').then(function(response){
		$scope.ds_gv = response.data.message.ds_GiaoVien;
	});
	$http.get(URL_Main + 'phong/').then(function(response){
		$scope.ds_p = response.data.message.ds_Phong;
	});
	switch(state){
		case "add":
		$scope.frmTitle = "Thêm lớp";
		$scope.readOnly=false;
		$scope.lop = {
			'l_ma':'',
			'kh_khoaHoc': $scope.kh_khoaHoc,
			'p_ma':'',
			'gv_ma':''
		};
		break;
		case "edit":
		$scope.readOnly = true;
		$scope.frmTitle = "Sửa lớp";
		$scope.lop = {
			'l_ma'			: l_ma,
			'kh_khoaHoc'	: kh_khoaHoc,
			'p_ma'			: p_ma,
			'gv_ma'			:gv_ma
		};
		break;	
	}
		// Hiện form
		$("#myModal").modal('show');

		// Kiểm tra mã lớp có trùng ko
		$scope.check = false;

		$scope.checkMaLop = function(){
			var l_ma = $scope.lop.l_ma.toUpperCase();
			for (var i = $scope.ds_lop.length - 1; i >= 0; i--) {
				if (angular.equals($scope.ds_lop[i].l_ma, l_ma)){
					$scope.check = true;
					break;
				}
				$scope.check = false;
			}
		}
	}

	$scope.save = function(state, l_ma) {
		switch(state){
			case "add":
			$scope.lop = {
				'l_ma' 			: $scope.lop.l_ma.toUpperCase(),
				'kh_khoaHoc' 	: $scope.lop.kh_khoaHoc,
				'p_ma'			: $scope.lop.p_ma,
				'gv_ma'			: $scope.lop.gv_ma
			};
			var data = $.param($scope.lop);
			$http({
				method: 'POST',
				url: URL_Main + 'lop',
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
			case "edit":
			var data = $.param($scope.lop);
			$http({
				method: 'PUT',
				url: URL_Main + 'lop/' + l_ma,
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

	$scope.confirmDelete = function(l_ma, kh_khoaHoc) {
		if(confirm('Bạn có chắc muốn xóa không ?')){
			$scope.lop = {
				'l_ma'			: l_ma,
				'kh_khoaHoc'	: kh_khoaHoc
			};
			var data = $.param($scope.lop);
			$http({
				method: 'POST',
				url: URL_Main + 'lop/del',
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
		}
	}

});