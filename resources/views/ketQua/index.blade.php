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
@section('body.title','Danh sách kết quả điểm')
@section('body.content')
<div ng-controller="KetQuaController" style="width: 100%;">
	<div class="alert alert-<% alert.error == true ? 'danger':'success' %>" ng-show="alert.show">
		<strong><% alert.message %></strong>
	</div>
	<div class="row">
		<div class="form-group col-md-4 text-center">
			<label for="khoi">Khối : </label>
			<select name="khoi" id="khoi" ng-model="khoi" ng-change="reLoadPage()" ng->
				<option value="">---Vui lòng chọn--</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
			</select>
		</div>

		<div class="form-group  col-md-4 text-center">
			<label for="l_ma">Lớp: </label>
			<select name="l_ma" id="l_ma" ng-model="l_ma" {{-- ng-change="reLoadPage() --}}">
				<option value="">---Vui lòng chọn--</option>
				<option ng-repeat="l in ds_lop" ng-value="l.l_ma" value="<% l.l_ma %>"><% l.l_ma %></option>
			</select>
		</div>

		<div class="form-group  col-md-4 text-center">
			<label for="hk_hocKy">Học kỳ: </label>
			<select name="hk_hocKy" id="hk_hocKy" ng-model="hk_hocKy" ng-change="reLoadPage()" ng->
				<option value="">---Vui lòng chọn--</option>
				<option value="1">1</option>
				<option value="2">2</option>
			</select>
		</div>
	</div>
	<br>
	<div class="table-responsive">
		<table class="table table-bordered table-hover">
			<tr>
				<th>Lớp</th>
				<th ng-click="sort()" style="cursor: pointer;">Mã <i class="fa fa-caret-<% sortReverse? 'up':'down' %>"></i></th>
				<th>Họ tên</th>
				<th>Ngày sinh</th>
				<th>Phái</th>
				<th>Chi tiết</th>
				{{-- <th>Điểm TBCN</th> --}}
				
			</tr>
			<tr ng-repeat="hs in ds_hs | orderBy : sortExpression: sortReverse">
				<td><%khoi%><%hs.l_ma%></td>
				<td><% hs.hs_ma %></td>
				<td><% hs.hs_hoTen %></td>
				<td  ng-bind="hs.hs_ngaySinh | date: 'dd/MM/yyyy'"></td>
				<td><% hs.hs_phai > 0 ? 'Nam':'Nữ' %></td>
				{{-- <td><% diemTBCN(hs.hs_ma) %></td> --}}
				<td class="text-center"><a href=""  ng-click="modal(hs.hs_ma)" ><i class="fas fa-eye"></i></a></td>
			</tr>
		</table>
	</div>
	<!-- The Modal -->
	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Điểm tổng kết HK<% hk_hocKy %> năm học <%year-hk_hocKy +'-'+year %></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<form action="" name="frmHocSinh">
					<!-- Modal body -->
					<div class="modal-body">

						<div class="table-responsive ">
							<table class=" table table-bordered table-hover  text-center">
								<thead >
									<caption></caption>
									<tr>
										<th style="text-align: center;">Mã môn</th>
										<th style="text-align: center;">Điểm</th>
										<th style="text-align: center;">Hệ số</th>
										<th style="text-align: center;">Lần</th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="kq in ds_kq |orderBy:['mh_ma','kq_heSo','kq_lan']">
										<td {{-- ng-if="!$first ? ds_kq[$index-1].mh_ma != ds_kq[$index].mh_ma : true" rowspan="2" --}}>
											<% kq.mh_ma %>
										</td>
										<td><% kq.kq_diem.toPrecision(3) %></td>
										<td><% kq.kq_heSo %></td>
										<td><% kq.kq_lan %></td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td>Điểm tổng</td>
										<td><% diemTBCN %></td>
										<td></td>
										<td></td>
									</tr>
								</tfoot>
							</table>
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
<script type="text/javaScript" src="{{asset('app/KetQuaController.js')}}"></script>
@endsection
