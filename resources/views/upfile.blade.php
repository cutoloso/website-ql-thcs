@extends('layouts.master')
@section('head.css')
@endsection
@section('body.title','Danh sách giáo viên')
@section('body.content')
    <div ng-controller="UpFileController" style="width: 100%;">
    	<form ng-submit="sub()" action="" name="frmUpFile" enctype="multipart/form-data" method="POST">
    		@csrf
	      	<input type="file" name="myFile" id="myFile">
	      	<button type="submit">submit</button>
        </form>
    </div>
@endsection
@section('body.js')
<script type="text/javaScript" src="{{asset('app/UpFileController.js')}}"></script>
@endsection