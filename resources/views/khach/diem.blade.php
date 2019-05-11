@extends('khach.layouts.master')
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
<div ng-controller="DiemController" style="width: 100%;">
	<div id="box-search" >
		<form class="row" name="frmSearch">
		<div class="form-group col-12 text-center">
			<label style="font-size: 1.1rem;">Học kỳ: </label>
			<select ng-model="hk_hocKy"required>
				<option value="">---Vui lòng chọn--</option>
				<option value="1">1</option>
				<option value="2">2</option>
			</select>
		</div>
		<div class="form-group col-12 text-center">
			<h5>Nhập mã số học sinh cần tra điểm</h5>
			<br>
			<div class="form-inline justify-content-center" >
				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" ng-model="hs_ma" name="hs_ma" required>

				<button class="btn btn-outline-success my-2 my-sm-0" type="submit" ng-click="modal()" ng-disabled="frmSearch.$invalid">Search</button>
			</div>
			<span class="text-danger" ng-show="frmSearch.hs_ma.$error.required">Bạn chưa chọn nhập mã học sinh</span>
		</div>
		</form>
	</div>

	<!-- The Modal -->
	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Điểm tổng kết học sinh <% hs_ma %> HK<% hk_hocKy %> năm học <%year-hk_hocKy +'-'+year %></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

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
											<% getTenMonHoc(kq.mh_ma) %>
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

			</div>
		</div>
	</div>
</div>

@endsection
@section('body.js')
<script type="text/javaScript" src="{{asset('app/DiemController.js')}}"></script>
@endsection
