app.controller('ThongBaoTruongController',function($scope,$http,URL_Main){

	$scope.sub = function(event){
		if($("#myFile").val() != ""){
			$.ajax({
				url: URL+"/test",
				method: "POST",
				data:new FormData(this),
				dataType: 'JSON',
				contentType: false,
				cache: false,
				processData: false,
				success: function(response)
				{

					location.reload();
					alert("Thêm s?n ph?m thành công");
				},
				error: function(response)
				{
					console.log(response);
					alert("Có l?i c?p nh?t s?n ph?m");
				}

			});
		}
		else
		{

		}
	}

	// // Add the following code if you want the name of the file appear on select
	// $(".custom-file-input").on("change", function() {
	//   var fileName = $(this).val().split("\\").pop();
	//   $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	// });

	
	function fillData() {
		$http.get(URL+'thong-bao-truong').then(function(response){
			$scope.ds_tbt = response.data.message.ds_ThongBaoTruong;
		});
	}
	fillData();
	
	// $scope.confirmDelete = function(tbt_ma) {
	// 	if(confirm('Bạn có chắc muốn xóa không ?')){
	// 		$http.delete(URL_Main + 'thong-bao-truong/' + tbt_ma).
	// 			then(function (response) {
	// 				fillData();
	// 				console.log('seed'+tbt_ma);
	// 			},function (error) {
	// 				console.log(error);
	// 			});
	// 	}
	// }
	$scope.modal = function(state,tbt_ma){
		$scope.state  = state;
		switch(state){
			case "add":
			$scope.frmTitle = "Thêm thông báo";
			break;
			case "edit":
			$scope.frmTitle = "Sửa giáo viên";
			$scope.tbt_ma = tbt_ma;
			$http.get(URL_Main + 'thong-bao-truong/' + tbt_ma).then(function(response){
				$scope.thongbao = response.data.message.thongBaoTruong;
				console.log($scope.thongbao);
				var ngayBD = response.data.message.thongBaoTruong.tbt_ngayBD.toString();
				$scope.thongbao.tbt_ngayBD = new Date(ngayBD);
				var ngayKT = response.data.message.thongBaoTruong.tbt_ngayKT.toString();
				$scope.thongbao.tbt_ngayKT = new Date(ngayKT);
			});
			break;
		}
		// Hiện form
		$('#myModal').modal('show');
	}

	$scope.save = function(state,tbt_ma) {
		switch(state){
			case "add":
			
			console.log('ok');
			break;
			case "edit":
			var data = $.param($scope.giaovien);
			$http({
				method: 'PUT',
				url: URL_Main + 'thong-bao-truong/' + tbt_ma,
				data: data,
				headers: {'Content-Type' : 'application/x-www-form-urlencoded'}
			}).then(function(response) {
				fillData();
			}, function (error) {
				console.log(error);
			}); 
			break;
		}
	}

});