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
			</tr>
			<tr ng-repeat="tbl in ds_tbl | orderBy : sortExpression: sortReverse">
				<td><% tbl.tbl_ma %></td>
				<td ng-bind="tbl.tbl_ngayBD | date: 'dd/MM/yyyy'"></td>
				<td ng-bind="tbl.tbl_ngayKT | date: 'dd/MM/yyyy'"></td>
				<td><% tbl.tbl_noiDung %></td>
			</tr>
		</table>
	</div>


</div>
@endsection
@section('body.js')
<script type="text/javaScript" src="{{asset('app/ThongBaoLopController.js')}}"></script>
@endsection
