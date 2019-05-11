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
	}

	table tr:nth-child(even){background-color: #f2f2f2;}

	table tr:hover {background-color: #ddd;}

	table th {
		padding-top: 8px;
		padding-bottom: 8px;
		text-align: left;
		background-color: #4CAF50;
		color: white;
	}

	i{
		color: #333;
	}

	.form-group span{
		color: red;
	}
</style>
@endsection
@section('body.title','Danh sách thông báo lớp')
@section('body.content')
<div ng-controller="ThongBaoLopController" style="width: 100%;">
	<div class="alert alert-<% alert.error == true ? 'danger':'success' %>" ng-show="alert.show">
	  <strong><% alert.message %></strong>
	</div>	
	<div class="table-responsive" >
		<table class="table table-bordered table-hover">
			<tr>
				<th ng-click="sort()" style="cursor: pointer;">Mã thông báo  <i class="fa fa-caret-<% sortReverse? 'up':'down' %>"></i></th>
				<th>Ngày bắt đầu</th>
				<th>Ngày kết thúc</th>
				<th>Nội dung thông báo</th>
				<th colspan="2" class="text-center">
					<a href="" ng-click="modal('add')"><i class="fa fa-plus"></i></a>
				</th>
			</tr>
			<tr ng-repeat="tbl in ds_tbl | orderBy : sortExpression: sortReverse">
				<td><% tbl.tbl_ma %></td>
				<td ng-bind="tbl.tbl_ngayBD | date: 'dd/MM/yyyy'"></td>
				<td ng-bind="tbl.tbl_ngayKT | date: 'dd/MM/yyyy'"></td>
				<td><% tbl.tbl_noiDung %></td>
				<td class="text-center">
					<a href="" ng-click="modal('edit',tbl.tbl_ma)" ><i class="fa fa-cog"></i></a>
				</td>
				<td class="text-center">
					<a href="" ng-click="confirmDelete(tbl.tbl_ma)"><i class="fa fa-minus" ></i></a>
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
					<h4 class="modal-title"><% frmTitle %></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<form action="" name="frmThongBaoLop" id="frmThongBaoLop" enctype="multipart/form-data">
					<!-- Modal body -->
					<div class="modal-body">
						<div class="form-group">
							<label for="tbl_tieuDe">Tiêu đề:</label>
							<input type="text" class="form-control" id="tbl_tieuDe" name="tbl_tieuDe" autofocus ng-model="thongbao.tbl_tieuDe" required="true">
							<span class="text-danger" ng-show="frmThongBaoLop.tbl_tieuDe.$error.required">Bạn chưa nhập tiêu đề</span>
						</div>
						<div class="form-group">
							<label for="tbl_ngayBD">Ngày bắt đầu:</label>
							<input type="date" class="form-control" id="tbl_ngayBD" name="tbl_ngayBD" ng-model="thongbao.tbl_ngayBD" required="true">
							<span class="text-danger" ng-show="frmThongBaoLop.tbl_ngayBD.$error.required">Bạn chưa chọn ngày bắt đầu</span>
						</div>
						<div class="form-group">
							<label for="tbl_ngayKT">Ngày kết thúc:</label>
							<input type="date" class="form-control" id="tbl_ngayKT" name="tbl_ngayKT" ng-model="thongbao.tbl_ngayKT" required="true">
							<span class="text-danger" ng-show="frmThongBaoLop.tbl_ngayKT.$error.required">Bạn chưa chọn ngày kết thúc</span>
						</div>
						<div class="form-group">
							<label for="tbl_noiDung">Nội dung thông báo:</label>
							<textarea class="form-control" name="tbl_noiDung" rows="5" placeholder=" Viết nội dung thông báo ..." ng-model="thongbao.tbl_noiDung" ng-required="true"></textarea>
							<span class="text-danger" ng-show="frmThongBaoLop.tbl_noiDung.$error.required">Bạn chưa nhập nội dung</span>
						</div>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer" >
						<button type="button" class="btn btn-primary" data-dismiss="modal" ng-disabled="frmThongBaoLop.$invalid" ng-click="save(state,thongbao.tbl_ma)">Lưu</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
@endsection
@section('body.js')
<script type="text/javaScript" src="{{asset('app/ThongBaoLopController.js')}}"></script>
@endsection
