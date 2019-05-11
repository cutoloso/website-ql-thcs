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
@section('body.title','Danh sách học sinh lớp chủ nhiệm')
@section('body.content')
<div ng-controller="GiaoViendsHSController" style="width: 100%;">
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
		  </tr>
		  <tr ng-repeat="hs in ds_hs | orderBy : sortExpression: sortReverse">
		    <td><%khoi%><%hs.l_ma%></td>
		    <td><% hs.hs_ma %></td>
		    <td><% hs.hs_hoTen %></td>
		    <td  ng-bind="hs.hs_ngaySinh | date: 'dd/MM/yyyy'"></td>
			<td><% hs.hs_phai > 0 ? 'Nam':'Nữ' %></td>
		    <td><% hs.hs_diaChi %></td>
		    <td><% hs.ph_ma %></td>
		  </tr>
		</table>
	</div>

</div>

@endsection
@section('body.js')
<script type="text/javascript">
	var user_name = '{{Auth::user()->name}}';
</script>
	<script type="text/javaScript" src="{{asset('app/GiaoViendsHSController.js')}}"></script>
@endsection
