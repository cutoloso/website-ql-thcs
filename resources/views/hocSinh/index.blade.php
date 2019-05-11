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
@section('body.title','Danh sách học sinh theo lớp')
@section('body.content')
<div ng-controller="HocSinhController" class="col-12">
	<div class="alert alert-<% alert.error == true ? 'danger':'success' %>" ng-show="alert.show">
	  <strong><% alert.message %></strong>
	</div>
	<div class="row">
		<div class="form-group col-md-6 text-center">
			<label for="khoi">Khối : </label>
			<select name="khoi" id="khoi" ng-model="khoi" ng-change="reLoadPage()" ng->
				<option value="">---Vui lòng chọn--</option>
	 			<option value="6">6</option>
	 			<option value="7">7</option>
	 			<option value="8">8</option>
	 			<option value="9">9</option>
	 		</select>
		</div>

		<div class="form-group  col-md-6 text-center">
			<label for="l_ma">Lớp: </label>
			<select name="l_ma" id="l_ma" ng-model="hocsinh.l_ma" ng-change="reLoadPage()">
				<option value="">---Vui lòng chọn--</option>
	 			<option ng-repeat="l in ds_lop" ng-value="l.l_ma" value="<% l.l_ma %>"><% l.l_ma %></option>
	 		</select>
		</div>
	</div>
	{{-- <select ng-model="hocsinh.l_ma" ng-options="l.l_ma for l in ds_lop" ng-change="reLoadPage()">
      </select> --}}
	<br>
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
		  <tr>
		    <th>Lớp</th>
		    <th ng-click="sort()" style="cursor: pointer;">Mã <i class="fa fa-caret-<% sortReverse? 'up':'down' %>"></i></th>
		    <th>Họ tên</th>
		    <th>Ngày sinh</th>
		    <th>Phái</th>
		    <th>Địa chỉ</th>
		    <th>Mã phụ huynh</th>
		    <th>Tốt nghiệp</th>
		    <th colspan="2" class="text-center">
		    	<a href=""  ng-click="modal('add')" ><i class="fas fa-user-plus" ></i></a>
		    </th>
		  </tr>
		  <tr ng-repeat="hs in ds_hs | orderBy : sortExpression: sortReverse">
		    <td><%hocsinh.khoi%><%hs.l_ma%></td>
		    <td><% hs.hs_ma %></td>
		    <td><% hs.hs_hoTen %></td>
		    <td  ng-bind="hs.hs_ngaySinh | date: 'dd/MM/yyyy'"></td>
			<td><% hs.hs_phai > 0 ? 'Nam':'Nữ' %></td>
		    <td><% hs.hs_diaChi %></td>
		    <td><% hs.ph_ma %></td>
		    <td class="text-center">
		    	@if(Auth::user()->status == 0) <i class="fas fa-check"></i>
		    	@else <i class="fas fa-times"></i>
		    	@endif
		    </td>
		    <td class="text-center">
		    	<a href="" ng-click="modal('edit',hs.hs_ma)" ><i class="fas fa-user-edit"></i></a>
		    </td>
		    <td class="text-center">
		    	<a href=""><i class="fas fa-user-minus" ng-click="confirmDelete(hs.hs_ma)"></i></a>
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

	      	<form action="" name="frmHocSinh">
	      	<!-- Modal body -->
	      		<div class="modal-body">

		         	<div class="form-group">
		         		<label for="hs_ma">Mã:</label>
		         		<input type="text" class="form-control" id="hs_ma" name="hs_ma" placeholder="" ng-model="hocsinh.hs_ma" ng-readonly="readOnly" required="true" ng-maxlength="10" autofocus>
		         		<span class="text-danger" ng-show="frmHocSinh.hs_ma.$error.required">Bạn chưa nhập mã</span>
		         		<span class="text-danger" ng-show="frmHocSinh.hs_ma.$error.maxlength">Mã không hợp lệ</span>
		         	</div>
		         	<div class="form-group">
		         		<label for="hs_hoTen">Họ tên:</label>
		         		<input type="text" class="form-control" id="hs_hoTen" name="hs_hoTen" placeholder="" ng-model="hocsinh.hs_hoTen" required="true" ng-maxlength="100">
		         		<span class="text-danger" ng-show="frmHocSinh.hs_hoTen.$error.required">Bạn chưa nhập họ tên</span>
		         	</div>
		         	<div class="form-group">
		         		<label for="hs_ngaySinh">Ngày sinh:</label>
		         		<input type="date" class="form-control" id="hs_ngaySinh" name="hs_ngaySinh" ng-model="hocsinh.hs_ngaySinh">
					</div>
		         	<div class="form-group">
		         		<label for="hs_phai">Phái:</label><br>
		         		<input ng-model="hocsinh.hs_phai" type="radio" name="hs_phai" ng-value="1"> Nam
		         		<input ng-model="hocsinh.hs_phai" type="radio" name="hs_phai" ng-value="0" > Nữ<br>
		         	</div>
		         	<div class="form-group">
		         		<label for="hs_diaChi">Địa chỉ:</label>
		         		<input type="text" class="form-control" id="hs_diaChi"  name="hs_diaChi" placeholder="" ng-model="hocsinh.hs_diaChi" required="true">
		         		<span class="text-danger" ng-show="frmHocSinh.hs_diaChi.$error.required">Bạn chưa nhập địa chỉ</span>
		         	</div>
		         	<div class="form-group">
		         		<label for="ph_ma">Mã phụ huynh:</label>
		         		<select class="custom-select" name="ph_ma" id="ph_ma" ng-model="hocsinh.ph_ma">
		         			<option value="">Mã - Họ Tên</option>
		         			<option ng-repeat="ph in ds_ph" ng-value="ph.ph_ma" value="<% ph.ph_ma %>"><% ph.ph_ma %> - <% ph.ph_hoTen%></option>
		         		</select>
		         	</div>
		        
	      		</div>

	      		<!-- Modal footer -->
	      		<div class="modal-footer" >
		        	<button type="button" class="btn btn-primary" data-dismiss="modal" ng-disabled="frmHocSinh.$invalid" ng-click="save(state,hocsinh.hs_ma)">Lưu</button>
		      	</div>
			</form>
	      	
	    </div>
	  </div>
	</div>
</div>

@endsection
@section('body.js')
	<script type="text/javaScript" src="{{asset('app/HocSinhController.js')}}"></script>
@endsection
