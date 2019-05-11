@extends('layouts.master')
@section('head.css')
<style>
	#btn-sub{
		margin: 1.5rem 0;	
	}
</style>
@endsection
@section('body.title','Thời khóa biểu')
@section('body.content')
<div class="container">
@if(isset($error))
	<div class="row">
		<div class="col-md-12">
			@if($error==false)
				<div class="alert alert-success">
					<strong>{{$message}}</strong>
				</div>
			@elseif($error==true)
				<div class="alert alert-danger">
					<strong>{{$message}}</strong>
				</div>
			@endif
		</div>
	</div>
@endif
	<div class="row">
		<div class="col-md-8 offset-2">
			<form action="{{ route('import')}}" method="POST" enctype="multipart/form-data">
				@csrf
				<h5>Chọn file để cập nhật thời khóa biểu:</h5>
				<div class="custom-file form-group">
					<input type="file" class="form-group custom-file-input" id="customFile" name="fileTKB" accept=".csv, .xlsx">
					<label class="custom-file-label" for="customFile">Chọn file</label>
				</div>
				<div class="text-center">
					<button class="btn btn-success" id="btn-sub">Cập nhật</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('body.js')
<script>
	// Add the following code if you want the name of the file appear on select
	$(".custom-file-input").on("change", function() {
	  var fileName = $(this).val().split("\\").pop();
	  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
	});
</script>
@endsection