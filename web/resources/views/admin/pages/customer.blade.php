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
BookStore - Customer Management Page
@stop

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Quản lý khách hàng
        <!--		<small>it all starts here</small>-->
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{asset('adpage')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">Quản lý khách hàng</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">

    </div>

    <div class="box">
        <div class="box-header with-border">
            <button type="button" id="btnAdd" onclick="addCustomer();" class="btn btn-primary btn-flat btn-sm">Thêm
            </button>
            <button type="button" id="btnDel" onclick="delCustomer();" class="btn btn-default btn-flat btn-sm">Xóa
            </button>
            <div class="input-group pull-right" style="width: 25%">
                <input type="text" class="form-control" placeholder="Nhập tên, account hoặc số điện thoại khách hàng">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
                </div><!-- /btn-group -->
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="customer_table" class="table table-bordered table-hover table-click">
                <thead>
                <tr>
                    <th style="width: 10px">
                        <div class="checkbox icheck" style="margin-top: 0; margin-bottom: 0">
                            <label><input id="chkAll" type="checkbox"/>
                            </label>
                        </div>
                    </th>
                    <th style="width: 10px; text-align: center">#</th>
                    <th style="width: 10%">Account</th>
                    <th style="width: 16%">Họ tên</th>
                    <th style="width: 10%">Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th style="width: 20%">Email</th>
                    <th style="width: 90px">Trạng thái</th>
                </tr>
                </thead>
                <?php
                $stt = 0;
                foreach ($customers as $customer) {
                    $stt++;
                    ?>
                    <tr id="{{$customer->id}}" onclick="editCustomer(this);">
                        <td>
                            <div class="checkbox icheck" style="margin-top: 0">
                                <label><input id="{{$customer->id}}" type="checkbox"/>
                                </label>
                            </div>
                        </td>
                        <td style="text-align: center">{{$stt}}</td>
                        <td>{{$customer->username}}</td>
                        <td>{{$customer->name}}</td>
                        <td>{{$customer->phone}}</td>
                        <td>{{$customer->address}}</td>
                        <td>{{$customer->email}}</td>
                        <td>{{$customer->banned == 1 ? "Bị khóa" : ""}}</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div>

    <div id="customer_dialog" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 id="dialog_title" class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form id="customer_form" method="post" action="">
                        <input type="hidden" id="customer_id" name="customer_id"/>
                        <div class="form-group" id="div_username" style="display: none">
                            <label for="username">Account</label>
                            <input type="text" class="form-control" id="username" name="username" readonly/>
                        </div>
                        <div class="form-group">
                            <label for="description">Họ tên</label>
                            <input type="text" class="form-control" id="name" name="name" required/>
                        </div>
                        <div class="form-group">
                            <label for="phone">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone" required/>
                        </div>
                        <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address" required/>
                        </div>
                        <div class="form-group" id="div_email">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" required/>
                        </div>
                        <div id="div_banned" style="display: none">
                            <div class="checkbox icheck" style="margin-top: 0">
                                <label><input id="banned" name="banned" type="checkbox"/> Khóa tài khoản
                                </label>
                            </div>
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
            $("#customer_table > tbody .icheckbox_square-blue").iCheck('check');
        }
        else {
            $("#customer_table > tbody .icheckbox_square-blue").iCheck('uncheck');
        }
    });

    function resetCustomerForm() {
        resetForm('customer_form');
    }

    function openCustomerDialog() {
        $("#customer_dialog").modal('show');
    }
    function closeCustomerDialog() {
        $("#customer_dialog").modal('hide');
    }
    function editCustomer(tr) {
        resetCustomerForm();
        $("#dialog_title").html("Sửa thông tin khách hàng");
        var customer_id = $(tr).attr('id');
        $.ajax({
            type: 'POST',
            url: "{{asset('adpage/customer/info')}}",
            cache: false,
            data: {id: customer_id},
            success: function (data) {
                $("#customer_form #customer_id").val(data['id']);
                if (data['username'] != null) {
                    $("#customer_form #username").val(data['username']);
                    $("#customer_form #div_username").show();
                    $("#div_email").show();
                    if (data['banned'] == 1)
                        $("#banned").iCheck('check');
                    else
                        $("#banned").iCheck('uncheck');
                    $("#customer_form #div_banned").show();
                }
                $("#customer_form #name").val(data['name']);
                $("#customer_form #phone").val(data['phone']);
                $("#customer_form #address").val(data['address']);
                $("#customer_form #email").val(data['email']);
            }
        });
        openCustomerDialog();
    }
    function addCustomer() {
        resetCustomerForm();
        $("#dialog_title").html("Thêm khách hàng");
        $("#div_username").hide();
        $("#div_banned").hide();
        openCustomerDialog();
    }

    function delCustomer() {
        var arrCustomer_ID = [];
        $("#customer_table > tbody .icheckbox_square-blue").each(function () {
            if ($(this).attr("aria-checked") == "true") {
                arrCustomer_ID.push($(this).children().attr('id'));
            }
        });
        $('#ajaxAlert').attr('class', 'alert');
        $('#ajaxAlert').hide();
        var jsonString = JSON.stringify(arrCustomer_ID);
        $.ajax({
            type: 'POST',
            url: "{{asset('adpage/customer/delCustomer')}}",
            cache: false,
            data: {customerIds: jsonString},
            success: function (msg) {
                console.log(msg);
                if (msg === 'true') {
                    $("#customer_table > tbody .icheckbox_square-blue").each(function () {
                        if ($(this).attr("aria-checked") == "true") {
                            $(this).parents('tr').fadeOut(function () {
                                $(this).remove();
                            });
                        }
                    });
                    $('#ajaxAlert').attr('class', 'alert alert-success alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-check');
                    $('#alert-content').html("Xóa khách hàng thành công!");
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
        var $form = $('#customer_form');

        if (!$form.valid()) return false;
        saveCustomer();
    });

    function saveCustomer() {
        $('#ajaxAlert').hide();
        var banned_checked = $('#banned').parent().attr('aria-checked');
        if (banned_checked == 'true') {
            $('#banned').attr('value', "1");
        }
        else {
            $('#banned').attr('value', "0");
        }

        var data = $("#customer_form").serialize();
        $.ajax({
            type: 'POST',
            url: "{{asset('adpage/customer/saveCustomer')}}",
            cache: false,
            data: data,
            success: function (data) {
                if (data == 'EDIT_SUCCEED') {
                    $("#customer_table > tbody > tr#" + $("#customer_form #customer_id").val() + ">td:nth-child(4)").html($("#customer_form #name").val());
                    $("#customer_table > tbody > tr#" + $("#customer_form #customer_id").val() + ">td:nth-child(5)").html($("#customer_form #phone").val());
                    $("#customer_table > tbody > tr#" + $("#customer_form #customer_id").val() + ">td:nth-child(6)").html($("#customer_form #address").val());
                    $("#customer_table > tbody > tr#" + $("#customer_form #customer_id").val() + ">td:nth-child(7)").html($("#customer_form #email").val());
                    if (banned_checked == 'true') {
                        $("#customer_table > tbody > tr#" + $("#customer_form #customer_id").val() + ">td:nth-child(8)").html("Bị khóa");
                    }
                    else {
                        $("#customer_table > tbody > tr#" + $("#customer_form #customer_id").val() + ">td:nth-child(8)").html("");
                    }
                    closeCustomerDialog();
                    $('#ajaxAlert').attr('class', 'alert alert-success alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-check');
                    $('#alert-content').html("Sửa thông tin khách hàng thành công!");
                    $('#ajaxAlert').show();
                }
                else if (data['msg'] == "ADD_SUCCEED") {
                    $("#customer_table > tbody").append("<tr id='" + data['customer_id'] + "' onclick='editCustomer(this);'>" +
                        "<td><div class='checkbox icheck' style='margin-top: 0'>" +
                        "<label><input id='" + data['customer_id'] + "' type='checkbox' /></label> </div></td>" +
                        "<td style='text-align: center'>{{$stt+1}}</td><td></td><td>" + $("#customer_form #name").val() + "</td>" +
                        "<td>" + $("#customer_form #phone").val() + "</td>" +
                        "<td>" + $("#customer_form #address").val() + "</td><td></td></tr>");
                    setCheckboxStyle();
                    closeCustomerDialog();
                    $('#ajaxAlert').attr('class', 'alert alert-success alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-success');
                    $('#alert-content').html("Thêm khách hàng thành công!");
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