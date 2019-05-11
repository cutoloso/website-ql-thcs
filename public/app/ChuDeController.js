app.controller('ChuDeController',function($scope,$http,URL_Main){
	function fillData() {
		$http.get(URL_Main + 'chu-de-gop-y').then(function(response){
			if(typeof(response.data.message.ds_ChuDe_GVHS)!="undefined")
				$scope.ds_chuDe_GVHS = response.data.message.ds_ChuDe_GVHS;
			if(typeof(response.data.message.ds_ChuDe_GVPH)!="undefined")
				$scope.ds_chuDe_GVPH = response.data.message.ds_ChuDe_GVPH;
			if(typeof(response.data.message.ds_ChuDe_GVPH)!="undefined")
				$scope.chudeGVHS = response.data.message.chudeGVHS;
			console.log(response.data.message);
		});
	}

	fillData();
	// form thêm & sửa 
	$scope.modal = function(state){
		$scope.state  = state;
		$scope.title = state;
		$scope.gv = false;
		$scope.ph = false;
		$scope.hs = false;
		switch(state){
			case "gv":
				// $scope.frmTitle = "Thêm chủ đề góp ý với học sinh";
				$scope.gv = true;
				$http.get(URL_Main + 'giao-vien').then(function(response){
					$scope.ds_gv = response.data.message.ds_GiaoVien;
				});
				break;
			case "ph":
				$scope.ph = true;
				$http.get(URL_Main + 'phu-huynh').then(function(response){
					$scope.ds_ph = response.data.message.ds_PhuHuynh;
				});
				break;
			case "hs":
				$scope.hs = true;
				$http.get(URL_Main + 'hoc-sinh').then(function(response){
					$scope.ds_hs = response.data.message.ds_HocSinh;
				});
				
				break;
		}
		// Hiện form
		$("#myModal").modal('show');

	}

	$scope.save = function (name) {
		$scope.chude.name = name;
		var data = $.param($scope.chude);
  		console.log(data);

		$http({
		  	method: 'POST',
		  	url: URL_Main + 'chu-de-gop-y/'+$scope.state,
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
});