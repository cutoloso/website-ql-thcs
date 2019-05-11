app.controller('GiaoVienController',function($scope,$http,URL_Main){
	
	function fillData() {
		$http.get(URL_Main + 'giao-vien/').then(function(response){
			$scope.ds_gv = response.data.message.ds_GiaoVien;
			// console.log(response.data.message.ds_GiaoVien);
		});
	}
	fillData();

	$http.get(URL_Main + 'to-cm/').then(function(response){
		$scope.ds_toCM = response.data.message.ds_ToCM;
	});

	$scope.sortExpression = 'gv_ma';
	$scope.sortReverse = true;
	$scope.sort = function() {
		$scope.sortReverse = !$scope.sortReverse;
	}
	
	$scope.modal = function(state,gv_ma){
		$scope.state  = state;
		
		switch(state){
			case "add":
			$scope.frmTitle = "Thêm giáo viên";
			$scope.readOnly=false;
			$scope.giaovien = {
				'gv_ma':'',
				'gv_matKhau':'',
				'gv_hoTen':'',
				'gv_phai':1,
				'gv_diaChi':'',
				'gv_email':'',
				'gv_dienThoai':'',
				'cm_ma':'T',
				'q_ma':'2'
			};
			break;
			case "edit":
			$scope.readOnly=true;
			$scope.frmTitle = "Sửa giáo viên";
			$scope.gv_ma = gv_ma;
			$http.get(URL_Main + 'giao-vien/' + gv_ma).then(function(response){
				$scope.giaovien = response.data.message.gv;
				var ns = response.data.message.gv.gv_ngaySinh.toString();
				$scope.giaovien.gv_ngaySinh = new Date(ns);
			});
			break;
		}
		// Hiện form
		$('#myModal').modal('show');
		// Kiểm tra mật khẩu
		$scope.passError = false;
		$scope.compare = function() {
			if (angular.equals($scope.giaovien.gv_matKhau, $scope.giaovien.gv_matKhau_repeat)) {
				$scope.passError = false;
			} 
			else {
				$scope.passError = true;
			}
		}
	}

	$scope.save = function(state,gv_ma) {
		switch(state){
			case "add":
			var data = $.param($scope.giaovien);
			$http({
				method: 'POST',
				url: URL_Main + 'giao-vien',
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
			var data = $.param($scope.giaovien);
			$http({
				method: 'PUT',
				url: URL_Main + 'giao-vien/' + gv_ma,
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

	$scope.confirmDelete = function(gv_ma) {
		if(confirm('Bạn có chắc muốn xóa không ?')){
			$http.delete(URL_Main + 'giao-vien/' + gv_ma).
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