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
        Thể loại sách
        <!--		<small>it all starts here</small>-->
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{asset('adpage')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">Thể loại sách</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">

    </div>

    <div class="box">
        <div class="box-header with-border">
            <button type="button" id="btnAdd" onclick="addGenre();" class="btn btn-primary btn-flat btn-sm">Thêm
            </button>
            <button type="button" id="btnDel" onclick="delGenre();" class="btn btn-default btn-flat btn-sm">Xóa</button>
            <div class="input-group pull-right" style="width: 25%">
                <input type="text" class="form-control" placeholder="Nhập tên thể loại">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
                </div><!-- /btn-group -->
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="genre_table" class="table table-bordered table-hover table-click">
                <thead>
                <tr>
                    <th style="width: 10px">
                        <div class="checkbox icheck" style="margin-top: 0; margin-bottom: 0">
                            <label><input id="chkAll" type="checkbox"/>
                            </label>
                        </div>
                    </th>
                    <th style="width: 10px; text-align: center">#</th>
                    <th style="width: 20%">Thể loại sách</th>
                    <th>Mô tả</th>
                </tr>
                </thead>
                <?php
                $stt = 0;
                foreach ($genres as $genre) {
                    $stt++;
                    ?>
                    <tr id="{{$genre->id}}" onclick="editGenre(this);">
                        <td>
                            <div class="checkbox icheck" style="margin-top: 0">
                                <label><input id="{{$genre->id}}" type="checkbox"/>
                                </label>
                            </div>
                        </td>
                        <td style="text-align: center">{{$stt}}</td>
                        <td>{{$genre->name}}</td>
                        <td>{{$genre->description}}</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div>

    <div id="genre_dialog" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 id="dialog_title" class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form id="genre_form" method="post" action="">
                        <input type="hidden" id="genre_id" name="genre_id"/>
                        <div class="form-group">
                            <label for="name">Tên thể loại</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Tên thể loại"
                                   required/>
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Đóng</button>
                    <button type="button" id="btnSave" class="btn btn-primary btn-flat">Lưu</button>
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
    $("#chkAll").on("ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed", function (e) {
        if (e.type == "ifChecked") {
            $("#genre_table > tbody .icheckbox_square-blue").iCheck('check');
        }
        else {
            $("#genre_table > tbody .icheckbox_square-blue").iCheck('uncheck');
        }
    });

    function resetGenreForm() {
        resetForm('genre_form');
    }

    function openGenreDialog() {
        $("#genre_dialog").modal('show');
    }
    function closeGenreDialog() {
        $("#genre_dialog").modal('hide');
    }
    function editGenre(tr) {
        resetGenreForm();
        $("#dialog_title").html("Sửa thể loại sách");
        var genre_id = $(tr).attr('id');
        $.ajax({
            type: 'POST',
            url: "{{asset('adpage/genre/info')}}",
            cache: false,
            data: {id: genre_id},
            success: function (data) {
                $("#genre_form #genre_id").val(data['id']);
                $("#genre_form #name").val(data['name']);
                $("#genre_form #description").val(data['description']);
            }
        });
        openGenreDialog();
    }
    function addGenre() {
        resetGenreForm();
        $("#dialog_title").html("Thêm thể loại sách");
        openGenreDialog();
    }

    function delGenre() {
        var arrGenre_ID = [];
        $("#genre_table > tbody .icheckbox_square-blue").each(function () {
            if ($(this).attr("aria-checked") == "true") {
                arrGenre_ID.push($(this).children().attr('id'));
            }
        });
        $('#ajaxAlert').attr('class', 'alert');
        $('#ajaxAlert').hide();
        var jsonString = JSON.stringify(arrGenre_ID);
        $.ajax({
            type: 'POST',
            url: "{{asset('adpage/genre/delGenre')}}",
            cache: false,
            data: {genreIds: jsonString},
            success: function (msg) {
                if (msg === 'true') {
                    $("#genre_table > tbody .icheckbox_square-blue").each(function () {
                        if ($(this).attr("aria-checked") == "true") {
                            $(this).parents('tr').fadeOut(function () {
                                $(this).remove();
                            });
                        }
                    });
                    $('#ajaxAlert').attr('class', 'alert alert-success alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-check');
                    $('#alert-content').html("Xóa thể loại sách thành công!");
                    $('#ajaxAlert').show();
                }
                else {
                    $('#ajaxAlert').attr('class', 'alert alert-danger alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-ban');
                    $('#alert-content').html(msg);
                    $('#ajaxAlert').show();
                }
            }
        });
    }

    $('#btnSave').click(function (e) {
        e.preventDefault();
        var $form = $('#genre_form');

        if (!$form.valid()) return false;
        saveGenre();
    });

    function saveGenre() {
        $('#ajaxAlert').hide();
        var data = $("#genre_form").serialize();
        $.ajax({
            type: 'POST',
            url: "{{asset('adpage/genre/saveGenre')}}",
            cache: false,
            data: data,
            success: function (data) {
                if (data == 'EDIT_SUCCEED') {
                    $("#genre_table > tbody > tr#" + $("#genre_form #genre_id").val() + ">td:nth-child(3)").html($("#genre_form #name").val());
                    $("#genre_table > tbody > tr#" + $("#genre_form #genre_id").val() + ">td:nth-child(4)").html($("#genre_form #description").val());
                    closeGenreDialog();
                    $('#ajaxAlert').attr('class', 'alert alert-success alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-check');
                    $('#alert-content').html("Sửa thể loại sách thành công!");
                    $('#ajaxAlert').show();
                }
                else if (data['msg'] == "ADD_SUCCEED") {
                    $("#genre_table > tbody").append("<tr id='" + data['genre_id'] + "' onclick='editGenre(this);'>" +
                        "<td><div class='checkbox icheck' style='margin-top: 0'>" +
                        "<label><input id='" + data['genre_id'] + "' type='checkbox' /></label> </div></td>" +
                        "<td style='text-align: center'>{{$stt+1}}</td><td>" + $("#genre_form #name").val() + "</td>" +
                        "<td>" + $("#genre_form #description").val() + "</td></tr>");
                    setCheckboxStyle();
                    closeGenreDialog();
                    $('#ajaxAlert').attr('class', 'alert alert-success alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-success');
                    $('#alert-content').html("Thêm thể loại sách thành công!");
                    $('#ajaxAlert').show();
                }
                else {
                    $('#ajaxAlert').attr('class', 'alert alert-danger alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-ban');
                    $('#alert-content').html(data);
                    $('#ajaxAlert').show();
                }
            }
        });
    }
</script>
@stop