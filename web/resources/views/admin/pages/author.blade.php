<?php
/**
 * Created by IntelliJ IDEA.
 * User: Phuc Anh Hoang
 * Date: 4/18/2016
 * Time: 8:07 PM
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
        Tác giả
        <!--		<small>it all starts here</small>-->
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{asset('adpage')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">Tác giả</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">

    </div>

    <div class="box">
        <div class="box-header with-border">
            <button type="button" id="btnAdd" onclick="addAuthor();" class="btn btn-primary btn-flat btn-sm">Thêm
            </button>
            <button type="button" id="btnDel" onclick="delAuthor();" class="btn btn-default btn-flat btn-sm">Xóa
            </button>
            <div class="input-group pull-right" style="width: 25%">
                <input type="text" class="form-control" placeholder="Nhập tên tác giả">
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
                    <th style="width: 20%">Tên tác giả</th>
                    <th style="width: 15%">Quốc tịch</th>
                    <th>Sơ lược tiểu sử</th>
                </tr>
                </thead>
                <?php
                $stt = 0;
                foreach ($authors as $author) {
                    $stt++;
                    ?>
                    <tr id="{{$author->id}}" onclick="editAuthor(this);">
                        <td>
                            <div class="checkbox icheck" style="margin-top: 0">
                                <label><input id="{{$author->id}}" type="checkbox"/>
                                </label>
                            </div>
                        </td>
                        <td style="text-align: center">{{$stt}}</td>
                        <td>{{$author->name}}</td>
                        <td>{{$author->country}}</td>
                        <td>{{$author->profile}}</td>
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