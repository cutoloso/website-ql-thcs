@extends('layouts.master')
@section('head.css')
<style>
	table {
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}

	table td, table th {
		border: 1px solid #ddd;
		padding: 5px;
		text-align: center;
	}

	table tr:nth-child(even){background-color: #f2f2f2;}

	table tr:hover {background-color: #ddd;}

	table th {
		padding-top: 8px;
		padding-bottom: 8px;
		text-align: center;
		background-color: #4CAF50;
		color: white;
	}
	i{
		color: #333;
	}
</style>
@endsection
@section('body.title','Thời khóa biểu')
@section('body.content')
<div class="col-12" ng-controller="TKBController" style="width: 100%;">
	<div class="row ">
		<div class="col-12 alert alert-<% alert.error == true ? 'danger':'success' %>" ng-show="alert.show">
		  <strong><% alert.message %></strong>
		</div>
		<div class="col-md-4 form-group text-center">
			<label for="hk_hocKy">Học kỳ : </label>
			<select name="hk_hocKy" id="hk_hocKy" ng-model="hk_hocKy" ng-change="reLoadPage()">
				<option value="">---Vui lòng chọn--</option>
				<option value="1">1</option>
				<option value="2">2</option>
			</select>
		</div>
		<div class="col-md-4 form-group text-center">
			<label for="khoi">Khối : </label>
			<select name="khoi" id="khoi" ng-model="khoi" ng-change="reLoadPage()">
				<option value="">---Vui lòng chọn--</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
			</select>
		</div>
		<div class="col-md-4 form-group text-center">
			<label for="l_ma">Lớp: </label>
			<select name="l_ma" id="l_ma" ng-model="l_ma" ng-change="reLoadPage()">
				<option value="">---Vui lòng chọn--</option>
				<option ng-repeat="l in ds_lop" ng-value="l.l_ma" value="<% l.l_ma %>"><% l.l_ma %></option>
			</select>
		</div>
	</div>
	<br>
	<div class=" table-responsive" >
		<table class="table table-bordered table-hover">
			<tr>
				<th ng-click="sort()" style="cursor: pointer;" colspan="2">Thứ / Buoi<i class="fa fa-caret-<% sortReverse? 'up':'down' %>"></i></th>
				<th>Buổi</th>
				<th>Môn học</th>
				<th>Giáo viên</th>
				<th>
					<a ng-click="showModalImport()" ng-show="update">
						<i class="fas fa-file-upload"></i>
					</a>
				</th>
			</tr>
			<tr ng-repeat="tkb in ds_tkb | orderBy : sortExpression: sortReverse">
				<th ng-if="$index%5 == 0" rowspan="5" ng-bind="thu(tkb.t_ma)" ></th>
				<td><% tkb.th_stt %></td>
				<td><% tkb.th_buoi=='s' ? 'Sáng':'Chiều' %></td>
				<td><% tkb.mh_ma %></td>
				<td><% tkb.gv_ma %> <% tkb.gv_hoTen %></td>
				<td>
					<a href="" ng-click="modal('edit',tkb.th_stt, tkb.th_buoi, tkb.t_ma, tkb.l_ma, tkb.mh_ma)" >
						<i class="fas fa-edit"></i>
					</a>
				</td>
			</tr>
		</table>
	</div>
	<!-- The Modal -->
	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Import thời khóa biểu của lớp</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<form action="" name="frmTKB">
					@csrf
					<!-- Modal body -->
					<div class="modal-body">
						<div class="form-group">
							<label for="mh_ma">Mã môn học:</label>
							<select class="custom-select" name="mh_ma" id="mh_ma" ng-model="tkb.mh_ma" ng-change="loadGiaoVien()" ng-disabled="readOnly" required="true">
								<option value="">---Vui lòng chọn---</option>
								<option ng-repeat="mh in ds_mh" ng-value="mh.mh_ma" value="<% mh.mh_ma %>"><% mh.mh_ma %> - <% mh.mh_ten %></option>
							</select>
							<span class="text-danger" ng-show="frmTKB.mh_ma.$error.required">Bạn chưa chọn môn học</span>
						</div>
					</div>
					<!-- Modal footer -->
					<div class="modal-footer" >
						<button type="button" class="btn btn-primary" data-dismiss="modal" ng-disabled="frmTKB.$invalid" ng-click="save(state,tkb.mh_ma)">Lưu</button>
					</div>
				</form>

			</div>
		</div>
	</div>

	<!-- Modal import tkb -->
	<div class="modal fade" id="modalImport">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title"><% frmTitle %></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<form id="frmTkbImport"  method="POST" enctype="multipart/form-data">
					@csrf
					<!-- Modal body -->
					<div class="modal-body">
						<h5>Chọn file để cập nhật thời khóa biểu:</h5>
						<div class="custom-file form-group">
							<input type="file" class="form-group custom-file-input" id="customFile" name="fileTKB" accept=".csv, .xlsx">
							<label class="custom-file-label" for="customFile">Chọn file</label>
						</div>
					</div>
					<!-- Modal footer -->
					<div class="modal-footer" >
						<button type="submit" class="btn btn-primary" ng-disabled="frmTkbImport.$invalid">Cập nhật</button>
					</div>
				</form>

			</div>
		</div>
	</div>

</div>

@endsection
@section('body.js')
<script>
	// Add the following code if you want the name of the file appear on select
	$(".custom-file-input").on("change", function() {
	  var fileName = $(this).val().split("\\").pop();
	  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
</script>
<script type="text/javaScript" src="{{asset('app/TKBController.js')}}"></script>
@endsection
