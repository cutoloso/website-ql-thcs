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
						<a class="dropdown-item" href="#">Giới thiệu chung</a>
						<a class="dropdown-item" href="#">Nội quy nhà trường</a>
					</div>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Tin tức</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="#">Thông báo</a>
						<a class="dropdown-item" href="#">Công khai</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">Thời khóa biểu</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="{{route('lien-he')}}">Liên hệ</a>
				</li>
			</ul>
		</div> 
	</div> 
</nav>