@extends('admin.layout')
@section('title')
BookStore - Admin pages
@stop

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Trang chủ
        <!--		<small>it all starts here</small>-->
    </h1>
    <!--	<ol class="breadcrumb">-->
    <!--		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>-->
    <!--		<li><a href="#">Examples</a></li>-->
    <!--		<li class="active">Blank page</li>-->
    <!--	</ol>-->
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{$countNewOrder}}</h3>
                    <p>Đơn hàng mới</p>
                </div>
                <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                </div>
                <a href="{{asset('adpage/order')}}" class="small-box-footer">
                    Chi tiết <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{$countNewCustomer}}</h3>
                    <p>Khách hàng mới</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{asset('adpage/customer')}}" class="small-box-footer">
                    Chi tiết <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$countSale}}</h3>
                    <p>Sản phẩm đang giảm giá</p>
                </div>
                <div class="icon">
                    <i class="fa fa-fw fa-dollar"></i>
                </div>
                <a href="{{asset('adpage/book')}}" class="small-box-footer">
                    Chi tiết <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
    </div>

    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>Top</h3>
                    <p>Sản phẩm bán chạy</p>
                </div>
                <div class="icon">
                    <i class="fa fa-fw fa-line-chart"></i>
                </div>
                <a href="{{asset('adpage/statistic')}}" class="small-box-footer">
                    Chi tiết <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-blue">
                <div class="inner">
                    <h3>Top</h3>
                    <p>Sản phẩm được quan tâm</p>
                </div>
                <div class="icon">
                    <i class="fa fa-fw fa-heart"></i>
                </div>
                <a href="{{asset('adpage/statistic')}}" class="small-box-footer">
                    Chi tiết <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
    </div>

</section><!-- /.content -->

@stop

@section('style')

@stop

@section('javascript')
@stop