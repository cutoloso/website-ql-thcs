app.controller('DiemController',function($scope,$http,URL_Main){
	var d = new Date();
	var yearNow = d.getFullYear();
	$scope.year = yearNow;
	var mh_ten = {'T':'Toán','VL':'Vật lý','SH':'Sinh học','CN':'Công nghệ','NV':'Ngữ văn','LS':'Lịch sử','DL':'Địa lý','CD':'Công dân','NN':'Ngoại ngữ','TD':'Thể dục','AN':'Âm nhạc','MT':'Mỹ thuật','TH':'Tin học','HH':'Hóa học','CC':'Chào cờ','SHL':'Sinh hoạt lớp'}
	$scope.getTenMonHoc = function(mh_ma){
		// var mh = mh_ma.substring(0, mh_ma.length-1);
		return mh_ten[mh_ma.substring(0, mh_ma.length-1)];
	}
	$scope.modal = function(){
		console.log($scope.hs_ma);
		$scope.hs_ma = $scope.hs_ma.toUpperCase();
		$http.get(URL+'ket-qua/'+ $scope.hs_ma +'/hs-ma/'+ $scope.hk_hocKy+'/hoc-ky/all/ma-mh').then(function(response){
			$scope.ds_kq = response.data.message.ds_KetQua;
			console.log($scope.ds_kq);
		}).then($http.get(URL+'ket-qua/diemTBCN/'+ $scope.hs_ma + '/hs-ma/'+ $scope.hk_hocKy+'/hoc-ky/all/ma-mh')
		.then(function(response){$scope.diemTBCN = response.data.message.diemTBCN.toPrecision(3) }));
		// Hiện form
		$("#myModal").modal('show');
	}

});