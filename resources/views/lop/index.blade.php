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
@section('body.title','Danh sách lớp học')
@section('body.content')
<div ng-controller="LopController" style="width: 100%;">
	<div class="alert alert-<% alert.error == true ? 'danger':'success' %>" ng-show="alert.show">
	  <strong><% alert.message %></strong>
	</div>
	<div class="form-group">
		<label for="khoi">Khối : </label>
		<select name="khoi" id="khoi" ng-model="khoi" ng-change="reLoadPage()" ng->
			<option value="">--Vui lòng chọn--</option>
 			<option value="6">6</option>
 			<option value="7">7</option>
 			<option value="8">8</option>
 			<option value="9">9</option>
 		</select>
	</div>
	<br>
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
		  <tr>
		    <th ng-click="sort()" style="cursor: pointer;">Mã lớp <i class="fa fa-caret-<% sortReverse? 'up':'down' %>"></i></th>
		    <th>Khóa học</th>
		    <th>Mã phòng học</th>
		    <th>Mã gíao viên chủ nhiệm</th>
		    <th colspan="2" class="text-center">
		    	<a href=""  ng-click="modal('add')" ><i class="fas fa-plus"></i></a>
		    </th>
		  </tr>
		  <tr ng-repeat="l in ds_lop | orderBy : sortExpression: sortReverse">
		    <td><% l.l_ma %></td>
		    <td><% l.kh_khoaHoc %></td>
		    <td><% l.p_ma %></td>
		    <td><% l.gv_ma %></td>
		    <td class="text-center">
		    	<a href="" ng-click="modal('edit', l.l_ma, l.kh_khoaHoc, l.p_ma, l.gv_ma)" ><i class="fas fa-edit"></i></a>
		    </td>
		    <td class="text-center">
		    	<a href=""><i class="fa fa-minus" ng-click="confirmDelete(l.l_ma, l.kh_khoaHoc)"></i></a>
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

	      	<form action="" name="frmLop">
	      	<!-- Modal body -->
	      		<div class="modal-body">

		         	<div class="form-group">
		         		<label for="l_ma">Mã lớp:</label>
		         		<input type="text" class="form-control" id="l_ma" name="l_ma" placeholder="" ng-model="lop.l_ma" ng-readonly="readOnly" required="true" ng-maxlength="10" autofocus ng-blur="checkMaLop()">
		         		<span class="text-danger" ng-show="frmLop.l_ma.$error.required">Bạn chưa nhập mã</span>
		         		<span class="text-danger" ng-show="frmLop.l_ma.$error.maxlength">Mã không hợp lệ</span>
		         		<span class="text-danger" ng-show="check">Mã lớp đã tồn tại</span>
		         		
		         	</div>
		         	<div class="form-group">
		         		<label for="kh_khoaHoc">Khóa học:</label>
		         		<input type="text" class="form-control" id="kh_khoaHoc" name="kh_khoaHoc" placeholder="" ng-model="lop.kh_khoaHoc" ng-readonly="true" required="true" ng-maxlength="10">
		         	</div>
					<div class="form-group">
		         		<label for="p_ma">Mã phòng học:</label>
		         		<select class="custom-select" name="p_ma" id="p_ma" ng-model="lop.p_ma" required>
		         			<option value="">Mã phòng học:</option>
		         			<option ng-repeat="ph in ds_p" ng-value="ph.p_ma" value="<% ph.p_ma %>"><% ph.p_ma %></option>
		         		</select>
		         		<span class="text-danger" ng-show="frmLop.p_ma.$error.required">Bạn chưa nhập mã</span>
		         	</div>
		         	<div class="form-group">
		         		<label for="gv_ma">Mã gíao viên chủ nhiệm:</label>
		         		<select class="custom-select" name="gv_ma" id="gv_ma" ng-model="lop.gv_ma" required>
		         			<option value="">Mã gíao viên</option>
		         			<option ng-repeat="gv in ds_gv" ng-value="gv.gv_ma" value="<% gv.gv_ma %>"><% gv.gv_ma %> - <% gv.gv_hoTen%></option>
		         		</select>
		         		<span class="text-danger" ng-show="frmLop.gv_ma.$error.required">Bạn chưa nhập mã</span>
		         	</div>
		        
	      		</div>

	      		<!-- Modal footer -->
	      		<div class="modal-footer" >
		        	<button type="button" class="btn btn-primary" data-dismiss="modal" ng-disabled="frmLop.$invalid" ng-click="save(state,lop.l_ma)">Lưu</button>
		      	</div>
			</form>
	      	
	    </div>
	  </div>
	</div>
</div>

@endsection
@section('body.js')
	<script type="text/javaScript" src="{{asset('app/LopController.js')}}"></script>
@endsection
