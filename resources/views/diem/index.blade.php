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
<div class="col-12" ng-controller="QuanLyDiemController">
	<div class="alert alert-<% alert.error == true ? 'danger':'success' %>" ng-show="alert.show">
		<strong><% alert.message %></strong>
	</div>
	<div class="row">
		<div class="col-md-3 form-group">
			<label for="khoi">Khối : </label>
			<select name="khoi" id="khoi" ng-model="khoi" ng-change="reLoadPage('{{Auth::user()->name}}')" >
				<option value="">---Vui lòng chọn--</option>
				<option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
			</select>
		</div>

		<div class="col-md-3 form-group">
			<label for="l_ma">Lớp: </label>
			<select name="l_ma" id="l_ma" ng-model="l_ma" ng-change="reLoadPage()">
				<option value="">---Vui lòng chọn--</option>
				<option ng-repeat="l in ds_lop" ng-value="l.l_ma" value="<% l.l_ma %>"><% l.l_ma %></option>
			</select>
		</div>

		<div class="col-md-3 form-group">
			<label for="hk_hocKy">Học kỳ: </label>
			<select name="hk_hocKy" id="hk_hocKy" ng-model="hk_hocKy" ng-change="reLoadPage()" ng->
				<option value="">---Vui lòng chọn--</option>
				<option value="1">1</option>
				<option value="2">2</option>
			</select>
		</div>
		<div class="col-md-3">
			<h5>Tổ chuyên môn: <% mh_ten %></h5>
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
				<td class="text-center"><a href=""  ng-click="modal('add',hs.hs_ma)" ><i class="fas fa-eye"></i></a></td>
			</tr>
		</table>
	</div>
	<!-- Start the Modal Thêm-->
	<div class="modal fade" id="modalAdd">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Điểm tổng kết HK<% hk_hocKy %> năm học <%year-hk_hocKy +'-'+year %></h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<form action="" name="frmThemDiem">
					<!-- Modal body -->
					<div class="modal-body">

						<div class="table-responsive ">
							<table id="bangDiem" class=" table table-bordered table-hover  text-center">
								<thead >
									<tr>
										{{-- <th style="text-align: center;">Mã môn</th> --}}
										<th style="text-align: center;">Điểm</th>
										<th style="text-align: center;">Hệ số</th>
										<th style="text-align: center;">Lần</th>
										<th style="text-align: center;" colspan="2" class="text-center">Sửa/Xóa</th>
									</tr>
								</thead>
								<tbody>
									<tr ng-repeat="kq in ds_kq |orderBy:['mh_ma','kq_heSo','kq_lan']" ng-init="maMon = ds_kq[0].mh_ma">
										{{-- <td ng-if="!$first ? ds_kq[$index-1].mh_ma != ds_kq[$index].mh_ma : true" rowspan="2">
											<% kq.mh_ma %>
										</td> --}}
										<td><% kq.kq_diem.toPrecision(3) %></td>
										<td><% kq.kq_heSo %></td>
										<td><% kq.kq_lan %></td>
										<td class="text-center">
											<a href="" ng-click="modal('edit','',kq.mh_ma,kq.kq_diem,kq.kq_heSo,kq.kq_lan)" ><i class="fas fa-edit"></i></a>
										</td>
										<td class="text-center">
											<a href="" ng-click="confirmDelete(kq.mh_ma,kq.kq_heSo,kq.kq_lan)"><i class="fa fa-minus" ></i></a>
										</td>

									</tr>
								</tbody>
								<input type="hidden" value="<% ds_kq[0].mh_ma %>" id="maMon">
								<script type="text/javascript">
									
									function themDiem() {
										// let maMon = document.getElementById('maMon').value;
										let table = document.getElementById("bangDiem");
										let row = table.insertRow(-1);
										let cell1 = row.insertCell(0);
										let cell2 = row.insertCell(1);
										let cell3 = row.insertCell(2);
										let cell4 = row.insertCell(3);
										// let cell5 = row.insertCell(4);
										// cell1.innerHTML = maMon;
										cell1.innerHTML = "<input id='diem' name='diem' type='text' style='width:4rem;'>";
										cell2.innerHTML = "<input type='number' min='1' max='3' id='heSo' name='heSo' style=' width:4rem;'>";
										cell3.innerHTML = "<input type='number' min='1' max='3' id='lan' name='lan' style='width:4rem;' ></form>";
										cell4.innerHTML = "<button id='btn-xoa-row' class='btn btn-danger' onclick='xoaDiem()'>Xóa</button>";
										cell4.setAttribute('colspan','2');
										document.getElementById('btn-add-row').hidden = true;
										document.getElementById('btn-save').disabled = false;
									}
									function xoaDiem() {
										document.getElementById("bangDiem").deleteRow(-1);
										document.getElementById("btn-add-row").hidden = false;
										document.getElementById('btn-save').disabled = true;
									}
								</script>

							</table>
						</div>
						<div class="table-responsive ">
							<table class=" table table-bordered table-hover  text-center">
								<tbody>
									<tr>
										<td colspan="2">
											<button id='btn-add-row' type="button" class="btn btn-success" onclick="themDiem()">Thêm</button>
										</td>
									</tr>

									<tr>
										<td>Điểm tổng</td>
										<td><% diemTBCN %></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer" >
						<button id="btn-save" type="submit" class="btn btn-primary" data-dismiss="modal" ng-disabled="frmThemDiem.$invalid" ng-click="save('add')">Lưu</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--End the Modal Thêm-->
	<!--Start the Modal Sửa-->
	<div class="modal fade" id="modalEdit">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Sửa điểm</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<form action="" name="frmSuaDiem">
					@csrf
					<!-- Modal body -->
					<div class="modal-body">
						<div class="form-group">
							<div class="table-responsive ">
								<table class=" table table-bordered table-hover  text-center">
									<thead >
										<tr>
											{{-- <th style="text-align: center;">Mã môn</th> --}}
											<th style="text-align: center;">Điểm</th>
											<th style="text-align: center;">Hệ số</th>
											<th style="text-align: center;">Lần</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											{{-- <td><input type="text" ng-model="diem.mh_ma" name="monHoc" readonly style=" width:4rem;"></td> --}}
											<td><input type="number" ng-model="diem.kq_diem" name="diemSo" min="0" max="10" style=" width:4rem;"></td>
											<td><input type="number" ng-model="diem.kq_heSo" name="heSo" readonly style=" width:4rem;"></td>
											<td><input type="number" ng-model="diem.kq_lan" name="lanThi" readonly style=" width:4rem;"></td>

										</tr>
									</tbody>
								</table>
							</div>	
							<span class="text-danger" ng-show="frmSuaDiem.diemSo.$error.number">Sai định dạng điểm phải là số</span>
							<span class="text-danger" ng-show="frmSuaDiem.diemSo.$error.max">Sai định dạng điểm phải là số  không vượt quá 10</span>
							<span class="text-danger" ng-show="frmSuaDiem.diemSo.$error.min">Sai định dạng điểm phải là số không nhỏ hơn 0</span>
						</div>
					</div>
					<!-- Modal footer -->
					<div class="modal-footer" >
						<button type="button" class="btn btn-primary" data-dismiss="modal" ng-disabled="frmSuaDiem.$invalid" ng-click="save('edit')">Lưu</button>
					</div>
				</form>

			</div>
		</div>
	</div>
	<!--End the Modal Sửa-->
</div>

@endsection
@section('body.js')
<script type="text/javascript">
	var user_name = '{{Auth::user()->name}}';
</script>
<script type="text/javaScript" src="{{asset('app/QuanLyDiemController.js')}}"></script>
@endsection
