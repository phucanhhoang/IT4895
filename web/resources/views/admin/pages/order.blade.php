<?php
/**
 * Created by IntelliJ IDEA.
 * User: Phuc Anh Hoang
 * Date: 4/18/2016
 * Time: 7:09 PM
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
        Quản lý đơn hàng
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
            <button type="button" id="btnAdd" onclick="addOrder();" class="btn btn-primary btn-flat btn-sm">Thêm
            </button>
            <button type="button" id="btnDel" onclick="delOrder();" class="btn btn-default btn-flat btn-sm">Xóa</button>
            <select id="ddlStatusOrder" name="ddlStatusOrder" class="form-control pull-right">
                <option value="-1">-- Trạng thái --</option>
                <option value="{{App\Enum\OrderStatus::CHUA_GUI_HANG}}">Chưa gửi hàng</option>
                <option value="{{App\Enum\OrderStatus::DANG_GUI_HANG}}">Đang gửi hàng</option>
                <option value="{{App\Enum\OrderStatus::DA_GUI_HANG}}">Đã gửi hàng</option>
            </select>
            <div class="input-group pull-right" style="width: 25%; margin-right: 20px">
                <input type="text" id="txtSearch" onkeypress="search_keypress(event);" class="form-control"
                       placeholder="Nhập tên khách hàng hoặc SĐT">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-primary btn-flat" onclick="search_click();"><i
                            class="fa fa-search"></i></button>
                </div><!-- /btn-group -->
            </div>

        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="order_table" class="table table-bordered table-hover table-click">
                <thead>
                <tr>
                    <th style="width: 10px">
                        <div class="checkbox icheck" style="margin-top: 0; margin-bottom: 0">
                            <label><input id="chkAll" type="checkbox"/>
                            </label>
                        </div>
                    </th>
                    <th style="width: 10px">#</th>
                    <th style="width: 160px">Khách hàng</th>
                    <th style="width: 100px">Số điện thoại</th>
                    <th class="hidden-xs">Địa chỉ</th>
                    <th class="hidden-xs" style="width: 150px">Thời gian ship</th>
                    <th class="hidden-xs">Note</th>
                    <th style="width: 120px">Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $stt = 0;
                foreach ($orders as $order) {
                    $stt++;
                    ?>
                    <tr id="{{$order->id}}" onclick="editOrder(this);"
                        class="{{$order->seen == 0 ? 'text-slim-bold' : ''}}">
                        <td>
                            <div class="checkbox icheck" style="margin-top: 0">
                                <label><input id="{{$order->id}}" type="checkbox"/>
                                </label>
                            </div>
                        </td>
                        <td>{{$stt}}</td>
                        <td>{{$order->name}}</td>
                        <td>{{$order->phone}}</td>
                        <td class="hidden-xs">{{$order->address}}</td>
                        <td class="hidden-xs">{{$order->ship_time}}</td>
                        <td class="hidden-xs">{{$order->note}}</td>
                        <td>{{$order->shipped == App\Enum\OrderStatus::CHUA_GUI_HANG ? 'Chưa gửi hàng'
                            : ($order->shipped == App\Enum\OrderStatus::DANG_GUI_HANG ? 'Đang gửi hàng'
                            : 'Đã gửi hàng')}}
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div><!-- /.box-body -->
        <!--        <div class="box-footer clearfix">-->
        <!--            <ul class="pagination pagination-sm no-margin pull-right">-->
        <!--                <li><a href="#">«</a></li>-->
        <!--                <li><a href="#">1</a></li>-->
        <!--                <li><a href="#">2</a></li>-->
        <!--                <li><a href="#">3</a></li>-->
        <!--                <li><a href="#">»</a></li>-->
        <!--            </ul>-->
        <!--        </div>-->
    </div>

    <div id="order_dialog" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 id="dialog_title" class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form id="order_form" method="post" action="">
                        <input type="hidden" id="order_id" name="order_id"/>
                        <div class="form-group" style="width: 60%;float: left;margin-right: 28px;">
                            <label for="txtNguoiNhan">Người nhận</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Họ tên"/>
                        </div>
                        <div class="form-group" style="width: 35%;display: inline-block;float: left;">
                            <label for="txtSDT">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                   placeholder="Số điện thoại người nhận"/>
                        </div>
                        <div class="form-group">
                            <label for="txtDiaChi">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address"
                                   placeholder="Địa chỉ nhận hàng"/>
                        </div>
                        <div class="form-group" style="width: 60%;float: left;margin-right: 28px;">
                            <label>Khoảng thời gian nhận hàng</label>
                            <input type="text" class="form-control" id="reservationtime"
                                   name="ship_time"/>
                        </div>
                        <div class="form-group" style="width: 35%;display: inline-block;float: left;">
                            <label for="order_status">Trạng thái đơn hàng</label>
                            <select id="order_status" name="order_status" class="form-control" style="width: 100%">
                                <option value=""></option>
                                <option value="{{App\Enum\OrderStatus::CHUA_GUI_HANG}}">Chưa gửi hàng</option>
                                <option value="{{App\Enum\OrderStatus::DANG_GUI_HANG}}">Đang gửi hàng</option>
                                <option value="{{App\Enum\OrderStatus::DA_GUI_HANG}}">Đã gửi hàng</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="taGhiChu">Ghi chú</label>
                            <textarea class="form-control" id="note" name="note"></textarea>
                        </div>
                    </form>
                    <h4>Chi tiết đơn hàng</h4>
                    <div id="search_book" class="form-group">
                        <input type="text" class="form-control" id="isbn" name="isbn" placeholder="Mã ISBN"
                               style="width: 200px;float: left;margin-right: 15px;"/>
                        <button type="button" onclick="" class="btn btn-primary btn-flat btn-sm">Thêm</button>
                    </div>
                    <table id='order_detail_table' class="table table-hover">
                        <thead>
                        <tr>
                            <th width="50%">Mặt hàng</th>
                            <th width="15%">Số lượng</th>
                            <th width="15%">Giá</th>
                            <th>Thành tiền</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Đóng</button>
                    <button type="submit" id="btnSave" class="btn btn-primary btn-flat">Lưu</button>
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
    $("#ddlStatusOrder").change(function () {
        var order_status = $(this).val();
        $.ajax({
            type: 'POST',
            url: "{{asset('adpage/order/getOrderByStatus')}}",
            cache: false,
            data: {orderStatus: order_status},
            success: function (data) {
                $("#order_table > tbody").html("");
                var stt = 0;
                for (var i = 0; i < data.length; i++) {
                    stt++;
                    var tr_class = data[i]['seen'] == 0 ? 'text-slim-bold' : '';
                    var order_status = data[i]['shipped'] == 0 ? 'Chưa gửi hàng' : (data[i]['shipped'] == 1 ? 'Đang gửi hàng' : 'Đã gửi hàng');
                    $("#order_table > tbody").append("<tr id='" + data[i]['id'] + "' onclick='editOrder(this);' " +
                        "class='" + tr_class + "'><td>" +
                        "<div class='checkbox icheck' style='margin-top: 0'><label><input id=" + data[i]['id'] + " type='checkbox' />" +
                        "</label></div></td><td>" + stt + "</td> <td>" + data[i]['name'] + "</td> " +
                        "<td>" + data[i]['phone'] + "</td> <td class='hidden-xs'>" + data[i]['address'] + "</td>" +
                        "<td class='hidden-xs'>" + data[i]['ship_time'] + "</td> <td class='hidden-xs'>" + data[i]['note'] + "</td>" +
                        "<td>" + order_status + "</td></tr>");
                }
                setCheckboxStyle();
            }
        });
    });

    $("#chkAll").on("ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed", function (e) {
        if (e.type == "ifChecked") {
            $("#order_table > tbody .icheckbox_square-blue").iCheck('check');
        }
        else {
            $("#order_table > tbody .icheckbox_square-blue").iCheck('uncheck');
        }
    });

    function resetOrderForm() {
        resetForm('order_form');
        $("#order_detail_table > tbody").html('');
    }

    function openOrderDialog(tr) {
        $(tr).addClass('text-normal');
        $("#order_dialog").modal('show');
    }
    function closeOrderDialog() {
        $("#order_dialog").modal('hide');
    }
    function editOrder(tr) {
        resetOrderForm();
        $("#dialog_title").html("Sửa đơn hàng");
        $("#search_book").hide();
        var order_id = $(tr).attr('id');
        $.ajax({
            type: 'POST',
            url: "{{asset('adpage/order/info')}}",
            cache: false,
            data: {id: order_id},
            success: function (data) {
                $("#order_form #order_id").val(data['order']['id']);
                $("#order_form #name").val(data['customer']['name']);
                $("#order_form #phone").val(data['customer']['phone']);
                $("#order_form #address").val(data['customer']['address']);
                $("#order_form #reservationtime").val(data['order']['ship_time']);
                $("#order_form #order_status").val(data['order']['shipped']);
                $("#order_form #note").val(data['order']['note']);
                var totalMoney = 0;
                for (var i = 0; i < data['order_detail'].length; i++) {
                    var money = data['order_detail'][i]['quantity'] * data['order_detail'][i]['price'];
                    var format_money = accounting.formatNumber(money, 0, ".", ",");
                    totalMoney += money;
                    $("#order_detail_table > tbody").append("<tr>" +
                        "<td>" + data['order_detail'][i]['title'] + "</td>" +
                        "<td>" + data['order_detail'][i]['quantity'] + "</td>" +
                        "<td>" + accounting.formatNumber(data['order_detail'][i]['price'], 0, ".", ",") + "</td>" +
                        "<td>" + format_money + "</td></tr>");
                }
                $("#order_detail_table > tbody").append("<tr><td colspan='2'></td><td><b>Tổng tiền</b></td><td>" + accounting.formatNumber(totalMoney, 0, ".", ",") + "</td></tr>");
            }
        });
        openOrderDialog(tr);
    }
    function addOrder() {
        resetOrderForm();
        $("#dialog_title").html("Thêm đơn hàng");
        $("#search_book").show();
        openOrderDialog(null);
    }

    function delOrder() {
        $('#ajaxAlert').hide();
        var arrOrder_ID = [];
        $("#order_table > tbody .icheckbox_square-blue").each(function () {
            if ($(this).attr("aria-checked") == "true") {
                arrOrder_ID.push($(this).children().attr('id'));
            }
        });
        $('#ajaxAlert').attr('class', 'alert');
        $('#ajaxAlert').hide();
        var jsonString = JSON.stringify(arrOrder_ID);
        $.ajax({
            type: 'POST',
            url: "{{asset('adpage/order/delorder')}}",
            cache: false,
            data: {orderIds: jsonString},
            success: function (msg) {
                console.log(msg);
                if (msg === 'true') {
                    $("#order_table > tbody .icheckbox_square-blue").each(function () {
                        if ($(this).attr("aria-checked") == "true") {
                            $(this).parents('tr').fadeOut(function () {
                                $(this).remove();
                            });
                        }
                    });
                    $('#ajaxAlert').attr('class', 'alert alert-success alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-check');
                    $('#alert-content').html("Xóa đơn hàng thành công!");
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
        var $form = $('#order_form');

        if (!$form.valid()) return false;
        saveOrder();
    });

    function saveOrder() {
        $('#ajaxAlert').hide();
        var data = $("#order_form").serialize();
        $.ajax({
            type: 'POST',
            url: "{{asset('adpage/order/saveOrder')}}",
            cache: false,
            data: data,
            success: function (msg) {
                if (msg == 'true') {
                    $("#order_table > tbody > tr#" + $("#order_form #order_id").val() + ">td:nth-child(3)").html($("#order_form #name").val());
                    $("#order_table > tbody > tr#" + $("#order_form #order_id").val() + ">td:nth-child(4)").html($("#order_form #phone").val());
                    $("#order_table > tbody > tr#" + $("#order_form #order_id").val() + ">td:nth-child(5)").html($("#order_form #address").val());
                    $("#order_table > tbody > tr#" + $("#order_form #order_id").val() + ">td:nth-child(6)").html($("#order_form #reservationtime").val());
                    $("#order_table > tbody > tr#" + $("#order_form #order_id").val() + ">td:nth-child(7)").html($("#order_form #note").val());
                    var order_status = $("#order_form #order_status").val() == 0 ? 'Chưa gửi hàng' : ($("#order_form #order_status").val() == 1 ? 'Đang gửi hàng' : 'Đã gửi hàng');
                    $("#order_table > tbody > tr#" + $("#order_form #order_id").val() + ">td:nth-child(8)").html(order_status);
                    closeOrderDialog();
                    $('#ajaxAlert').attr('class', 'alert alert-success alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-check');
                    $('#alert-content').html("Sửa đơn hàng thành công!");
                    $('#ajaxAlert').show();
                }
                else if (msg == "NOT_FOUND") {
                    closeOrderDialog();
                    $('#ajaxAlert').attr('class', 'alert alert-warning alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-warning');
                    $('#alert-content').html("Chức năng chưa hoàn thiện.");
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

    function search_keypress(e) {
        if (e.keyCode == 13)
            search_click();
    }
    function search_click() {
        var key = $("#txtSearch").val();
        $.ajax({
            type: "POST",
            url: "{{asset('adpage/order/search')}}",
            cache: false,
            data: {key: key},
            success: function (data) {
                $("#order_table > tbody").html("");
                var stt = 0;
                for (var i = 0; i < data.length; i++) {
                    stt++;
                    var tr_class = data[i]['seen'] == 0 ? 'text-slim-bold' : '';
                    var order_status = data[i]['shipped'] == 0 ? 'Chưa gửi hàng' : (data[i]['shipped'] == 1 ? 'Đang gửi hàng' : 'Đã gửi hàng');
                    $("#order_table > tbody").append("<tr id='" + data[i]['id'] + "' onclick='editOrder(this);' " +
                        "class='" + tr_class + "'><td>" +
                        "<div class='checkbox icheck' style='margin-top: 0'><label><input id=" + data[i]['id'] + " type='checkbox' />" +
                        "</label></div></td><td>" + stt + "</td> <td>" + data[i]['name'] + "</td> " +
                        "<td>" + data[i]['phone'] + "</td> <td class='hidden-xs'>" + data[i]['address'] + "</td>" +
                        "<td class='hidden-xs'>" + data[i]['ship_time'] + "</td> <td class='hidden-xs'>" + data[i]['note'] + "</td>" +
                        "<td>" + order_status + "</td></tr>");
                }
                setCheckboxStyle();
            }
        });
    }
</script>
@stop
