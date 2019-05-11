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
@section('body.title','Danh sách thông báo trường')
@section('body.content')
<div ng-controller="ThongBaoTruongController" style="width: 100%;">
	<div class="table-responsive" >
		<table class="table table-bordered table-hover">
			<tr>
				<th ng-click="sort()" style="cursor: pointer;">Mã thông báo  <i class="fa fa-caret-<% sortReverse? 'up':'down' %>"></i></th>
				<th>Ngày bắt đầu</th>
				<th>Ngày kết thúc</th>
				<th colspan="3" class="text-center">
					<a href="{{route('ThongBaoTruongController.create')}}" ><i class="fa fa-plus"></i></a>
				</th>
				{{-- <th colspan="3" class="text-center">
					<a href="" ng-click="modal('add')"><i class="fa fa-plus"></i></a>
				</th> --}}
			</tr>
			<tr ng-repeat="tbt in ds_tbt | orderBy : sortExpression: sortReverse">
				<td><% tbt.tbt_ma %></td>
				<td ng-bind="tbt.tbt_ngayBD | date: 'dd/MM/yyyy'"></td>
				<td ng-bind="tbt.tbt_ngayKT | date: 'dd/MM/yyyy'"></td>
				<td class="text-center"><a href="http://localhost/QL-THCS/storage/app/<% tbt.tbt_noiDung %>" ><i class="fas fa-eye"></i></a></td>
				{{-- <td class="text-center">
					<a href="" ng-click="modal('edit',tbt.tbt_ma)" ><i class="fa fa-cog"></i></a>
				</td> --}}
				<td class="text-center">
					<a href="http://localhost/QL-THCS/public/quan-tri/thong-bao-truong/<%tbt.tbt_ma%>/edit" ><i class="fas fa-edit"></i></a>
				</td>
				<td class="text-center">
					<a href="" ng-click="confirmDelete(tbt.tbt_ma)"><i class="fas fa-minus" ></i></a>
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


					<!-- Modal body -->
					<div class="modal-body">
						<form ng-submit="sub()" action="" name="frmThongBaoTruong" enctype="multipart/form-data" method="POST">
						@csrf
						<div class="form-group">
							<label for="tbt_tieuDe">Tiêu đề:</label>
							<input type="text" class="form-control" id="tbt_tieuDe" name="tbt_tieuDe" autofocus ng-model="thongbao.tbt_tieuDe" required="true">
							<span class="text-danger" ng-show="frmThongBaoTruong.tbt_tieuDe.$error.required">Bạn chưa nhập tiêu đề</span>
						</div>
						<div class="form-group">
							<label for="tbt_ngayBD">Ngày bắt đầu:</label>
							<input type="date" class="form-control" id="tbt_ngayBD" name="tbt_ngayBD" ng-model="thongbao.tbt_ngayBD" required="true">
							<span class="text-danger" ng-show="frmThongBaoTruong.tbt_ngayBD.$error.required">Bạn chưa chọn ngày bắt đầu</span>
						</div>
						<div class="form-group">
							<label for="tbt_ngayKT">Ngày kết thúc:</label>
							<input type="date" class="form-control" id="tbt_ngayKT" name="tbt_ngayKT" ng-model="thongbao.tbt_ngayKT" required="true">
							<span class="text-danger" ng-show="frmThongBaoTruong.tbt_ngayKT.$error.required">Bạn chưa chọn ngày kết thúc</span>
						</div>
						<div class="custom-file">
							<input type="file" class="form-control custom-file-input" id="tbt_noidung" name="tbt_noidung" ng-model="thongbao.tbt_noidung" >
							<label class="custom-file-label" for="customFile">Chọn tệp</label>
						</div>
						<input type="file" name="myFile" id="myFile">
						
						<button type="submit" class="btn btn-primary" data-dismiss="modal" 
						ng-disabled="frmThongBaoTruong.$invalid">Lưu</button>
						
						</form>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer" >
						
					</div>
				

			</div>
		</div>
	</div>
</div>
@endsection
@section('body.js')
<script type="text/javaScript" src="{{asset('app/ThongBaoTruongController.js')}}"></script>
@endsection
