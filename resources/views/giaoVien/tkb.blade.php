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
		text-align: center;
	}

	table tr:nth-child(even){background-color: #f2f2f2;}

	table tr:hover {background-color: #ddd;}

	table th {
		padding-top: 8px;
		padding-bottom: 8px;
		text-align: center;
		background-color: #4CAF50;
		color: white;
	}
	i{
		color: #333;
	}
</style>
@endsection
@section('body.title','Thời khóa biểu của giáo viên')
@section('body.content')
<div ng-controller="GiaoVienTKBController" style="width: 100%;">
	<div class="col-12 text-center form-group">
			<label for="hk_hocKy">Học kỳ : </label>
			<select name="hk_hocKy" id="hk_hocKy" ng-model="hk_hocKy" ng-change="reLoadPage()">
				<option value="">---Vui lòng chọn--</option>
				<option value="1">1</option>
				<option value="2">2</option>
			</select>
		</div>
	<div class="col-md-12 table-responsive" >
		<table class="table table-bordered table-hover">
			<tr>
				<th ng-click="sort()" style="cursor: pointer;">Thứ<i class="fa fa-caret-<% sortReverse? 'up':'down' %>"></i></th>
				<th>Buổi</th>
				<th>Tiết học</th>
				<th>Môn học</th>
				<th>Lớp</th>
			</tr>
			<tr ng-repeat="tkb in ds_tkb">
				<th><% tkb.t_ma %></th>
				<td><% tkb.th_buoi=='s' ? 'Sáng':'Chiều' %></td>
				<td><% tkb.th_stt %></td>
				<td><% tkb.mh_ma %></td>
				<td><% khoi(tkb.kh_khoaHoc) %><% tkb.l_ma %></td>
			</tr>
		</table>
	</div>

</div>

@endsection
@section('body.js')
<script type="text/javascript">
	var user_name = '{{Auth::user()->name}}';
</script>
<script type="text/javaScript" src="{{asset('app/GiaoVienTKBController.js')}}"></script>
@endsection
