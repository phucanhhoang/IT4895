<!-- header in clude banner -->
<!--banner -->
<div class="container">
	<div id="header">
		<div id="header-logo" class="col-md-3 col-sm-3 logo hidden-xs">
			<a href="{{Asset('')}}">
				<img src="img/logo.jpg" alt="Logo Website" style="max-width: 100%; max-height: 100%" />
			</a>
		</div>
		<div id="header-logo" class="col-md-12 col-sm-12 logo visible-xs">
			<a href="{{Asset('')}}">
				<img src="img/logo.jpg" alt="Logo Website" style="max-width: 100%; max-height: 100%" />
			</a>
		</div>

		<div id="header-right" class="col-md-9 col-sm-9 hidden-xs">
			@if(Auth::check())
				@if(Auth::user()->userable_type == 'customer')
					<ul class="hello-user navbar-right">
					<li>
					<a href="#">
						Xin chào, <b>{{App\Customer::find(Auth::user()->userable_id)->name}}</b>
					</a>
					</li>
					<li class="divider">
					<i class="fa fa-shopping-cart"></i>
					<a href="#">Giỏ hàng</a>
					</li>
						<li class="divider">
							<a href="{{asset('auth/logout')}}">Đăng xuất</a>
						</li>
					</ul>
				@else
					<ul class="hello-user navbar-right">
					<li>
					<a href="#">
						Xin chào, <b>{{Auth::user()->username}}</b>
					</a>
					</li>
					<li class="divider">
					<a href="#">Trang quản trị</a>
					</li>
						<li class="divider">
							<a href="{{asset('auth/logout')}}">Đăng xuất</a>
						</li>
					</ul>
				@endif
			@else
			<ul class="hello-user navbar-right">
				<li>
					<a href="{{Asset('auth/login')}}">Đăng nhập</a>
				</li>
				<li class="divider">
					<a href="{{Asset('auth/register')}}">Đăng ký</a>
				</li>
				<li class="divider">
					<i class="fa fa-shopping-cart"></i>
					<a href="#">Giỏ hàng</a>
				</li>
			</ul>
			@endif
		</div>
	</div>
</div>
<!--end of banner