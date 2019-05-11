@extends('layouts.master')
@section('head.css')
  <style>
    .feedback {
      border: 2px solid #dedede;
      background-color: #f1f1f1;
      border-radius: 5px;
      padding: 10px;
      margin: 10px 0;
      color: #444;
    }

    .darker {
      border-color: #ccc;
      background-color: #ddd;
    }

    .feedback::after {
      content: "";
      clear: both;
      display: table;
    }

    .feedback img {
      float: left;
      max-width: 60px;
      width: 100%;
      margin-right: 20px;
      border-radius: 50%;
    }

    .feedback img.right {
      float: right;
      margin-left: 20px;
      margin-right:0;
    }

    .time-right {
      float: right;
      color: #aaa;
    }

    .time-left {
      float: left;
      color: #999;
    }
    .comment{
      margin:20px auto;
      width: 100%;
      position: relative;
    }
    #txt-comment{
      width: 100%;

    }
    #btn-comment{
      position: absolute;
      right: 18px;
      bottom: 10px;
    }


  </style>
@endsection
@section('body.title')
<div ng-controller="GopYController">
  Chủ đề: <% chuDe %>
</div>
@endsection
@section('body.content')
  <div class="col-10 offset-1" ng-controller="GopYController" ng-init="cd_ma='{{Auth::user()}}'">
    {{-- giáo viên - hoc sinh --}}
      <div ng-if="compare(loai_gy,'gvhs')" ng-repeat="gy in ds_gy">
        <div class="container feedback darker" ng-if="compare(gy.gy_nguoiGY,'{{Auth::user()->name}}')">
              <img src="{{asset('img/user-profile.png')}}" alt="Avatar" class="img-fluid right">
              <p><% gy.gy_gvhs_noiDung %></p>
              <span class="time-left">
                <% gy.gy_nguoiGY %>: <% gy.gy_gvhs_tGian %>
              </span>
        </div>
        <div class="container feedback " ng-if="! compare(gy.gy_nguoiGY,'{{Auth::user()->name}}')">
              <img src="{{asset('img/user-profile.png')}}" alt="Avatar">
              <p><% gy.gy_gvhs_noiDung %></p>
              <span class="time-right">
                <% gy.gy_nguoiGY %>: <% gy.gy_gvhs_tGian %>
              </span>
        </div>
      </div>
    {{-- giáo viên - phụ huynh --}}
      <div ng-if="compare(loai_gy,'gvph')" ng-repeat="gy in ds_gy">
        <div class="container feedback darker" ng-if="compare(gy.gy_nguoiGY,'{{Auth::user()->name}}')">
              <img src="{{asset('img/user-profile.png')}}" alt="Avatar" class="img-fluid right">
              <p><% gy.gy_gvph_noiDung %></p>
              <span class="time-left">
                <% gy.gy_nguoiGY %>: <% gy.gy_gvph_tGian %>
              </span>
        </div>
        <div class="container feedback " ng-if="! compare(gy.gy_nguoiGY,'{{Auth::user()->name}}')">
              <img src="{{asset('img/user-profile.png')}}" alt="Avatar" class="img-fluid">
              <p><% gy.gy_gvph_noiDung %></p>
              <span class="time-right">
                <% gy.gy_nguoiGY %>: <% gy.gy_gvph_tGian %>
              </span>
        </div>
      </div>


    <div class="comment">
      <form class="frmGopY" action="#" method="post" >
        <div class="form-group">
          <label for="cm_ma">Góp ý:</label>
          <textarea cheditor="formData.cheditorOptions" name="noiDung" id="txt-comment" cols="30" rows="4" placeholder=" Viết góp ý của bạn..." ng-model="gy.gy_noiDung" ng-required="true"></textarea>
          <span class="text-danger" ng-show="frmGopY.noiDung.$error.required">Bạn chưa nhập nội dung</span>
          <button  type="button" class="btn btn-success" id="btn-comment" ng-disabled="frmGopY.$invalid" ng-click="submit('{{Auth::user()->name}}')" > Gửi </button>
        </div>
      </form>
    </div>
  </div>

@endsection
@section('body.js')
  <script type="text/javaScript" src="{{asset('app/GopYController.js')}}"></script>
@endsection