app.controller('TKBController',function($scope,$http,URL_Main){
	$scope.tkb = {};
	$scope.update = false;
	$scope.thu = function(t_ma) {
		switch (t_ma) {
			case 'T2':
			return '2';

			case 'T3':
			return '3';

			case 'T4':
			return '4';

			case 'T5':
			return '5';

			case 'T6':
			return '6';

			case 'T7':
			return '7';
		}
	}

	var d = new Date();
	var yearNow = d.getFullYear();
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
		$http.get( URL+'lop/'+ $scope.kh_khoaHoc +'/khoa-hoc').then(function(response){
			$scope.ds_lop = response.data.message.ds_Lop;
		});
	}
	
	function fillData() {

		$http.get(URL+'tkb/'+ $scope.hk_hocKy +'/hoc-ky/'+ $scope.kh_khoaHoc +'/khoa-hoc/'+$scope.l_ma+'/ma-lop').then(function(response){
			$scope.ds_tkb = response.data.message.ds_tkb;
			console.log($scope.ds_tkb);
			console.log('fill data');
		});
	}

// // cập nhật lại bảng
$scope.reLoadPage = function() {
	if (typeof $scope.hk_hocKy != "undefined") {
		if (typeof $scope.khoi != "undefined") {
			fillLop();
			if (typeof $scope.l_ma != "undefined") {
				$scope.update = true;
				fillData();
				console.log($scope.hk_hocKy +' - '+$scope.khoi+' - '+$scope.l_ma);
			}
		}
	}
}
// Sắp xếp mã tăng dần hoặc giảm dần
$scope.sortExpression = 't_ma';
$scope.sortReverse = false;
$scope.sort = function() {
	$scope.sortReverse = !$scope.sortReverse;
}

$scope.modal = function(state, th_stt, th_buoi, t_ma, l_ma, mh_ma){
	$scope.state  = state;
	$http.get(URL_Main + 'mon-hoc/'+ $scope.khoi +'/khoi').then(function(response){
		$scope.ds_mh = response.data.message.ds_mh;
	});
	switch(state){
		case "edit":
		$scope.frmTitle = "Sửa thời khóa biểu";
		$scope.tkb.kh_khoaHoc = $scope.kh_khoaHoc;
		$scope.tkb.hk_hocKy = $scope.hk_hocKy;
		$scope.tkb.l_ma = $scope.l_ma;
		$scope.tkb.th_stt = th_stt;
		$scope.tkb.th_buoi = th_buoi;
		$scope.tkb.t_ma = t_ma;
		$scope.tkb.mh_ma = mh_ma;
		$scope.cm_ma = mh_ma.substring(0, mh_ma.length -1);
		break;
	}
	// Hiện form
	$("#myModal").modal('show');
}
$scope.save = function(state, mh_ma) {
	$scope.tkb.mh_ma = mh_ma;
		// $scope.tkb.gv_ma = gv_ma;
		var data = $.param($scope.tkb);
		switch(state){
			case "add":
			$http({
				method: 'POST',
				url: URL_Main + 'tkb',
				data: data,
				headers: {'Content-Type' : 'application/x-www-form-urlencoded'}
			}).then(function(response) {
				fillData();
			}, function (error) {
				console.log(error);
			});
			break;
			case "edit":
			$http({
				method: 'POST',
				url: URL_Main + 'tkb/update',
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
				console.log(error);
			}); 
			break;
		}
	}

	$scope.showModalImport = function(){
		if (confirm("Thao tác này sẽ ghi đè lên thời khóa biểu của lớp "+$scope.khoi+$scope.l_ma+" học kỳ "+$scope.hk_hocKy)) {
			$("#modalImport").modal('show');
		}
	}

	$("#frmTkbImport").on("submit", function(event){
		event.preventDefault();
		if($("#fileTKB").val() != ""){
			$.ajax({
				url: URL_Main + 'tkb/import/'+$scope.kh_khoaHoc+'/khoa-hoc/'+$scope.hk_hocKy+'/hoc-ky/'+$scope.l_ma+'/lop',
				method: "POST",
				data:new FormData(this),
				dataType: 'JSON',
				contentType: false,
				cache: false,
				processData: false,
				success: function(response)
				{
					$scope.alert = {
						'show': true,
						'error' : response.error,
						'message' : response.message 
					};
					console.log("success");
					fillData();
				},
				error: function(response)
				{
					$scope.alert = {
						'show': true,
						'error' : response.error,
						'message' : response.message 
					};
					console.log(response);
				}

			});
			
		}
		else
		{
			$scope.warning=true;
		}
		$("#modalImport").modal('hide');
	});
});