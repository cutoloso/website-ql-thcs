@extends('khach.layouts.master')
@section('head.title','Trang chủ | Liên hệ')
@section('head.css')
<style>
	.contact i{
		margin-right: 10px;
	}
</style>
@endsection
@section('body.content')
<div class="row contact">
	<div class="col-md-8 offset-1">
		<div class="card">
			<div class="card-header">Liên hệ</div>
			<div class="card-body">
				<p>
					<i class="fas fa-phone"></i>
					<span>Điện thoại: (0292)3 xxx.xxx</span>
				</p>
				<p>
					<i class="fas fa-envelope"></i>
					<span>Email: thcs-dcthanh@edu.vn</span>
				</p>
			</div>
		</div>
	</div>
</div>
@endsection

