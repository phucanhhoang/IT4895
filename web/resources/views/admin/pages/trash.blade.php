<?php
/**
 * Created by IntelliJ IDEA.
 * User: Phuc Anh Hoang
 * Date: 4/24/2016
 * Time: 10:26 AM
 */
?>
@extends('admin.layout')
@section('title')
BookStore - Order Management Page
@stop

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Thùng rác
        <!--		<small>it all starts here</small>-->
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{asset('adpage')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">Quản lý đơn hàng</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">

    </div>

    <div class="box">
        <div class="box-header with-border">
            <button type="button" id="btnAdd" class="btn btn-primary btn-flat btn-sm">Khôi phục</button>
            <button type="button" id="btnDel" onclick="" class="btn btn-default btn-flat btn-sm">Xóa vĩnh viễn</button>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">
                        <div class="checkbox icheck" style="margin-top: 0; margin-bottom: 0">
                            <label><input id="chkAll" type="checkbox"/>
                            </label>
                        </div>
                    </th>
                    <th style="width: 10px">#</th>
                    <th style="width: 160px">Tên chức năng</th>
                    <th style="width: 100px">Nội dung</th>
                    <th>Thời gian xóa</th>
                    <th class="hidden-xs" style="width: 150px">Thời gian ship</th>
                    <th class="hidden-xs">Note</th>
                    <th style="width: 120px">Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                <tr>

                </tr>
                </tbody>
            </table>
        </div><!-- /.box-body -->
        <div class="box-footer clearfix">
            <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
            </ul>
        </div>
    </div>

</section><!-- /.content -->

@stop

@section('style')

@stop

@section('javascript')
@stop