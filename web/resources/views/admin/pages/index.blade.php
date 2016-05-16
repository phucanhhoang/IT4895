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
                <a href="#" onclick="openBookSaleDialog();" class="small-box-footer">
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
                <a href="#" onclick="openBookSallingDialog();" class="small-box-footer">
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
                <a href="#" class="small-box-footer">
                    Chi tiết <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
    </div>

    <!-- book sale dialog -->
    <div id="booksale_dialog" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 id="dialog_title" class="modal-title">Danh sách sách đang giảm giá</h4>
                </div>
                <div class="modal-body">
                    <table id="booksale_table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th style="width: 10%">Ảnh bìa</th>
                            <th style="width: 32%">Tên sách</th>
                            <th style="width: 12%">Thể loại</th>
                            <th style="width: 15%">Tác giả</th>
                            <th style="width: 10%">Giá (vnđ)</th>
                            <th style="">Sale (%)</th>
                            <th style="">Số lượng</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $stt = 0;
                        foreach ($data['books_sale'] as $book_sale) {
                            $stt++;
                            ?>
                            <tr>
                                <td>{{$stt}}</td>
                                <td><img src="{{asset($book_sale->image)}}" style="max-width: 100%; max-height: 100%"/>
                                </td>
                                <td>{{$book_sale->title}}</td>
                                <td>{{$book_sale->genre_name}}</td>
                                <td>{{$book_sale->author_name}}</td>
                                <td>{{number_format($book_sale->price, 0, ',', '.')}}</td>
                                <td>{{$book_sale->sale}}</td>
                                <td>{{$book_sale->quantity}}</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!--    Top salling-->
    <div id="booksalling_dialog" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 id="dialog_title" class="modal-title">Danh sách sách bán chạy</h4>
                </div>
                <div class="modal-body">
                    <table id="booksalling_table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th style="width: 10%">Ảnh bìa</th>
                            <th style="width: 30%">Tên sách</th>
                            <th style="width: 12%">Thể loại</th>
                            <th style="width: 15%">Tác giả</th>
                            <th style="width: 10%">Giá (vnđ)</th>
                            <th style="">Sale (%)</th>
                            <th style="">Đã bán</th>
                            <th style="">Kho</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $stt = 0;
                        foreach ($data['books_selling'] as $book_selling) {
                            $stt++;
                            ?>
                            <tr>
                                <td>{{$stt}}</td>
                                <td><img src="{{asset($book_selling->image)}}"
                                         style="max-width: 100%; max-height: 100%"/></td>
                                <td>{{$book_selling->title}}</td>
                                <td>{{$book_selling->genre_name}}</td>
                                <td>{{$book_selling->author_name}}</td>
                                <td>{{number_format($book_selling->price, 0, ',', '.')}}</td>
                                <td>{{$book_selling->sale}}</td>
                                <td>{{$book_selling->sum_quantity}}</td>
                                <td>{{$book_selling->quantity}}</td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</section><!-- /.content -->

@stop

@section('style')

@stop

@section('javascript')
<script>
    function openBookSaleDialog() {
        $("#booksale_dialog").modal('show');
    }
    function openBookSallingDialog() {
        $("#booksalling_dialog").modal('show');
    }
</script>

@stop