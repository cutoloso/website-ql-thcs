@extends('layouts.master')
@section('head.css')
<style>
	.article{
		color: #444;
	}
	a:link {
	  	text-decoration: none;
	}
	.title{
		color: #000;
	}
</style>
@endsection
@section('body.title','Danh sách chủ đề góp ý')
@section('body.content')
<div class="col-12" ng-controller="ChuDeController">
	<div class="alert alert-<% alert.error == true ? 'danger':'success' %>" ng-show="alert.show">
	  <strong><% alert.message %></strong>
	</div>
	@if(Auth::user()->level == 2)
		<button class="btn btn-success" ng-click="modal('ph')">Thêm góp ý phụ huynh</button>
		<button class="btn btn-success" ng-click="modal('hs')">Thêm góp ý học sinh</button>
	@elseif(Auth::user()->level == 3 || Auth::user()->level == 4)
		<button class="btn btn-success" ng-click="modal('gv')">Thêm góp ý giáo viên</button>
	@endif
	<hr >
	@if(Auth::user()->level == 2) {{-- giáo viên --}}
		<h5 class="title">Danh sách chủ đề góp ý với giáo viên</h5>
		<div class="col-md-10 offset-1 article" ng-repeat="cd_gvph in ds_chuDe_GVPH">
			<hr>
			<p class="text-right"> <% cd_gvph.gv_ma%> - <% cd_gvph.ph_ma%></p>
			<h5> <% cd_gvph.cd_gvph_ten  %> </h5>
			<p class="text-right"><a href="http://localhost/QL-THCS/public/quan-tri/gop-y/gvph/<% cd_gvph.cd_gvph_ma %>">Trả lời <i class="fas fa-angle-double-right"></i></a></p>
		</div>
		<hr>
		<h5 class="title">Danh sách chủ đề góp ý với học sinh</h5>
		<div class="col-md-10 offset-1 article" ng-repeat="cd_gvhs in ds_chuDe_GVHS">
			<hr>
			<p class="text-right"> <% cd_gvhs.gv_ma%> - <% cd_gvhs.hs_ma%> </p>
			<h5> <% cd_gvhs.cd_gvhs_ten  %> </h5>
			<p class="text-right"><a href="http://localhost/QL-THCS/public/quan-tri/gop-y/gvhs/<% cd_gvhs.cd_gvhs_ma %>">Trả lời <i class="fas fa-angle-double-right"></i></a></p>
		</div>
	@elseif(Auth::user()->level == 3) {{-- phụ huynh --}}
		<h5 class="title">Danh sách chủ đề góp ý với phụ huynh</h5>
		<div class="col-md-10 offset-1 article" ng-repeat="cd_gvph in ds_chuDe_GVPH">
			<hr>
			<p class="text-right"> <% cd_gvph.ph_ma%> - <% cd_gvph.gv_ma%> </p>
			<h5> <% cd_gvph.cd_gvph_ten  %> </h5>
			<p class="text-right"><a href="http://localhost/QL-THCS/public/quan-tri/gop-y/gvhs/<% cd_gvph.cd_gvph_ma %>">Trả lời <i class="fas fa-angle-double-right"></i></a></p>
		</div>
		<div ng-repeat="ds_gyhs in chudeGVHS">
			<hr>
			<h5 class="title">Danh sách chủ đề góp ý của học sinh <% ds_gyhs[0].hs_ma %> với giáo viên</h5>
			<div class="col-md-10 offset-1 article" ng-repeat="cd_gvhs in ds_gyhs">
				<hr>
				<p class="text-right"> <% cd_gvhs.gv_ma%> - <% cd_gvhs.hs_ma%> </p>
				<h5> <% cd_gvhs.cd_gvhs_ten  %> </h5>
				<p class="text-right"><a href="http://localhost/QL-THCS/public/quan-tri/gop-y/gvhs/<% cd_gvhs.cd_gvhs_ma %>">Trả lời <i class="fas fa-angle-double-right"></i></a></p>
			</div>
		</div>
	@elseif(Auth::user()->level == 4) {{-- học sinh --}}
		<h5 class="title">Danh sách chủ đề góp ý</h5>
		<div class="col-md-10 offset-1 article" ng-repeat="cd_gvhs in ds_chuDe_GVHS">
			<hr>
			<p class="text-right"> <% cd_gvhs.gv_ma%> - <% cd_gvhs.hs_ma%> </p>
			<h5> <% cd_gvhs.cd_gvhs_ten  %> </h5>
			<p class="text-right"><a href="http://localhost/QL-THCS/public/quan-tri/gop-y/gvhs/<% cd_gvhs.cd_gvhs_ma %>">Trả lời <i class="fas fa-angle-double-right"></i></a></p>
		</div>
	@endif

	<!-- The Modal GVHS-->
	<div class="modal fade" id="myModal">
	  <div class="modal-dialog">
	    <div class="modal-content">

	      	<!-- Modal Header -->
	      	<div class="modal-header">
	        	<div class="modal-title">
        			<h4 ng-if="gv">Thêm chủ đề góp ý với giáo viên</h4>
        			<h4 ng-if="ph">Thêm chủ đề góp ý với phụ huynh</h4>
        			<h4 ng-if="hs">Thêm chủ đề góp ý với học sinh</h4>
	        	</div>
	        	<button type="button" class="close" data-dismiss="modal">&times;</button>
	      	</div>

	      	<form action="" name="frmChuDeGopY">
	      	<!-- Modal body -->
	      		<div class="modal-body">

		         	<div class="form-group">
		         		<label for="cd_ten">Tên chủ đề góp ý:</label>
		         		<input type="text" class="form-control" id="cd_ten" name="cd_ten" placeholder="" ng-model="chude.cd_ten" ng-readonly="readOnly" required="true" autofocus>
		         		<span class="text-danger" ng-show="frmChuDeGopY.cd_ten.$error.required">Bạn chưa nhập tên chủ đề góp ý</span>
		         	</div>
		         	@if(Auth::user()->level == 2)
			         	<div class="form-group" ng-if="hs">
			         		<label for="hs_ma">Mã học sinh:</label>
			         		<select name="hs_ma" id="hs_ma" ng-model="chude.hs_ma" required="true">
			         			<option value="">Mã học sinh</option>
			         			<option ng-repeat="hs in ds_hs" ng-value="hs.hs_ma" value="<% hs.hs_ma %>"><% hs.hs_ma %> - <% hs.hs_hoTen%></option>
			         		</select>
			         		<span class="text-danger" ng-show="frmChuDeGopY.hs_ma.$error.required">Bạn chưa chọn</span>
			         	</div>
			         	<div class="form-group" ng-if="ph">
			         		<label for="ph_ma">Mã phụ huynh:</label>
			         		<select name="ph_ma" id="ph_ma" ng-model="chude.ph_ma" required="true">
			         			<option value="">Mã phụ huynh</option>
			         			<option ng-repeat="ph in ds_ph" ng-value="ph.ph_ma" value="<% ph.ph_ma %>"><% ph.ph_ma %> - <% ph.ph_hoTen%></option>
			         		</select>
			         		<br>
			         		<span class="text-danger" ng-show="frmChuDeGopY.ph_ma.$error.required">Bạn chưa chọn</span>
			         	</div>
		         	@elseif(Auth::user()->level == 3 || Auth::user()->level == 4)
		         		<div class="form-group">
			         		<label for="gv_ma">Mã giáo viên:</label>
			         		<select name="gv_ma" id="gv_ma" ng-model="chude.gv_ma" required="true">
			         			<option value="">Mã giáo viên</option>
			         			<option ng-repeat="gv in ds_gv" ng-value="gv.gv_ma" value="<% gv.gv_ma %>"><% gv.gv_ma %> - <% gv.gv_hoTen%></option>
			         		</select>
			         		<span class="text-danger" ng-show="frmChuDeGopY.gv_ma.$error.required">Bạn chưa chọn</span>
			         	</div>
			        @endif
	      		</div>

	      		<!-- Modal footer -->
	      		<div class="modal-footer" >
		        	<button type="button" class="btn btn-primary" data-dismiss="modal" ng-disabled="frmChuDeGopY.$invalid" ng-click="save('{{Auth::user()->name}}')">Lưu</button>
		      	</div>
			</form>
	      	
	    </div>
	  </div>
	</div>
</div>
@endsection
@section('body.js')
	<script type="text/javaScript" src="{{asset('app/ChuDeController.js')}}"></script>
@endsection