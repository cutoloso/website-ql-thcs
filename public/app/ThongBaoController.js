app.controller('ThongBaoController',function($scope,$http,URL_Main){
	// Add the following code if you want the name of the file appear on select
	$(".custom-file-input").on("change", function() {
	  var fileName = $(this).val().split("\\").pop();
	  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});

	var url = window.location.href;
	$scope.tbt_ma = url.substring(url.lastIndexOf("/")-1,url.lastIndexOf("/"));
	$http.get(URL_Main + 'thong-bao-truong/' + $scope.tbt_ma).then(function(response){
		$scope.thongbao = response.data.message.thongBaoTruong;
		var ngayBD = response.data.message.thongBaoTruong.tbt_ngayBD.toString();
		$scope.thongbao.tbt_ngayBD = new Date(ngayBD);
		var ngayKT = response.data.message.thongBaoTruong.tbt_ngayKT.toString();
		$scope.thongbao.tbt_ngayKT = new Date(ngayKT);
		// $scope.srcPDF = "http://localhost/QL-THCS/storage/app/"+$scope.thongbao.tbt_noiDung;

	});

});