<?php
/**
 * Created by IntelliJ IDEA.
 * User: Phuc Anh Hoang
 * Date: 4/18/2016
 * Time: 8:08 PM
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
        Nhà xuất bản
        <!--		<small>it all starts here</small>-->
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{asset('adpage')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">Nhà xuất bản</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">

    </div>

    <div class="box">
        <div class="box-header with-border">
            <button type="button" id="btnAdd" onclick="addPublisher();" class="btn btn-primary btn-flat btn-sm">Thêm
            </button>
            <button type="button" id="btnDel" onclick="delPublisher();" class="btn btn-default btn-flat btn-sm">Xóa
            </button>
            <div class="input-group pull-right" style="width: 25%">
                <input type="text" class="form-control" placeholder="Nhập tên nhà xuất bản">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
                </div><!-- /btn-group -->
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table class="table table-bordered table-hover table-click">
                <thead>
                <tr>
                    <th style="width: 10px">
                        <div class="checkbox icheck" style="margin-top: 0; margin-bottom: 0">
                            <label><input id="chkAll" type="checkbox"/>
                            </label>
                        </div>
                    </th>
                    <th style="width: 10px; text-align: center">#</th>
                    <th style="width: 30%">Tên nhà xuất bản</th>
                    <th>Địa chỉ</th>
                    <th style="width: 15%">Quốc gia</th>
                </tr>
                </thead>
                <?php
                $stt = 0;
                foreach ($publishers as $publisher) {
                    $stt++;
                    ?>
                    <tr id="{{$publisher->id}}" onclick="editPublisher(this);">
                        <td>
                            <div class="checkbox icheck" style="margin-top: 0">
                                <label><input id="{{$publisher->id}}" type="checkbox"/>
                                </label>
                            </div>
                        </td>
                        <td style="text-align: center">{{$stt}}</td>
                        <td>{{$publisher->name}}</td>
                        <td>{{$publisher->address}}</td>
                        <td>{{$publisher->country}}</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div>

</section><!-- /.content -->

@stop

@section('style')

@stop

@section('javascript')
@stop