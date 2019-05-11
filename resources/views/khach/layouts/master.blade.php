<!DOCTYPE html>
<html lang="vi"  ng-app="my-app">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta name="author" content="CongThanh">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Trang chủ THCS Chánh Nghĩa | @yield('head.title')</title>

	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
	<style>
		html , body{
			height: 100%;
			font-size: 15px;
		}
		#body-bg{
			background: #eeeff2;
		}
		/*wraper*/
		#wraper{
			font-size: 15px;
		}

		/*toolbar*/
		#toolbar{
			background: #000;
			opacity: 0.5;
			text-transform: uppercase;
			padding: 0.1rem 0;
		}
		#toolbar a{
			color: #afacaf;
		}

		/*header*/
		#header{
			background-image: linear-gradient(to right, rgb(14, 37, 78) , rgb(88, 151, 246)); 
		}
		.header_content{
			height: 200px;
		}
		.header_content_title{
			text-transform: uppercase;
		}

		/*nav*/
		#menu-main{
			color: white;
			font-weight: bold;
		}
		#menu-main .nav-link{
			color: white;
		}
		#menu-main .nav-item{
			padding-left: 20px;
		}
		#menu-main .dropdown-menu{
			left: 20px;
		}

		/*main*/
		#main{
			background: #fff;
			min-height: 400px;
		}
		#main_content{
			padding-top:20px;
		}
		/*footer*/
		#footer{
			margin-bottom:0;
			background-image: linear-gradient(to right, #274f93 , #4e88e0);
		}
		.footer_content{
			color: #fff;
			height: 9rem;
		}
	</style>
	@yield('head.css')
	@yield('head.js')
</head>
<body>

<div id="body-bg">
<!-- wrapper/start-->
	<div id="wraper">
		<div ng-controller="HomeController">

			<!-- toolbar/start -->
			<div id="toolbar">
					<div class="container">
						<div class="row">
							<div class="col-md-12 text-right">
								@if (Route::has('login'))
									@auth
											<a class="col-md-1" href="{{ url('/quan-tri') }}">Quản trị</a>
											<a class="col-md-1" href="{{ route('logout') }}"
											onclick="event.preventDefault();
											document.getElementById('logout-form').submit();">
											{{ __('Đăng xuất') }}
											</a>

											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												@csrf
											</form>
									@else
										<a href=""  data-toggle="modal" data-target="#modalLogIn">Đăng nhập</a>
									@endauth
								@endif
							</div>
						</div>
					</div>
			</div>
			<!-- toolbar/end -->
		</div>
		<!-- header/start -->
		<div id="header">
			<div class="container">
				<div class="header_content row text-center align-items-center">
					<div class="header_content_logo logo col-md-3">
						<a class="" href="" title="Trường THCS Chánh Nghĩa">
							<img class="img-fluid" src="{{asset('img/logo.png')}}" alt="logo">
						</a>
					</div>
					<div class="header_content_title col-md-6">
						<h5 style="color: #fff">Phòng giáo dục và đào tạo tp. Thủ dầu một</h5>
						<h4 style="color:gold">Trường THCS Chánh Nghĩa</h4> 
					</div>
				</div>
			</div>
		</div>
		<!-- header/end -->

		<!-- nav/start -->
		<nav id="menu-main" class="navbar navbar-expand-sm bg-primary navbar-dark sticky-top">
			<div class="container">
				<a class="navbar-brand" href="{{route('trang-chu')}}"><i class="fas fa-home"></i> Trang chủ</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="collapsibleNavbar">
					<ul class="navbar-nav">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Giới thiệu</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="{{route('gioi-thieu-chung')}}">Giới thiệu chung</a>
								<a class="dropdown-item" href="#">Nội quy nhà trường</a>
							</div>
						</li>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Tin tức</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="{{route('khach.thongBaoTruong')}}">Thông báo</a>
								<a class="dropdown-item" href="#">Công khai</a>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{route('tkb')}}">Thời khóa biểu</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{route('ketquahoctap')}}">Tra cứu kết quả học tập</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="{{route('lien-he')}}">Liên hệ</a>
						</li>
					</ul>
				</div> 
			</div> 
		</nav>
		<!-- nav/end -->

		<!-- main-content/start -->
		<div id="main"  class="container">
			<div id="main_content" >
				@yield('body.content')
			</div>
		</div>
		<!-- main-content/end -->

		<!-- footer/start -->
		<footer id="footer" style="font-size: 0.8rem">
			<div class="container">
				<div class="footer_content row align-items-center">
					<div class="col-md-6">
						<p><strong>TRƯỜNG TRUNG HỌC CƠ SỞ CHÁNH NGHĨA</strong></p>
						<p>Địa chỉ: Đường Nguyễn Tri Phương, phường Chánh Nghĩa, TP TDM, tỉnh Bình Dương</p>
						<p>Điện thoại : (0274)3.826.721  E-mail: thcs-chanhnghia@tptdm.edu.vn</p>
					</div>
					<div class="col-md-6"></div>
				</div>
			</div>
		</footer>
		<!-- footer/end -->
	</div>
</div>
<!-- wrapper/end-->

{{-- modal --}}
<div class="modal fade" id="modalLogIn">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="container-fluid">
				<div class="row justify-content-center">
					<!-- Modal Header -->
					<div class="modal-header col-12 text-center">
						<h4 class="modal-title col-md-4 offset-4">Đăng nhập</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>
				</div>
				<div class="row justify-content-center">
					<form class="col-12" method="POST" action="{{ route('login') }}">
						@csrf
						<!-- Modal body -->
						<div class="modal-body col-12">
							<div class="form-group row">
								<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Tên đăng nhập ') }}</label>

								<div class="col-md-6">
									<input id="name" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

								</div>
							</div>

							<div class="form-group row">
								<label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mật khẩu ') }}</label>

								<div class="col-md-6">
									<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
								</div>
							</div>
						</div>
						<!-- Modal footer -->
						<div class="modal-footer col-12" >
							<div class="col-12 text-center" style="margin: 0">
								<div class="col-md-4 offset-4">
									<button type="submit" class="btn btn-primary" style="padding: 0.5rem 1.1rem">
										{{ __('Login') }}
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javaScript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javaScript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javaScript" src="{{asset('app/lib/angular.min.js')}}"></script>
<script type="text/javaScript" src="{{asset('app/app.js')}}"></script>
<script type="text/javaScript" src="{{asset('app/HomeController.js')}}"></script>

@yield('body.js')
</body>
</html>