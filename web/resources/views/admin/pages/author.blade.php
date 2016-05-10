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
            <table id="author_table" class="table table-bordered table-hover table-click">
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

    <div id="author_dialog" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 id="dialog_title" class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form id="author_form" method="post" action="">
                        <input type="hidden" id="author_id" name="author_id"/>
                        <div class="form-group" style="width: 60%;float: left;margin-right: 28px;">
                            <label for="name">Tên tác giả</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Tên thể loại"
                                   required/>
                        </div>
                        <div class="form-group" style="width: 35%;display: inline-block;float: left;">
                            <label for="country">Quốc tịch</label>
                            <select id="country" name="country" class="form-control" style="width: 100%" required>
                                <option value=""></option>
                                @foreach(App\Enum\CountryArray::COUNTRY as $country)
                                <option value="{{$country}}">{{$country}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="profile">Sơ lược tiểu sử</label>
                            <textarea class="form-control" id="profile" name="profile" required></textarea>
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
            $("#author_table > tbody .icheckbox_square-blue").iCheck('check');
        }
        else {
            $("#author_table > tbody .icheckbox_square-blue").iCheck('uncheck');
        }
    });

    function resetAuthorForm() {
        resetForm('author_form');
    }

    function openAuthorDialog() {
        $("#author_dialog").modal('show');
    }
    function closeAuthorDialog() {
        $("#author_dialog").modal('hide');
    }
    function editAuthor(tr) {
        resetAuthorForm();
        $("#dialog_title").html("Sửa tác giả");
        var author_id = $(tr).attr('id');
        $.ajax({
            type: 'POST',
            url: "{{asset('adpage/author/info')}}",
            cache: false,
            data: {id: author_id},
            success: function (data) {
                $("#author_form #author_id").val(data['id']);
                $("#author_form #name").val(data['name']);
                $("#author_form #country").val(data['country']);
                $("#author_form #profile").val(data['profile']);
            }
        });
        openAuthorDialog();
    }
    function addAuthor() {
        resetAuthorForm();
        $("#dialog_title").html("Thêm tác giả");
        openAuthorDialog();
    }

    function delAuthor() {
        var arrAuthor_ID = [];
        $("#author_table > tbody .icheckbox_square-blue").each(function () {
            if ($(this).attr("aria-checked") == "true") {
                arrAuthor_ID.push($(this).children().attr('id'));
            }
        });
        $('#ajaxAlert').attr('class', 'alert');
        $('#ajaxAlert').hide();
        var jsonString = JSON.stringify(arrAuthor_ID);
        $.ajax({
            type: 'POST',
            url: "{{asset('adpage/author/delAuthor')}}",
            cache: false,
            data: {authorIds: jsonString},
            success: function (msg) {
                if (msg === 'true') {
                    $("#author_table > tbody .icheckbox_square-blue").each(function () {
                        if ($(this).attr("aria-checked") == "true") {
                            $(this).parents('tr').fadeOut(function () {
                                $(this).remove();
                            });
                        }
                    });
                    $('#ajaxAlert').attr('class', 'alert alert-success alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-check');
                    $('#alert-content').html("Xóa tác giả thành công!");
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
        var $form = $('#author_form');

        if (!$form.valid()) return false;
        saveAuthor();
    });

    function saveAuthor() {
        $('#ajaxAlert').hide();
        var data = $("#author_form").serialize();
        $.ajax({
            type: 'POST',
            url: "{{asset('adpage/author/saveAuthor')}}",
            cache: false,
            data: data,
            success: function (data) {
                if (data == 'EDIT_SUCCEED') {
                    $("#author_table > tbody > tr#" + $("#author_form #author_id").val() + ">td:nth-child(3)").html($("#author_form #name").val());
                    $("#author_table > tbody > tr#" + $("#author_form #author_id").val() + ">td:nth-child(4)").html($("#author_form #country").val());
                    $("#author_table > tbody > tr#" + $("#author_form #author_id").val() + ">td:nth-child(5)").html($("#author_form #profile").val());
                    closeAuthorDialog();
                    $('#ajaxAlert').attr('class', 'alert alert-success alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-check');
                    $('#alert-content').html("Sửa tác giả thành công!");
                    $('#ajaxAlert').show();
                }
                else if (data['msg'] == "ADD_SUCCEED") {
                    $("#author_table > tbody").append("<tr id='" + data['author_id'] + "' onclick='editAuthor(this);'>" +
                        "<td><div class='checkbox icheck' style='margin-top: 0'>" +
                        "<label><input id='" + data['author_id'] + "' type='checkbox' /></label> </div></td>" +
                        "<td style='text-align: center'>{{$stt+1}}</td><td>" + $("#author_form #name").val() + "</td>" +
                        "<td>" + $("#author_form #country").val() + "</td><td>" + $("#author_form #profile").val() + "</td></tr>");
                    setCheckboxStyle();
                    closeAuthorDialog();
                    $('#ajaxAlert').attr('class', 'alert alert-success alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-success');
                    $('#alert-content').html("Thêm tác giả thành công!");
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