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
            <table id="publisher_table" class="table table-bordered table-hover table-click">
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
                    <th style="width: 15%">Quốc gia</th>
                    <th>Giới thiệu ngắn</th>
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
                        <td>{{$publisher->country}}</td>
                        <td>{{$publisher->short_intro}}</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div>

    <div id="publisher_dialog" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 id="dialog_title" class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form id="publisher_form" method="post" action="">
                        <input type="hidden" id="publisher_id" name="publisher_id"/>
                        <div class="form-group" style="width: 60%;float: left;margin-right: 28px;">
                            <label for="name">Tên nhà xuất bản</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Tên thể loại"/>
                        </div>
                        <div class="form-group" style="width: 35%;display: inline-block;float: left;">
                            <label for="country">Quốc gia</label>
                            <select id="country" name="country" class="form-control" style="width: 100%">
                                <option value=""></option>
                                @foreach(App\Enum\CountryArray::COUNTRY as $country)
                                <option value="{{$country}}">{{$country}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="short_intro">Giới thiệu ngắn</label>
                            <textarea class="form-control" id="short_intro" name="short_intro"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Đóng</button>
                    <button type="button" onclick="savePublisher();" class="btn btn-primary btn-flat">Lưu</button>
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
            $("#publisher_table > tbody .icheckbox_square-blue").iCheck('check');
        }
        else {
            $("#publisher_table > tbody .icheckbox_square-blue").iCheck('uncheck');
        }
    });

    function resetPublisherForm() {
        resetForm('publisher_form');
    }

    function openPublisherDialog() {
        $("#publisher_dialog").modal('show');
    }
    function closePublisherDialog() {
        $("#publisher_dialog").modal('hide');
    }
    function editPublisher(tr) {
        resetPublisherForm();
        $("#dialog_title").html("Sửa nhà xuất bản");
        var publisher_id = $(tr).attr('id');
        $.ajax({
            type: 'POST',
            url: "{{asset('adpage/publisher/info')}}",
            cache: false,
            data: {id: publisher_id},
            success: function (data) {
                $("#publisher_form #publisher_id").val(data['id']);
                $("#publisher_form #name").val(data['name']);
                $("#publisher_form #country").val(data['country']);
                $("#publisher_form #short_intro").val(data['short_intro']);
            }
        });
        openPublisherDialog();
    }
    function addPublisher() {
        resetPublisherForm();
        $("#dialog_title").html("Thêm nhà xuất bản");
        openPublisherDialog();
    }

    function delPublisher() {
        var arrPublisher_ID = [];
        $("#publisher_table > tbody .icheckbox_square-blue").each(function () {
            if ($(this).attr("aria-checked") == "true") {
                arrPublisher_ID.push($(this).children().attr('id'));
            }
        });
        $('#ajaxAlert').attr('class', 'alert');
        $('#ajaxAlert').hide();
        var jsonString = JSON.stringify(arrPublisher_ID);
        $.ajax({
            type: 'POST',
            url: "{{asset('adpage/publisher/delPublisher')}}",
            cache: false,
            data: {publisherIds: jsonString},
            success: function (msg) {
                if (msg === 'true') {
                    $("#publisher_table > tbody .icheckbox_square-blue").each(function () {
                        if ($(this).attr("aria-checked") == "true") {
                            $(this).parents('tr').fadeOut(function () {
                                $(this).remove();
                            });
                        }
                    });
                    $('#ajaxAlert').attr('class', 'alert alert-success alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-check');
                    $('#alert-content').html("Xóa nhà xuất bản thành công!");
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

    function savePublisher() {
        $('#ajaxAlert').hide();
        var data = $("#publisher_form").serialize();
        $.ajax({
            type: 'POST',
            url: "{{asset('adpage/publisher/savePublisher')}}",
            cache: false,
            data: data,
            success: function (data) {
                if (data == 'EDIT_SUCCEED') {
                    $("#publisher_table > tbody > tr#" + $("#publisher_form #publisher_id").val() + ">td:nth-child(3)").html($("#publisher_form #name").val());
                    $("#publisher_table > tbody > tr#" + $("#publisher_form #publisher_id").val() + ">td:nth-child(4)").html($("#publisher_form #country").val());
                    $("#publisher_table > tbody > tr#" + $("#publisher_form #publisher_id").val() + ">td:nth-child(5)").html($("#publisher_form #short_intro").val());
                    closePublisherDialog();
                    $('#ajaxAlert').attr('class', 'alert alert-success alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-check');
                    $('#alert-content').html("Sửa nhà xuất bản thành công!");
                    $('#ajaxAlert').show();
                }
                else if (data['msg'] == "ADD_SUCCEED") {
                    $("#publisher_table > tbody").append("<tr id='" + data['publisher_id'] + "' onclick='editPublisher(this);'>" +
                        "<td><div class='checkbox icheck' style='margin-top: 0'>" +
                        "<label><input id='" + data['publisher_id'] + "' type='checkbox' /></label> </div></td>" +
                        "<td style='text-align: center'>{{$stt+1}}</td><td>" + $("#publisher_form #name").val() + "</td>" +
                        "<td>" + $("#publisher_form #country").val() + "</td><td>" + $("#publisher_form #short_intro").val() + "</td></tr>");
                    setCheckboxStyle();
                    closePublisherDialog();
                    $('#ajaxAlert').attr('class', 'alert alert-success alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-success');
                    $('#alert-content').html("Thêm nhà xuất bản thành công!");
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