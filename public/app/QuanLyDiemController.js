app.controller('QuanLyDiemController',function($scope,$http,URL_Main){
	var d = new Date();
	var yearNow = d.getFullYear();
	$scope.year = yearNow;
	$scope.user_name = user_name;
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
		$http.get(URL_Main + 'day/'+ $scope.kh_khoaHoc +'/khoa-hoc/'+$scope.user_name+'/ma-gv').then(function(response){
			$scope.ds_lop = response.data.message.ds_lop;
		});
	}
	function fillData() {
		$http.get(URL_Main + 'hoc-sinh/'+ $scope.kh_khoaHoc + '/'+ $scope.l_ma).then(function(response){
			$scope.ds_hs = response.data.message.ds_HocSinh;
			console.log('fillData');
		});
	}
	var mh_ten = {'T':'Toán','VL':'Vật lý','SH':'Sinh học','CN':'Công nghệ','NV':'Ngữ văn','LS':'Lịch sử','DL':'Địa lý','CD':'Công dân','NN':'Ngoại ngữ','TD':'Thể dục','AN':'Âm nhạc','MT':'Mỹ thuật','TH':'Tin học','HH':'Hóa học','CC':'Chào cờ','SHL':'Sinh hoạt lớp'}

	// lấy tổ chuyên môn của gíao viên
	$http.get(URL_Main + 'giao-vien/'+$scope.user_name).then(function(response){
		$scope.gv = response.data.message.gv;
	}).then(function() {
		$scope.mh_ten = mh_ten[$scope.gv.cm_ma];
	});
	// cập nhật lại bảng sinh viên
	$scope.reLoadPage = function() {
		if (typeof $scope.khoi != "undefined") {
			fillLop();
			if (typeof $scope.l_ma != "undefined") {
				if (typeof $scope.hk_hocKy != "undefined") {
					fillData();
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
	$scope.modal = function(state, hs_ma, mh_ma, kq_diem, kq_heSo, kq_lan){
		$scope.state  = state;

		switch(state){
			case "add":
			$scope.hs_ma = hs_ma;
			$http.get(URL+'ket-qua/'+ hs_ma +'/hs-ma/'+ $scope.hk_hocKy+'/hoc-ky/'+$scope.gv.cm_ma+$scope.khoi+'/ma-mh').then(function(response){
				$scope.ds_kq = response.data.message.ds_KetQua;
			}).then($http.get(URL+'ket-qua/diemTBCN/'+ hs_ma + '/hs-ma/'+ $scope.hk_hocKy+'/hoc-ky/'+$scope.gv.cm_ma+$scope.khoi+'/ma-mh')
			.then(function(response){
				$scope.diemTBCN = response.data.message.diemTBCN.toPrecision(3);
			}));

				// Hiện form
				$("#modalAdd").modal('show');
				break;
				case "edit":
				$("#modalAdd").modal('hide');
				$("#modalEdit").modal('show');
				$scope.diem = {
					'hs_ma' 	: $scope.hs_ma,
					'hk_hocKy' 	: $scope.hk_hocKy,
					'mh_ma' 	: mh_ma,
					'kq_lan'	: kq_lan,
					'kq_diem'	: kq_diem,
					'kq_heSo'	: kq_heSo
				};
				console.log($scope.diem);
				break;
			}
		}

	// check value input
	function checkNum(num) {
		return typeof (num) == "number" ? true : false;
	}
	//
	$scope.save = function(state) {
		$scope.state  = state;
		switch(state){
			case "add":
			$scope.mh_ma = $("#maMon").val();
			$scope.kq_lan = parseInt($("#lan").val());
			$scope.kq_diem = parseFloat($("#diem").val());
			$scope.kq_heSo = parseInt($("#heSo").val());
			if(checkNum($scope.kq_diem) && $scope.kq_heSo>=0 && $scope.kq_heSo<=3 && $scope.kq_lan>=0 && $scope.kq_lan<=3 && $scope.kq_diem>=0 && $scope.kq_diem<=10){
				$scope.diem = {
					'hs_ma' 	: $scope.hs_ma,
					'hk_hocKy' 	: $scope.hk_hocKy,
					'mh_ma' 	: $scope.mh_ma,
					'kq_lan'	: $scope.kq_lan,
					'kq_diem'	: $scope.kq_diem,
					'kq_heSo'	: $scope.kq_heSo
				};
					// console.log($scope.diem);
					var data = $.param($scope.diem);
					$http({
						method: 'POST',
						url: URL_Main + 'ket-qua',
						data: data,
						headers: {'Content-Type' : 'application/x-www-form-urlencoded'}
					}).then(function(response) {
						$scope.modal('add',$scope.hs_ma);
						$scope.alert = {
							'show': true,
							'error' : response.data.error,
							'message' : response.data.message 
						};
					}, function (response) {
						$scope.modal('add',$scope.hs_ma);
						$scope.alert = {
							'show': true,
							'error' : response.data.error,
							'message' : response.data.message 
						};
						
					});
				}
				else {
					$scope.modal('add',$scope.hs_ma);
					$scope.alert = {
						'show': true,
						'error' : true,
						'message' : "Nhập điểm sai, vui lòng nhập lại" 
					};
				}
				case "edit":
				console.log($scope.diem);
				var data = $.param($scope.diem);
				$http({
					method: 'POST',
					url: URL_Main + 'ket-qua/update',
					data: data,
					headers: {'Content-Type' : 'application/x-www-form-urlencoded'}
				}).then(function(response) {
					$scope.modal('add',$scope.hs_ma);
					$scope.alert = {
						'show': true,
						'error' : response.data.error,
						'message' : response.data.message 
					};
				}, function (response) {
					$scope.modal('edit');
					$scope.alert = {
						'show': true,
						'error' : response.data.error,
						'message' : response.data.message 
					};
				});
				break;
			}

		}
	//
	$scope.confirmDelete = function(mh_ma, kq_heSo, kq_lan) {
		if(confirm('Bạn có chắc muốn xóa không ?')){
			$scope.diem = {
				'hs_ma' 	: $scope.hs_ma,
				'hk_hocKy' 	: $scope.hk_hocKy,
				'mh_ma' 	: mh_ma,
				'kq_lan'	: kq_lan,
				'kq_heSo'	: kq_heSo
			};
			var data = $.param($scope.diem);
			$http({
				method: 'POST',
				url: URL_Main + 'ket-qua/delete',
				data: data,
				headers: {'Content-Type' : 'application/x-www-form-urlencoded'}
			}).then(function(response) {
				$scope.modal('add',$scope.hs_ma);
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