@extends('layouts.master')
@section('head.css')
@endsection
@section('body.title','Danh sách thông báo trường')
@section('body.content')
<div class="col-10 offset-1" ng-controller="ThongBaoController">
	<form action="http://localhost/QL-THCS/public/quan-tri/thong-bao-truong/1" method="POST" name="frmThongBaoTruong" id="frmThongBaoTruong" enctype="multipart/form-data">
		{{ method_field('PUT')}}
		@csrf
		<input name="_method" type="hidden" value="PUT">
		<div class="form-group">
			<label for="tbt_ma">Mã thông báo:</label>
			<input type="text" class="form-control" id="tbt_ma" name="tbt_ma" readonly="true" ng-model="thongbao.tbt_ma" required="true">
			<span class="text-danger" ng-show="frmThongBaoTruong.tbt_ma.$error.required">Bạn chưa nhập tiêu đề</span>
		</div>
		<div class="form-group">
			<label for="tbt_tieuDe">Tiêu đề:</label>
			<input type="text" class="form-control" id="tbt_tieuDe" name="tbt_tieuDe" autofocus ng-model="thongbao.tbt_tieuDe" required="true">
			<span class="text-danger" ng-show="frmThongBaoTruong.tbt_tieuDe.$error.required">Bạn chưa nhập tiêu đề</span>
		</div>
		<div class="form-group">
			<label for="tbt_ngayBD">Ngày bắt đầu:</label>
			<input type="date" class="form-control" id="tbt_ngayBD" name="tbt_ngayBD" ng-model="thongbao.tbt_ngayBD" required="true">
			<span class="text-danger" ng-show="frmThongBaoTruong.tbt_ngayBD.$error.required">Bạn chưa chọn ngày bắt đầu</span>
		</div>
		<div class="form-group">
			<label for="tbt_ngayKT">Ngày kết thúc:</label>
			<input type="date" class="form-control" id="tbt_ngayKT" name="tbt_ngayKT" ng-model="thongbao.tbt_ngayKT" required="true">
			<span class="text-danger" ng-show="frmThongBaoTruong.tbt_ngayKT.$error.required">Bạn chưa chọn ngày kết thúc</span>
		</div>
		<p>Nội dung thông báo:</p>
		<div class="custom-file">
			<input type="file" class="form-control custom-file-input" id="customFile" name="tbt_noiDung" ng-model="thongbao.tbt_noiDung" ng- >
			<label class="custom-file-label" for="customFile">Chọn tệp</label>
		</div>
		<button style="margin: 15px 0" type="submit" class="btn btn-primary" data-dismiss="modal" ng-disabled="frmThongBaoTruong.$invalid" >Lưu</button>
		{{-- <embed src="<%srcPDF%>" type="application/pdf" width="100%" height="500px"> --}}
	</form>
</div>
@endsection
@section('body.js')
<script>

</script>

<script type="text/javaScript" src="{{asset('app/ThongBaoController.js')}}"></script>
@endsection
