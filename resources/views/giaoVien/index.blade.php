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

<div ng-controller="GiaoVienController" style="width: 100%;">
	<div class="alert alert-<% alert.error == true ? 'danger':'success' %>" ng-show="alert.show">
	  <strong><% alert.message %></strong>
	</div>
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
		  <tr>
		    <th ng-click="sort()" style="cursor: pointer;">Mã <i class="fa fa-caret-<% sortReverse? 'up':'down' %>"></i></th>
		    <th>Họ tên</th>
		    <th>Ngày sinh</th>
		    <th>Phái</th>
		    <th>Địa chỉ</th>
		    <th>Email</th>
		    <th>Điện thoại</th>
		    <th>Mã chuyên môn</th>
		    <th colspan="2" class="text-center">
		    	<a href=""  ng-click="modal('add')" ><i class="fas fa-user-plus" ></i></a>
		    </th>
		  </tr>
		  <tr ng-repeat="gv in ds_gv | orderBy : sortExpression: sortReverse">
		    <td><% gv.gv_ma %></td>
		    <td><% gv.gv_hoTen %></td>
		    <td ng-bind="gv.gv_ngaySinh | date: 'dd/MM/yyyy'"><% gv.gv_ngaySinh %></td>
			<td><% gv.gv_phai > 0 ? 'Nam':'Nữ' %></td>
		    <td><% gv.gv_diaChi %></td>
		    <td><% gv.gv_email %></td>
		    <td><% gv.gv_dienThoai %></td>
		    <td><% gv.cm_ma %></td>
		    <td class="text-center">
		    	<a href="" ng-click="modal('edit',gv.gv_ma)" ><i class="fas fa-user-edit"></i></a>
		    </td>
		    <td class="text-center">
		    	<a href=""><i class="fas fa-user-minus" ng-click="confirmDelete(gv.gv_ma)"></i></a>
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

	      	<form action="" name="frmGiaoVien">
	      	<!-- Modal body -->
	      		<div class="modal-body">

		         	<div class="form-group">
		         		<label for="gv_ma">Mã:</label>
		         		<input type="text" class="form-control" id="gv_ma" name="gv_ma" placeholder="" ng-model="giaovien.gv_ma" ng-readonly="readOnly" required="true" ng-maxlength="8" autofocus>
		         		<span class="text-danger" ng-show="frmGiaoVien.gv_ma.$error.required">Bạn chưa nhập mã</span>
		         		<span class="text-danger" ng-show="frmGiaoVien.gv_ma.$error.maxlength">Mã không hợp lệ</span>
		         	</div>
		         	<div class="form-group">
		         		<label for="gv_hoTen">Họ tên:</label>
		         		<input type="text" class="form-control" id="gv_hoTen" name="gv_hoTen" placeholder="" ng-model="giaovien.gv_hoTen" required="true" ng-maxlength="100">
		         		<span class="text-danger" ng-show="frmGiaoVien.gv_hoTen.$error.required">Bạn chưa nhập họ tên</span>
		         	</div>
		         	<div class="form-group">
		         		<label for="gv_ngaySinh">Ngày sinh:</label>
		         		<input type="date" class="form-control" id="gv_ngaySinh" name="gv_ngaySinh" ng-model="giaovien.gv_ngaySinh">

					</div>
		         	<div class="form-group">
		         		<label for="gv_phai">Phái:</label><br>
		         		<input ng-model="giaovien.gv_phai" type="radio" name="gv_phai" ng-value="1"> Nam
		         		<input ng-model="giaovien.gv_phai" type="radio" name="gv_phai" ng-value="0" > Nữ<br>
		         	</div>
		         	<div class="form-group">
		         		<label for="gv_diaChi">Địa chỉ:</label>
		         		<input type="text" class="form-control" id="gv_diaChi"  name="gv_diaChi" placeholder="" ng-model="giaovien.gv_diaChi" required="true">
		         		<span class="text-danger" ng-show="frmGiaoVien.gv_diaChi.$error.required">Bạn chưa nhập địa chỉ</span>
		         	</div>
		         	<div class="form-group">
		         		<label for="gv_email">Địa chỉ email:</label>
		         		<input type="email" class="form-control" id="gv_email" name="gv_email" placeholder="" ng-model="giaovien.gv_email" required="true">
		         		<span class="text-danger" ng-show="frmGiaoVien.gv_email.$error.required">Bạn chưa nhập email</span>
		         		<span class="text-danger" ng-show="frmGiaoVien.gv_email.$error.email">Email không hợp lệ</span>         		
		         	</div>

		         	<div class="form-group">
		         		<label for="gv_dienThoai">Điện thoại:</label>
		         		<input type="text" class="form-control" id="gv_dienThoai" name="gv_dienThoai" placeholder="" ng-model="giaovien.gv_dienThoai" ng-maxlength="11">
		         		<span class="text-danger" ng-show="frmGiaoVien.gv_dienThoai.$error.maxlength">Số điện thoại không hợp lệ</span>
		         	</div>
		         	<div class="form-group">
		         		<label for="cm_ma">Mã chuyên môn:</label>
		         		<select class="custom-select" name="cm_ma" id="cm_ma" ng-model="giaovien.cm_ma">
		         			<option ng-repeat="cm in ds_toCM" ng-value="cm.cm_ma" value="<% cm.cm_ma %>"><% cm.cm_moTa %></option>
		         		</select>
		         	</div>
		        
	      		</div>

	      		<!-- Modal footer -->
	      		<div class="modal-footer" >
		        	<button type="button" class="btn btn-primary" data-dismiss="modal" ng-disabled="frmGiaoVien.$invalid" ng-click="save(state,giaovien.gv_ma)">Lưu</button>
		      	</div>
			</form>  	
    	</div>
	  </div>
	</div>
</div>

@endsection
@section('body.js')
	<script type="text/javaScript" src="{{asset('app/GiaoVienController.js')}}"></script>
@endsection
