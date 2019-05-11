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
@section('body.title','Danh sách dạy học')
@section('body.content')
<div ng-controller="DayController" style="width: 100%;">
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
		<div class="form-group col-md-6 text-center">
			<label for="l_ma">Lớp : </label>
			<select name="l_ma" id="l_ma" ng-model="l_ma" ng-change="reLoadPage()">
				<option value="">---Vui lòng chọn--</option>
	 			<option ng-repeat="l in ds_lop" ng-value="l.l_ma" value="<% l.l_ma %>"><% l.l_ma %></option>
	 		</select>
		</div>
	</div>
	<br>
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
		  <tr>
		    <th>STT</th>
		    <th ng-click="sort()" style="cursor: pointer;">Môn học  <i class="fa fa-caret-<% sorteverse? 'up':'down' %>"> </i></th>
		    <th>Mã - Họ tên giáo viên</th>
		    <th colspan="2" class="text-center">
		    	<a href="" ng-show="add" ng-click="modal('add')" ><i class="fas fa-plus"></i></i></a>
		    </th>
		  </tr>
		  <tr ng-repeat="d in ds_d | orderBy : sortExpression: sortReverse">
		    <td><% $index+1 %></td>
		    <td><% d.mh_ten %></td>
		    <td><% d.gv_ma %> - <% d.gv_hoTen %></td>
		    <td class="text-center">
		    	<a href="" ng-click="modal('edit', d.cm_ma, d.gv_ma)" ><i class="fas fa-edit"></i></a>
		    </td>
		    <td class="text-center">
		    	<a href="" ng-click="confirmDelete(d.mh_ma,d.gv_ma)" ><i class="fas fa-minus" ></i></a>
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

	      	<form action="" name="frmDay">
	      		@csrf
	      	<!-- Modal body -->
	      		<div class="modal-body">
		         	<div class="form-group">
		         		<label for="cm_ma">Mã môn học:</label>
		         		<select class="custom-select" name="cm_ma" id="cm_ma" ng-model="day.cm_ma" ng-change="loadGiaoVien()" ng-disabled="readOnly" required="true">
		         			<option value="">---Vui lòng chọn---</option>
		         			<option ng-repeat="cm in ds_cm" ng-value="cm.cm_ma" value="<% cm.cm_ma %>"><% cm.cm_ma %> - <% cm.cm_moTa %></option>
		         		</select>
		         		<span class="text-danger" ng-show="frmDay.cm_ma.$error.required">Bạn chưa chọn môn học</span>
		         	</div>

		         	<div class="form-group">
		         		<label for="gv_ma">Mã gíao viên:</label>
		         		<select class="custom-select" name="gv_ma" id="gv_ma" ng-model="day.gv_ma" required="true">
		         			<option value="">---Vui lòng chọn---</option>
		         			<option ng-repeat="gv in ds_gv" ng-value="gv.gv_ma" value="<% gv.gv_ma %>"><% gv.gv_ma %> - <% gv.gv_hoTen%></option>
		         		</select>
		         		<span class="text-danger" ng-show="frmDay.cm_ma.$error.required">Bạn chưa chọn giáo viên dạy</span>
		         	</div>
		         	
		        
	      		</div>

	      		<!-- Modal footer -->
	      		<div class="modal-footer" >
		        	<button type="button" class="btn btn-primary" data-dismiss="modal" ng-disabled="frmDay.$invalid" ng-click="save(state,day.cm_ma)">Lưu</button>
		      	</div>
			</form>
	      	
	    </div>
	  </div>
	</div>
</div>

@endsection
@section('body.js')
	<script type="text/javaScript" src="{{asset('app/DayController.js')}}"></script>
@endsection
