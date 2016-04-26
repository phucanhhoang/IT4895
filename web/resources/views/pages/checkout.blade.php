{{-- Trang thanh toán đơn hàng --}}
@extends('layout.layout')
@section('title')
BookStore - Check out
@stop

@section('content')
<nav class="breadcrumbs">
    <a href="{{asset('/')}}">Trang chủ</a>
    <span class="divider">›</span>
    Thanh toán đơn hàng
</nav>
<div class="wraper col-md-12 col-sm-12">
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form method="post" action="{{asset('checkout')}}">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}"/>
        <div class="col-md-7 col-sm-7" style="border-right: 1px solid #e7e7e7; padding: 0 30px 0 0">
            <div class="box-item-title">Thông tin người nhận</div>
            @if(isset($data['customer']))
            <div class="form-group">
                <label for="txtNguoiNhan">Người nhận</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Họ tên"
                       value="{{$data['customer']->name}}"/>
            </div>
            <div class="form-group">
                <label for="txtDiaChi">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ nhận hàng"
                       value="{{$data['customer']->address}}"/>
            </div>
            <div class="form-group">
                <label for="txtSDT">Số điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại người nhận"
                       value="{{$data['customer']->phone}}"/>
            </div>
            @else
            <div class="form-group">
                <label for="txtNguoiNhan">Người nhận</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Họ tên"/>
            </div>
            <div class="form-group">
                <label for="txtDiaChi">Địa chỉ</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ nhận hàng"/>
            </div>
            <div class="form-group">
                <label for="txtSDT">Số điện thoại</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại người nhận"/>
            </div>
            @endif
            <div class="form-group">
                <label for="taGhiChu">Ghi chú</label>
                <textarea class="form-control" id="note" name="note"></textarea>
            </div>
        </div>
        <div class="col-md-5 col-sm-5" style="padding: 0 0 0 30px">
            <div class="box-item-title">Thời gian</div>
            <!-- Date and time range -->
            <div class="form-group">
                <label>Khoảng thời gian nhận hàng</label>
                <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-clock-o"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="reservationtime" name="ship_time"/>
                </div>
                <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <div class="box-item-title">Đơn hàng</div>
            <table id='order_table' class="table table-hover">
                <thead>
                <tr>
                    <th width="38%">Mặt hàng</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                </tr>
                </thead>
                <tbody>
                <?php $total_price = 0; ?>
                @foreach($data['cart'] as $cart)
                <?php $total_price += $cart->price * $cart->quantity; ?>
                <tr>
                    <td title="{{$cart->title}}">{{$cart->title}}</td>
                    <td style="text-align: center">{{$cart->quantity}}</td>
                    <td>{{number_format($cart->price, 0, ',', '.')}}</td>
                    <td>{{number_format($cart->price * $cart->quantity, 0, ',', '.')}}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="2"></td>
                    <td style="font-weight: bold;">Tổng tiền</td>
                    <td>{{number_format($total_price, 0, ',', '.')}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-12 col-sm-12" style="text-align: center; margin-top: 30px">
            <input type="submit" class="btn bg-olive btn-flat btn-sm" value="THANH TOÁN"/>
        </div>
    </form>
</div>
@stop

@section('javascript')
<script>
    $('#reservationtime').daterangepicker({
        timePicker: true,
        timePicker12Hour: false,
        timePickerIncrement: 30,
        format: 'DD/MM/YYYY h:mm A'
    });
</script>
@stop