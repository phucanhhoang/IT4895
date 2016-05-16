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
BookStore - Account Management Page
@stop

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Quản lý Account
        <!--		<small>it all starts here</small>-->
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{asset('adpage')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">Quản lý Account</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">

    </div>

    <div class="box">
        <div class="box-header with-border">
            <button type="button" id="btnAdd" onclick="addAccount();" class="btn btn-primary btn-flat btn-sm">Thêm
            </button>
            <button type="button" id="btnDel" onclick="delAccount();" class="btn btn-default btn-flat btn-sm">Xóa
            </button>
            <div class="input-group pull-right" style="width: 25%">
                <input type="text" class="form-control" placeholder="Nhập tên, account hoặc số điện thoại khách hàng">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
                </div><!-- /btn-group -->
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="account_table" class="table table-bordered table-hover table-click">
                <thead>
                <tr>
                    <th style="width: 10px">
                        <div class="checkbox icheck" style="margin-top: 0; margin-bottom: 0">
                            <label><input id="chkAll" type="checkbox"/>
                            </label>
                        </div>
                    </th>
                    <th style="width: 10px; text-align: center">#</th>
                    <th style="width: 20%">Account</th>
                    <th style="width: 44%">Email</th>
                    <th style="width: 20%">Nhóm</th>
                    <th style="width: 90px">Trạng thái</th>
                </tr>
                </thead>
                <?php
                $stt = 0;
                foreach ($accounts as $account) {
                    $stt++;
                    ?>
                    <tr id="{{$account->id}}" onclick="editAccount(this);">
                        <td>
                            <div class="checkbox icheck" style="margin-top: 0">
                                <label><input id="{{$account->id}}" type="checkbox"/>
                                </label>
                            </div>
                        </td>
                        <td style="text-align: center">{{$stt}}</td>
                        <td>{{$account->username}}</td>
                        <td>{{$account->email}}</td>
                        <td>{{$account->userable_type}}</td>
                        <td>{{$account->banned == 1 ? "Bị khóa" : ""}}</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div>

    <div id="account_dialog" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 id="dialog_title" class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form id="account_form" method="post" action="">
                        <input type="hidden" id="account_id" name="account_id"/>
                        <div class="form-group">
                            <label for="username">Account</label>
                            <input type="text" class="form-control" id="username" name="username" required/>
                        </div>
                        <div class="form-group pull-left" style="width: 50%;margin-right: 28px;">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password" required/>
                        </div>
                        <div class="form-group" style="width: 45%;display:inline-block;">
                            <label for="retype_password">Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" id="retype_password" name="retype_password"
                                   required/>
                        </div>
                        <div class="form-group pull-left" style="width: 50%;margin-right: 28px;">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" required/>
                        </div>
                        <div class="form-group" style="width: 45%;display: inline-block">
                            <label for="userable_type">Nhóm</label>
                            <select id="userable_type" name="userable_type" class="form-control" style="width: 100%"
                                    required>
                                <option value=""></option>
                                <option value="admin">admin</option>
                                <option value="manager">manager</option>
                            </select>
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
            $("#account_table > tbody .icheckbox_square-blue").iCheck('check');
        }
        else {
            $("#account_table > tbody .icheckbox_square-blue").iCheck('uncheck');
        }
    });

    function resetAccountForm() {
        resetForm('account_form');
    }

    function openAccountDialog() {
        $("label.error").hide();
        $("#account_dialog").modal('show');
    }
    function closeAccountDialog() {
        $("#account_dialog").modal('hide');
    }
    function editAccount(tr) {
        resetAccountForm();
        $("#dialog_title").html("Sửa thông tin tài khoản");
        $("#account_form #username").attr('readonly', '');
        $("#account_form #username").rules("remove");
        $("#account_form #password").attr('readonly', '');
        $("#account_form #retype_password").attr('readonly', '');
        $("#account_form #div_banned").show();
        var account_id = $(tr).attr('id');
        $.ajax({
            type: 'POST',
            url: "{{asset('adpage/account/info')}}",
            cache: false,
            data: {id: account_id},
            success: function (data) {
                $("#account_form #account_id").val(data['id']);
                var cur_user = "{{Auth::user()->username}}";
                if (data['username'] == cur_user) {
                    $("#account_form #password").removeAttr('readonly');
                    $("#account_form #retype_password").removeAttr('readonly');
                    $("#account_form #password").attr('required', '');
                    $("#account_form #retype_password").attr('required', '');
                }
                else {
                    $("#account_form #password").removeAttr('required');
                    $("#account_form #retype_password").removeAttr('required');
                }
                $("#account_form #username").val(data['username']);
                $("#account_form #email").val(data['email']);
                $("#account_form #userable_type").val(data['userable_type']);
                if (data['banned'] == 1)
                    $("#banned").iCheck('check');
                else
                    $("#banned").iCheck('uncheck');
            }
        });
        openAccountDialog();
    }
    function addAccount() {
        resetAccountForm();
        $("#dialog_title").html("Thêm tài khoản");
        $("#account_form #username").rules("add", {
            required: true,
            remote: {
                url: "{{asset('adpage/checkexist/username')}}",
                type: 'POST'
            },
            messages: {
                remote: "Account already in use!"
            }
        });
        $("#account_form #username").removeAttr('readonly');
        $("#account_form #password").removeAttr('readonly');
        $("#account_form #retype_password").removeAttr('readonly');
        $("#div_banned").hide();
        openAccountDialog();
    }

    function delAccount() {
        var arrAccount_ID = [];
        $("#account_table > tbody .icheckbox_square-blue").each(function () {
            if ($(this).attr("aria-checked") == "true") {
                arrAccount_ID.push($(this).children().attr('id'));
            }
        });
        $('#ajaxAlert').attr('class', 'alert');
        $('#ajaxAlert').hide();
        var jsonString = JSON.stringify(arrAccount_ID);
        $.ajax({
            type: 'POST',
            url: "{{asset('adpage/account/delAccount')}}",
            cache: false,
            data: {accountIds: jsonString},
            success: function (msg) {
                console.log(msg);
                if (msg === 'true') {
                    $("#account_table > tbody .icheckbox_square-blue").each(function () {
                        if ($(this).attr("aria-checked") == "true") {
                            $(this).parents('tr').fadeOut(function () {
                                $(this).remove();
                            });
                        }
                    });
                    $('#ajaxAlert').attr('class', 'alert alert-success alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-check');
                    $('#alert-content').html("Xóa tài khoản thành công!");
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
        var $form = $('#account_form');
        if (!$form.valid()) return false;
        saveAccount();
    });

    function saveAccount() {
        $('#ajaxAlert').hide();
        var banned_checked = $('#banned').parent().attr('aria-checked');
        if (banned_checked == 'true') {
            $('#banned').attr('value', "1");
        }
        else {
            $('#banned').attr('value', "0");
        }

        var data = $("#account_form").serialize();
        $.ajax({
            type: 'POST',
            url: "{{asset('adpage/account/saveAccount')}}",
            cache: false,
            data: data,
            success: function (data) {
                if (data == 'EDIT_SUCCEED') {
                    $("#account_table > tbody > tr#" + $("#account_form #account_id").val() + ">td:nth-child(3)").html($("#account_form #username").val());
                    $("#account_table > tbody > tr#" + $("#account_form #account_id").val() + ">td:nth-child(4)").html($("#account_form #email").val());
                    $("#account_table > tbody > tr#" + $("#account_form #account_id").val() + ">td:nth-child(5)").html($("#account_form #userable_type").val());
                    if (banned_checked == 'true') {
                        $("#account_table > tbody > tr#" + $("#account_form #account_id").val() + ">td:nth-child(6)").html("Bị khóa");
                    }
                    else {
                        $("#account_table > tbody > tr#" + $("#account_form #account_id").val() + ">td:nth-child(6)").html("");
                    }
                    closeAccountDialog();
                    $('#ajaxAlert').attr('class', 'alert alert-success alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-check');
                    $('#alert-content').html("Sửa thông tin tài khoản thành công!");
                    $('#ajaxAlert').show();
                }
                else if (data['msg'] == "ADD_SUCCEED") {
                    $("#account_table > tbody").append("<tr id='" + data['account_id'] + "' onclick='editAccount(this);'>" +
                        "<td><div class='checkbox icheck' style='margin-top: 0'>" +
                        "<label><input id='" + data['account_id'] + "' type='checkbox' /></label> </div></td>" +
                        "<td style='text-align: center'>{{$stt+1}}</td><td>" + $("#account_form #username").val() + "</td>" +
                        "<td>" + $("#account_form #email").val() + "</td>" +
                        "<td>" + $("#account_form #userable_type").val() + "</td><td></td></tr>");
                    setCheckboxStyle();
                    closeAccountDialog();
                    $('#ajaxAlert').attr('class', 'alert alert-success alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-success');
                    $('#alert-content').html("Thêm tài khoản mới thành công!");
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