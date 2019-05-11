<!DOCTYPE html>
<html lang="vi" ng-app="my-app">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>QT THCS</title>

  <!-- Custom fonts for this template-->
  <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->

  <!-- Custom styles for this template-->
  <link href="{{asset('css/sb-admin-2.css')}}" rel="stylesheet">
  {{-- <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> --}}
@yield('head.css')
@yield('head.js')
</head>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    
@include("layouts.sidebar")


    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
@include("layouts.header")
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">@yield('body.title')</h1>
          </div>
          <!-- Content Row -->
          <div class="row" style="color: #555">
            @if(session('message'))
              <div class="col-md-10 offset-1 text-center alert alert-@if(error==true)'danger'@else 'success' @endif">
                <strong>{{ session('message') }}</strong>
              </div>
            @endif

            @yield('body.content')
          </div>
        </div>
        <!-- /.container-fluid -->
      <!-- End of Main Content -->
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019-<?php echo date("Y");?></span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Bootstrap core JavaScript-->
  <script type="text/javaScript" src="{{asset('js/jquery.min.js')}}"></script>
  <script type="text/javaScript" src="{{asset('js/bootstrap.min.js')}}"></script>
  <!-- Custom scripts for all pages-->
  <script type="text/javaScript" src="{{asset('js/sb-admin-2.min.js')}}"></script>

  <!--AngularJS-->
  <script type="text/javaScript" src="{{asset('app/lib/angular.min.js')}}"></script>
  <script type="text/javaScript" src="{{asset('app/app.js')}}"></script>
  
  <!-- Page level custom scripts -->

@yield('body.js')
</body>
</html>
