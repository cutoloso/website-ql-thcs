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
@section('body.title','Danh sách khóa học')
@section('body.content')

<div ng-controller="KhoaHocController"  style="width: 100%;">
	<div class="alert alert-<% alert.error == true ? 'danger':'success' %>" ng-show="alert.show">
	  <strong><% alert.message %></strong>
	</div>
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
		  <tr>
		    <th ng-click="sort()" style="cursor: pointer;">Niên khóa <i class="fa fa-caret-<% sortReverse? 'up':'down' %>"></i></th>
		    <th colspan="2" class="text-center">
		    	<a href=""  ng-click="modal('add')" ><i class="fa fa-plus"></i></a>
		    </th>
		  </tr>
		  <tr ng-repeat="kh in ds_kh | orderBy : sortExpression: sortReverse">
		    <td><% kh.kh_khoaHoc %></td>
		    <td class="text-center">
		    	<a href="" ng-click="modal('edit',kh.kh_khoaHoc)" ><i class="fas fa-edit"></i></a>
		    </td>
		    <td class="text-center">
		    	<a href="" ng-click="confirmDelete(kh.kh_khoaHoc)"><i class="fa fa-minus" ></i></a>
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

	      	<form action="" name="frmKhoaHoc">
	      	<!-- Modal body -->
	      		<div class="modal-body">

		         	<div class="form-group">
		         		<label for="kh_khoaHoc">Niên khóa:</label>
		         		<input type="text" class="form-control" id="kh_khoaHoc" name="kh_khoaHoc" placeholder="" ng-model="khoahoc.kh_khoaHoc" ng-readonly="readOnly" required="true" ng-maxlength="4" autofocus>
		         		<span class="text-danger" ng-show="fromKhoaHoc.kh_khoaHoc.$error.required">Bạn chưa nhập khóa học</span>
		         		<span class="text-danger" ng-show="fromKhoaHoc.kh_khoaHoc.$error.maxlength">khóa học không hợp lệ</span>
		         	</div>
	      		</div>

	      		<!-- Modal footer -->
	      		<div class="modal-footer" >
		        	<button type="button" class="btn btn-primary" data-dismiss="modal" ng-disabled="frmKhoaHoc.$invalid" ng-click="save(state,khoahoc.kh_khoaHoc)">Lưu</button>
		      	</div>
			</form>
	      	
	    </div>
	  </div>
	</div>
</div>
@endsection
@section('body.js')
	<script type="text/javaScript" src="{{asset('app/KhoaHocController.js')}}"></script>
@endsection
