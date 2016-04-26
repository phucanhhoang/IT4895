<!-- header in clude banner -->
<!--banner -->
<div class="container header-mobile visible-xs">
	<div id="header-logo-mobile" class="col-md-12 col-sm-12 logo">
		<a href="{{Asset('')}}">
			<img src="{{asset('img/logo.jpg')}}" alt="Logo Website" style="max-width: 100%; max-height: 100%"/>
		</a>
	</div>
</div>
<div class="container header hidden-xs">
	<div id="header-logo" class="col-md-3 col-sm-3 logo hidden-xs">
		<a href="{{Asset('')}}">
			<img src="{{asset('img/logo.jpg')}}" alt="Logo Website" style="max-width: 100%; max-height: 100%"/>
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
				<a href="#" onclick="open_cart_dialog();" data-toggle="modal" data-target="#cart-dialog"><i
						class="fa fa-shopping-cart"></i> Giỏ hàng</a>
			</li>
			<li class="divider">
				<a href="{{asset('checkout')}}">Thanh toán</a>
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
				<a href="{{asset('adpage')}}">Trang quản trị</a>
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
				<a href="#" onclick="open_cart_dialog();" data-toggle="modal" data-target="#cart-dialog"><i
						class="fa fa-shopping-cart"></i> Giỏ hàng</a>
			</li>
			<li class="divider">
				<a href="{{asset('checkout')}}">Thanh toán</a>
			</li>
		</ul>
		@endif

		<!-- search form -->
		<div class="form-group input-group pull-right" style="margin-top: 32px">
			<input type="text" class="form-control"
				   style="float: right;width: 60%;height: 40px;border: 2px solid #3d9970;font-size: 1.2em;"
				   placeholder="Bạn muốn tìm sách gì? (Nhập tên sách, tác giả, thể loại, ...)">
			<span class="input-group-btn">
				<button class="btn btn-search btn-flat" type="button"
						style="height: 40px;background-color: #3d9970;color: #fff;">Tìm kiếm
				</button>
			</span>
		</div>
		<!-- /.search form -->
	</div>
</div>

{{-- /.Modal Cart --}}
<div class="modal fade in" id="cart-dialog">
	<div class="modal-dialog" style='margin-top: 100px'>
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Giỏ hàng</h4>
			</div>
			<div class="modal-body">
				<table id='cart-table' class="table table-hover">
					<thead>
					<tr>
						<th>STT</th>
						<th>Mặt hàng</th>
						<th>Số lượng</th>
						<th>Giá</th>
						<th>Thành tiền</th>
					</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-flat btn-sm pull-left" data-dismiss="modal"><i
						class="icon fa fa-arrow-left"></i> Tiếp tục mua
				</button>
				<button type="button" class="btn btn-primary btn-flat btn-sm">THANH TOÁN <i
						class="icon fa fa-arrow-right"></i></button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--end of banner -->

<script>
	function open_cart_dialog() {
		$('#cart-table > tbody').html('');
		var token = $('#_token').val();
		$.ajax({
			type: 'POST',
			url: "{{asset('cart/get-cart')}}",
			cache: false,
			data: {_token: token},
			success: function (data) {
				// console.log(data['cart']);
				var stt = 1;
				var totalMoney = 0;
				for (var i = 0; i < data['cart'].length; i++) {
					var title = data['cart'][i].title;
					var quantity = data['cart'][i].quantity;
					var price = accounting.formatNumber(data['cart'][i].price, 0, ".", ",")
					var money = data['cart'][i].price * data['cart'][i].quantity;
					var format_money = accounting.formatNumber(money, 0, ".", ",");
					totalMoney += money;
					$('#cart-table > tbody').append("<tr><td>" + stt + "</td><td>" + title + "</td><td>" + quantity + "</td><td>" + price + "</td><td>" + format_money + "</td></tr>");
					stt++;
				}
				$('#cart-table > tbody').append("<tr><td colspan='3'></td><td style='text-align: right; font-weight: bold'>Tổng tiền</td><td>" + accounting.formatNumber(totalMoney, 0, ".", ",") + "</td></tr>");
			},
			error: function (msg) {

			}
		});
	}
</script>
