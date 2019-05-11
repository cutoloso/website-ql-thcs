app.controller('ThongBaoLopController',function($scope,$http,URL_Main){

	function fillData() {
		$http.get(URL_Main + 'thong-bao-lop').then(function(response){
			$scope.ds_tbl = response.data.message.ds_thongBaoLop;
		});
	}
	fillData();

	$scope.sortExpression = 'tbl_ma';
	$scope.sortReverse = true;
	$scope.sort = function() {
		$scope.sortReverse = !$scope.sortReverse;
	}
	
	$scope.modal = function(state,tbl_ma){
		$scope.state  = state;
		
		switch(state){
			case "add":
			$scope.frmTitle = "Thêm thông báo lớp";
			$scope.readOnly=false;
			$scope.thongbao = {
				'tbl_tieuDe':'',
				'tbl_ngayBD':'',
				'tbl_ngayKT':'',
				'tbl_noiDung':''
			};
			break;
			case "edit":
			$scope.readOnly=true;
			$scope.frmTitle = "Sửa thông báo lớp";
			$scope.tbl_ma = tbl_ma;
			$http.get(URL_Main + 'thong-bao-lop/' + tbl_ma).then(function(response){
				$scope.thongbao = response.data.message.thongBaoLop;
				var ngaybd = $scope.thongbao.tbl_ngayBD.toString();
				$scope.thongbao.tbl_ngayBD = new Date(ngaybd);
				var ngaykt = $scope.thongbao.tbl_ngayKT.toString();
				$scope.thongbao.tbl_ngayKT = new Date(ngaykt);
			});
			break;
		}
		// Hiện form
		$('#myModal').modal('show');
	}

	$scope.save = function(state,tbl_ma) {
		switch(state){
			case "add":
				var data = $.param($scope.thongbao);
				$http({
					method: 'POST',
					url: URL_Main + 'thong-bao-lop',
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
				var data = $.param($scope.thongbao);
				$http({
					method: 'PUT',
					url: URL_Main + 'thong-bao-lop/' + tbl_ma,
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


	$scope.confirmDelete = function(tbl_ma) {
		if(confirm('Bạn có chắc muốn xóa không ?')){
			$http.delete(URL_Main + 'thong-bao-lop/' + tbl_ma).
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