@extends('layouts.master')
@section('head.css')
<style>
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
@section('body.title','Danh sách giáo viên')
@section('body.content')

<div ng-controller="TaiKhoanController" style="width: 100%;">
	<div class="alert alert-<% alert.error == true ? 'danger':'success' %>" ng-show="alert.show">
		<strong><% alert.message %></strong>
	</div>
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<tr>
				<th ng-click="sort()" style="cursor: pointer;">Tài Khoản<i class="fa fa-caret-<% sortReverse? 'up':'down' %>"></i></th>
				<th>Chức vụ</th>
				<th>Trạng thái</th>
				<th>Ngày tạo</th>
				<th>Ngày cập nhật</th>
				<th colspan="2" class="text-center">
					<a href=""  ng-click="modal('add')" ><i class="fas fa-user-plus" ></i></a>
				</th>
			</tr>
			<tr ng-repeat="tk in ds_tk | orderBy : sortExpression: sortReverse">
				<td><% tk.name %></td>
				<td><% tk.level %></td>
				<td><% tk.status %></td>
				<td><% tk.created_at %></td>
				<td><% tk.updated_at %></td>
				<td class="text-center">
					<a href="" ng-click="modal('edit',tk.name)" ><i class="fas fa-user-edit"></i></a>
				</td>
				<td class="text-center">
					<a href=""><i class="fas fa-user-minus" ng-click="confirmDelete(tk.name)"></i></a>
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

				<form action="" name="frmTaiKhoan">
					<!-- Modal body -->
					<div class="modal-body">

						<div class="form-group">
							<label for="name">Tài Khoản:</label>
							<input type="text" class="form-control" id="name" name="name" placeholder="" ng-model="taikhoan.name" ng-readonly="readOnly" required="true" ng-maxlength="8" autofocus>
							<span class="text-danger" ng-show="frmTaiKhoan.name.$error.required">Bạn chưa nhập tài Khoản</span>
							<span class="text-danger" ng-show="frmTaiKhoan.name.$error.maxlength">Tài Khoản không hợp lệ</span>
						</div>
						<div class="form-group">
							<label for="level">Chức vụ:</label>
							<select class="custom-select" name="level" id="level" ng-model="taikhoan.level">
								<option ng-value="1"> Quản trị viên </option>
								<option ng-value="2"> Giáo viên </option>
								<option ng-value="3"> Phụ huynh </option>
								<option ng-value="4"> Học sinh  </option>
							</select>
						</div>
						<div class="form-group">
							<label for="status">Trạng thái:</label>
							<input ng-model="taikhoan.status" type="radio" ng-value="1"> Hoạt động
							<input ng-model="taikhoan.status" type="radio" ng-value="0" > Khóa<br>
							<span class="text-danger" ng-show="frmTaiKhoan.status.$error.required">Bạn chưa nhập họ tên</span>
						</div>
						<div class="form-group">
							<label for="password">Mật khẩu:</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="" ng-model="taikhoan.password" ng-maxlength="32" ng-blur="compare()" ng-readonly="readOnly">
							<span class="text-danger" ng-show="frmTaiKhoan.password.$error.maxlength">Mật khẩu không hợp lệ</span>
						</div>
						<div class="form-group">
							<label for="password_repeat">Nhập lại mật khẩu:</label>
							<input type="password" class="form-control" id="password_repeat" name="password_repeat" placeholder="" ng-model="taikhoan.password_repeat" ng-maxlength="32" ng-blur="compare()" ng-readonly="readOnly">
							<span class="text-danger" ng-show="passError">Mật khẩu không hợp lệ</span>
						</div>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer" >
						<button type="button" class="btn btn-primary" data-dismiss="modal" ng-disabled="frmTaiKhoan.$invalid" ng-click="save(state,taikhoan.name)">Lưu</button>
					</div>
				</form>  	
			</div>
		</div>
	</div>
</div>

@endsection
@section('body.js')
<script type="text/javaScript" src="{{asset('app/TaiKhoanController.js')}}"></script>
@endsection