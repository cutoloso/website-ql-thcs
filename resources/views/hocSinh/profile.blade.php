@extends('layouts.master')
@section('head.css')
	<link rel="stylesheet" href="{{asset('css/profile.css')}}">
@endsection
@section('body.title','Thông tin tài khoản')
@section('body.content')
<div class="col-md-10 offset-1 card" ng-controller="ProfileController" style="max-width: 100%;">
	<div class="row">
		<div class="col-md-4">
			<img id="avatar" src="{{asset('img/user-profile.png')}}" alt="John">
		</div>
		<div class="col-md-8 profile" >
			<h1>{{$profile->hs_hoTen}}</h1>
			<p class="title">Thông tin cá nhân</p>
			<p>Ngày sinh: {{$profile->hs_ngaySinh}}</p>
			<p>Phái: {{$profile->hs_phai != 0 ? 'Nam':'Nữ'}} </p>
			<p>Địa chỉ: {{$profile->hs_diaChi}}</p>
			<p>Mã lớp: {{$profile->l_ma}}</p>
			<p>Niên khóa: {{$profile->kh_khoaHoc}}</p>
			<p>Mã phụ huynh: {{$profile->ph_ma}}</p>
			<p>Chức vụ: Học sinh</p>
		</div>
	</div>
</div>

@endsection
@section('body.js')
<script type="text/javaScript" src="{{asset('app/ProfileController.js')}}"></script>
@endsection