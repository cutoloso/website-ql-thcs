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
	#box-search{
		margin-top: 2rem;
	}
</style>
@endsection
@section('body.title','Danh sách kết quả điểm')
@section('body.content')
<div ng-controller="HocSinhDiemController" class="col-12">
	<div class="row">
		<div class="col-md-6 form-group text-center">
			<label for="hk_hocKy">Học kỳ: </label>
			<select ng-model="hk_hocKy"required ng-change="reLoadPage()">
				<option value="">---Vui lòng chọn--</option>
				<option value="1">1</option>
				<option value="2">2</option>
			</select>
		</div>
		
		<div class="col-md-6 form-group">
			<label for="mh_ma">Mã chuyên môn:</label>
			<select ng-model="mh_ma" required ng-change="reLoadPage()">
				<option value="">---Vui lòng chọn--</option>
				<option ng-repeat="mh in ds_mh" ng-value="mh.mh_ma" value="<% mh.mh_ma %>"><% mh.mh_ten %></option>
			</select>
		</div>
	</div>
	<div class=" table-responsive ">
		<table class=" table table-bordered table-hover  text-center">
			<thead >
				<caption></caption>
				<tr>
					<th style="text-align: center;">Điểm</th>
					<th style="text-align: center;">Hệ số</th>
					<th style="text-align: center;">Lần</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="kq in ds_kq |orderBy:['mh_ma','kq_heSo','kq_lan']">
					<td><% kq.kq_diem.toPrecision(3) %></td>
					<td><% kq.kq_heSo %></td>
					<td><% kq.kq_lan %></td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="3">Điểm tổng: <% diemTBCN %> </td>
				</tr>
			</tfoot>
		</table>
	</div>

</div>

@endsection
@section('body.js')
<script type="text/javascript">
	var user_name = '{{Auth::user()->name}}';
</script>
<script type="text/javaScript" src="{{asset('app/HocSinhDiemController.js')}}"></script>
@endsection
