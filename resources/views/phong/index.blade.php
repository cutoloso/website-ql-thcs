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
@section('body.title','Danh sách phòng')
@section('body.content')

<div ng-controller="PhongController" style="width: 100%;">
	<div class="alert alert-<% alert.error == true ? 'danger':'success' %>" ng-show="alert.show">
	  <strong><% alert.message %></strong>
	</div>
	<div class="table-responsive" >
		<table class="table table-bordered table-hover">
		  <tr>
		    <th ng-click="sort()" style="cursor: pointer;">Mã phòng  <i class="fa fa-caret-<% sortReverse? 'up':'down' %>"></i></th>
		    <th>Sức chứa</th>
		    <th>Ghi chú</th>
		    <th colspan="2" class="text-center">
		    	<a href=""  ng-click="modal('add')" ><i class="fa fa-plus"></i></a>
		    </th>
		  </tr>
		  <tr ng-repeat="p in ds_p | orderBy : sortExpression: sortReverse">
		    <td><% p.p_ma %></td>
		    <td><% p.p_sucChua %></td>
		    <td><% p.p_ghiChu %></td>
		    <td class="text-center">
		    	<a href="" ng-click="modal('edit',p.p_ma)" ><i class="fas fa-edit"></i></a>
		    </td>
		    <td class="text-center">
		    	<a href="" ng-click="confirmDelete(p.p_ma)"><i class="fa fa-minus" ></i></a>
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

	      	<form action="" name="frmPhong">
	      	<!-- Modal body -->
	      		<div class="modal-body">

		         	<div class="form-group">
		         		<label for="p_ma">Mã phòng:</label>
		         		<input type="text" class="form-control" id="p_ma" name="p_ma" placeholder="" ng-model="phong.p_ma" ng-readonly="readOnly" required="true" ng-maxlength="3" autofocus>
		         		<span class="text-danger" ng-show="frmPhong.p_ma.$error.required">Bạn chưa nhập mã</span>
		         		<span class="text-danger" ng-show="frmPhong.p_ma.$error.maxlength">Mã không hợp lệ, tối đa là 3 ký tự</span>
		         	</div>
		         	<div class="form-group">
		         		<label for="p_sucChua">Sức chứa:</label>
		         		<input type="text" class="form-control" id="p_sucChua" name="p_sucChua" placeholder="" ng-model="phong.p_sucChua">
		         	</div>
		         	<div class="form-group">
		         		<label for="p_ghiChu">Ghi chú:</label>
		         		<input type="text" class="form-control" id="p_ghiChu"  name="p_ghiChu" placeholder="" ng-model="phong.p_ghiChu" required="true">
		         		<span class="text-danger" ng-show="frmPhong.p_ghiChu.$error.required">Bạn chưa nhập ghi chú</span>
		         	</div>
	      		</div>

	      		<!-- Modal footer -->
	      		<div class="modal-footer" >
		        	<button type="button" class="btn btn-primary" data-dismiss="modal" ng-disabled="frmPhong.$invalid" ng-click="save(state,phong.p_ma)">Lưu</button>
		      	</div>
			</form>
	      	
	    </div>
	  </div>
	</div>
</div>

@endsection
@section('body.js')
	<script type="text/javaScript" src="{{asset('app/PhongController.js')}}"></script>
@endsection
