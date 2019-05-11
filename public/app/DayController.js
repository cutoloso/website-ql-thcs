app.controller('DayController',function($scope,$http,URL_Main){
	$scope.day = {};
	$scope.add = false;
	var arr = [];
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

	function fillData() {

		$http.get(URL_Main + 'day/'+ $scope.maKhoaHoc + '/khoa-hoc/'+ $scope.maLop+'/ma-lop').then(function(response){
			$scope.ds_d = response.data.message.ds_day;
			arr = $scope.ds_d;
			console.log('fillData');
		});
	}

// cập nhật lại bảng
$scope.reLoadPage = function() {
	if (typeof $scope.khoi != "undefined") {
		fillLop();
		if (typeof $scope.l_ma != "undefined") {
			$scope.maLop = $scope.l_ma;
				fillData();
				$scope.add = true;
		}
	}
}

// Sắp xếp mã tăng dần hoặc giảm dần
$scope.sortExpression = 'mh_ten';
$scope.sortReverse = false;
$scope.sort = function() {
	$scope.sortReverse = !$scope.sortReverse;
}

// Các môn học giáo viên dạy
$scope.loadGiaoVien = function () {
	$http.get(URL_Main + 'giao-vien/' + $scope.day.cm_ma +'/ma-cm').then(function(response){
		$scope.ds_gv = response.data.message.ds_gv;
	});
}

// form thêm & sửa 
$scope.modal = function(state, cm_ma, gv_ma){
	$scope.state  = state;

	switch(state){
		case "add":
			$scope.frmTitle = "Thêm giáo viên dạy - môn";
			$scope.readOnly=false;
			$scope.day = {
				'gv_ma'	: '',
				'mh_ma'	: ''
			};
			$http.get(URL_Main + 'to-cm/').then(function(response){
				$scope.tmp = response.data.message.ds_ToCM;
				if(typeof $scope.tmp != "undefined"){
					for (var j = $scope.tmp.length - 1; j >= 0; j--) {
						for (var i = arr.length - 1; i >= 0; i--) {
							// var ind = $scope.tmp[j].cm_ma == (arr[i].mh_ma.substring(0, arr[i].mh_ma.length -1));
							if($scope.tmp[j].cm_ma == (arr[i].mh_ma.substring(0, arr[i].mh_ma.length -1)) || $scope.tmp[j].cm_ma == 'GT'){
								$scope.tmp.splice(j, 1);
								break;
							}
							if($scope.khoi < 8 && $scope.tmp[j].cm_ma == 'HH'){
								$scope.tmp.splice(j, 1);
								break;
							}
						}
					}
					$scope.ds_cm = $scope.tmp;
				}
			});
			break;
		case "edit":
			$http.get(URL_Main + 'to-cm/').then(function(response){
				$scope.ds_cm = response.data.message.ds_ToCM;
			});
			$scope.readOnly=true;
			$scope.frmTitle = "Sửa giáo viên dạy - môn";
			$scope.day.cm_ma = cm_ma;
			$scope.loadGiaoVien();
			$scope.day.gv_ma = gv_ma
			break;
	}
		
		$("#myModal").modal('show'); // Hiện form
	}

	$scope.save = function(state, mh_ma) {
		$scope.day.kh_khoaHoc = $scope.maKhoaHoc;
		$scope.day.l_ma = $scope.l_ma;
		$scope.day.mh_ma = $scope.day.cm_ma+$scope.khoi;
		var data = $.param($scope.day);
		switch(state){
			case "add":
				$http({
					method: 'POST',
					url: URL_Main + 'day',
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
				$http({
					method: 'POST',
					url: URL_Main + 'day/update',
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

	$scope.confirmDelete = function(mh_ma,gv_ma) {
		if(confirm('Bạn có chắc muốn xóa không ?')){
			$scope.day.kh_khoaHoc = $scope.maKhoaHoc;
			$scope.day.l_ma = $scope.l_ma;
			$scope.day.mh_ma = mh_ma;
			$scope.day.gv_ma = gv_ma;
			var data = $.param($scope.day);
			$http({
				method: 'POST',
				url: URL_Main + 'day/del',
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