app.controller('KhoaHocController',function($scope,$http,URL_Main){
	function fillData() {
		$http.get(URL_Main + 'khoa-hoc/').then(function(response) {
			$scope.ds_kh = response.data.message.ds_KhoaHoc;
		});
	}

	fillData();
//sort theo kh_khoahoc
	$scope.sortExpression = 'kh_khoahoc';
	$scope.sortReverse = false;
	$scope.sort = function() {
		$scope.sortReverse = !$scope.sortReverse;
	}

	$scope.modal = function(state,kh_ma){
		$scope.state  = state;	
		switch(state){
			case "add":
				$scope.frmTitle = "Thêm khóa học";
				$scope.readOnly=false;
				$scope.khoahoc = {
					'kh_ma':'',
					'kh_sucChua':'',
					'kh_ghiChu':''
				};
				break;
			case "edit":
				$scope.readOnly=true;
				$scope.frmTitle = "Sửa khóa học";
				$scope.kh_ma = kh_ma;
				$http.get(URL_Main + 'khoa-hoc/' + kh_ma).then(function(response){
					$scope.khoahoc = response.data.message.khoahoc;
				});
				break;
		}
		// Hiện form
		$('#myModal').modal('show');
	}

	$scope.save = function(state,kh_ma) {
		switch(state){
			case "add":
				var data = $.param($scope.khoahoc);
				$http({
				  	method: 'POST',
				  	url: URL_Main + 'khoa-hoc',
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
				var data = $.param($scope.khoahoc);
				$http({
				  	method: 'PUT',
				  	url: URL_Main + 'khoa-hoc/' + kh_ma,
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

	$scope.confirmDelete = function(kh_ma) {
		if(confirm('Bạn có chắc muốn xóa không ?')){
			$http.delete(URL_Main + 'khoa-hoc/' + kh_ma).
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