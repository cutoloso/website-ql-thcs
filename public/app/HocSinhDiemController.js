app.controller('HocSinhDiemController',function($scope,$http,URL_Main){
	$scope.hs_ma = user_name;
	var d = new Date();
	var yearNow = d.getFullYear();
	var monthNow = d.getMonth();
	$scope.year = yearNow;
	var mh_ten = {'T':'Toán','VL':'Vật lý','SH':'Sinh học','CN':'Công nghệ','NV':'Ngữ văn','LS':'Lịch sử','DL':'Địa lý','CD':'Công dân','NN':'Ngoại ngữ','TD':'Thể dục','AN':'Âm nhạc','MT':'Mỹ thuật','TH':'Tin học','HH':'Hóa học','CC':'Chào cờ','SHL':'Sinh hoạt lớp'}
	$scope.getTenMonHoc = function(mh_ma){
		return mh_ten[mh_ma.substring(0, mh_ma.length-1)];
	}
	function khoi(){
		if (monthNow <6 ) {
			var y = yearNow;
		}
		else {
			var y = yearNow+1;
		}
		switch (y - parseInt($scope.hs.kh_khoaHoc)){
			case 4: 
				$scope.khoi = 9;
				break;
			case 3: 
				$scope.khoi = 8;
				break;
			case 2: 
				$scope.khoi = 7;
				break;
			case 1: 
				$scope.khoi = 6;
				break;
		}
	}

	$http.get(URL_Main + 'hoc-sinh/'+ $scope.hs_ma).then(function(response){
		$scope.hs = response.data.message.hs;
	}).then(function(){ khoi();});


	//lay to mon hoc
	function fillMonHoc(){
		$http.get(URL_Main + 'mon-hoc/'+ $scope.khoi +'/khoi').then(function(response){
			$scope.ds_mh = response.data.message.ds_mh;
		});
	}
	function fillData(){
		$http.get(URL+'ket-qua/'+ $scope.hs_ma +'/hs-ma/'+ $scope.hk_hocKy+'/hoc-ky/'+$scope.mh_ma+'/ma-mh').then(function(response){
			$scope.ds_kq = response.data.message.ds_KetQua;
		}).then($http.get(URL+'ket-qua/diemTBCN/'+ $scope.hs_ma + '/hs-ma/'+ $scope.hk_hocKy+'/hoc-ky/'+$scope.mh_ma+'/ma-mh')
		.then(function(response){
			$scope.diemTBCN = response.data.message.diemTBCN.toPrecision(3);
		}));
		console.log('fillData')

	}
	$scope.reLoadPage = function(){
		if (typeof $scope.hk_hocKy !="undefined") {
			console.log($scope.hk_hocKy);
			fillMonHoc();
			if (typeof $scope.mh_ma !="undefined") {
				console.log($scope.mh_ma);
				fillData();
			}
		}
	}

});