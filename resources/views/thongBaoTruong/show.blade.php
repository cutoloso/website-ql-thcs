@extends('layouts.master')
@section('head.css')
@endsection
@section('body.title','Danh sách thông báo trường')
@section('body.content')
<div class="col-12">
	<embed src="http://localhost/QL-THCS/storage/app/{{$thongBaoTruong->tbt_noiDung}}" type="application/pdf" width="100%">
</div>
@endsection
@section('body.js')
@endsection