app.controller('PhongController',function($scope,$http,URL_Main){
	function fillData() {
		$http.get(URL_Main + 'phong/').then(function(response) {
			$scope.ds_p = response.data.message.ds_Phong;
		});
	}

	fillData();
//sort theo kh_ma
	$scope.sortExpression = 'p_ma';
	$scope.sortReverse = true;
	$scope.sort = function() {
		$scope.sortReverse = !$scope.sortReverse;
	}

	$scope.modal = function(state,p_ma){
		$scope.state  = state;	
		switch(state){
			case "add":
				$scope.frmTitle = "Thêm phòng";
				$scope.readOnly=false;
				$scope.phong = {
					'p_ma':'',
					'p_sucChua':'',
					'p_ghiChu':''
				};
				break;
			case "edit":
				$scope.readOnly=true;
				$scope.frmTitle = "Sửa phòng";
				$scope.p_ma = p_ma;
				$http.get(URL_Main + 'phong/' + p_ma).then(function(response){
					$scope.phong = response.data.message.phong;
				});
				break;
		}
		// Hiện form
		$('#myModal').modal('show');
	}

	$scope.save = function(state,p_ma) {
		switch(state){
			case "add":
				var data = $.param($scope.phong);
				$http({
				  	method: 'POST',
				  	url: URL_Main + 'phong',
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
				var data = $.param($scope.phong);
				$http({
				  	method: 'PUT',
				  	url: URL_Main + 'phong/' + p_ma,
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

	$scope.confirmDelete = function(p_ma) {
		if(confirm('Bạn có chắc muốn xóa không ?')){
			$http.delete(URL_Main + 'phong/' + p_ma).
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