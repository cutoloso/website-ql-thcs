app.controller('TaiKhoanController',function($scope,$http,URL_Main){
	
	function fillData() {
		$http.get(URL_Main + 'tai-khoan/').then(function(response){
			$scope.ds_tk = response.data.message.ds_taiKhoan;
		});
	}
	fillData();

	$http.get(URL_Main + 'to-cm/').then(function(response){
		$scope.ds_toCM = response.data.message.ds_ToCM;
	});

	$scope.sortExpression = 'name';
	$scope.sortReverse = true;
	$scope.sort = function() {
		$scope.sortReverse = !$scope.sortReverse;
	}
	
	$scope.modal = function(state,name){
		$scope.state  = state;
		
		switch(state){
			case "add":
			$scope.frmTitle = "Thêm tài Khoản";
			$scope.readOnly=false;
			$scope.taikhoan = {
				'name':'',
				'password':'',
				'level':'',
				'status':1
			};
			break;
			case "edit":
			$scope.readOnly=true;
			$scope.frmTitle = "Sửa tài Khoản";
			$scope.name = name;
			$http.get(URL_Main + 'tai-khoan/' + name).then(function(response){
				$scope.taikhoan = response.data.message.tk;
			});
			break;
		}
		// Hiện form
		$('#myModal').modal('show');
		// Kiểm tra mật khẩu
		$scope.passError = false;
		$scope.compare = function() {
			if (angular.equals($scope.taikhoan.nametKhau, $scope.taikhoan.nametKhau_repeat)) {
				$scope.passError = false;
			} 
			else {
				$scope.passError = true;
			}
		}
	}

	$scope.save = function(state,name) {
		switch(state){
			case "add":
			var data = $.param($scope.taikhoan);
			console.log(data);
			$http({
				method: 'POST',
				url: URL_Main + 'tai-khoan',
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
				console.log(response);
			}); 
			break;
			case "edit":
			var data = $.param($scope.taikhoan);
			$http({
				method: 'PUT',
				url: URL_Main + 'tai-khoan/' + name,
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

	$scope.confirmDelete = function(name) {
		if(confirm('Bạn có chắc muốn xóa không ?')){
			$http.delete(URL_Main + 'tai-khoan/' + name).
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