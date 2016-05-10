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
        Quản lý sách
        <!--		<small>it all starts here</small>-->
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{asset('adpage')}}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">Quản lý sách</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">

    </div>

    <div class="box">
        <div class="box-header with-border">
            <button type="button" id="btnAdd" onclick="addBook();" class="btn btn-primary btn-flat btn-sm">Thêm
            </button>
            <button type="button" id="btnDel" onclick="delBook();" class="btn btn-default btn-flat btn-sm">Xóa</button>
            <select id="ddlStatusOrder" name="ddlStatusOrder" class="form-control pull-right">
                <option value="-1">-- Trạng thái --</option>
                <option value="{{App\Enum\OrderStatus::CHUA_GUI_HANG}}">Chưa gửi hàng</option>
                <option value="{{App\Enum\OrderStatus::DANG_GUI_HANG}}">Đang gửi hàng</option>
                <option value="{{App\Enum\OrderStatus::DA_GUI_HANG}}">Đã gửi hàng</option>
            </select>
            <div class="input-group pull-right" style="width: 25%; margin-right: 20px">
                <input type="text" class="form-control" placeholder="Nhập tên khách hàng hoặc SĐT">
                <div class="input-group-btn">
                    <button type="button" class="btn btn-primary btn-flat"><i class="fa fa-search"></i></button>
                </div><!-- /btn-group -->
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="book_table" class="table table-bordered table-hover table-click">
                <thead>
                <tr>
                    <th style="width: 10px">
                        <div class="checkbox icheck" style="margin-top: 0; margin-bottom: 0">
                            <label><input id="chkAll" type="checkbox"/>
                            </label>
                        </div>
                    </th>
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
                foreach ($data['books'] as $book) {
                    $stt++;
                    ?>
                    <tr id="{{$book->id}}" onclick="editBook(this);">
                        <td>
                            <div class="checkbox icheck" style="margin-top: 0">
                                <label><input id="{{$book->id}}" type="checkbox"/>
                                </label>
                            </div>
                        </td>
                        <td>{{$stt}}</td>
                        <td><img src="{{asset($book->image)}}" style="max-width: 100%; max-height: 100%"/></td>
                        <td>{{$book->title}}</td>
                        <td>{{$book->genre_name}}</td>
                        <td>{{$book->author_name}}</td>
                        <td>{{number_format($book->price, 0, ',', '.')}}</td>
                        <td>{{$book->sale}}</td>
                        <td>{{$book->quantity}}</td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div>

    <div id="book_dialog" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 id="dialog_title" class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form id="book_form" method="post" action="">
                        <input type="hidden" id="book_id" name="book_id"/>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="title">Tên sách</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                           placeholder="Tên sách" required/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="genre_id">Thể loại</label>
                                    <select id="genre_id" name="genre_id" required class="form-control select2"
                                            style="width: 100%;">
                                        <option value="" selected="selected">-- Thể loại sách --</option>
                                        @foreach($data['genres'] as $genre)
                                        <option value="{{$genre->id}}" data-name="{{$genre->name}}">{{$genre->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="publisher_id">Nhà xuất bản</label>
                                    <select id="publisher_id" name="publisher_id" class="form-control select2"
                                            style="width: 100%;" required>
                                        <option value="" selected="selected">-- Nhà xuất bản --</option>
                                        @foreach($data['publishers'] as $publisher)
                                        <option value="{{$publisher->id}}" data-name="{{$publisher->name}}">
                                            {{$publisher->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="author_id">Tác giả</label>
                                    <select id="author_id" name="author_id" class="form-control select2"
                                            style="width: 100%;" required>
                                        <option value="" selected="selected">-- Tác giả --</option>
                                        @foreach($data['authors'] as $author)
                                        <option value="{{$author->id}}" data-name="{{$author->name}}">
                                            {{$author->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="image">Đường dẫn ảnh</label>
                                    <div class="input-group pull-right" style="">
                                        <input type="text" class="form-control" id="image" name="image"
                                               placeholder="Đường dẫn ảnh" required>
                                        <div class="input-group-btn">
                                            <button type="button" onclick="BrowseServer();"
                                                    class="btn btn-default btn-flat">Duyệt...
                                            </button>
                                        </div><!-- /btn-group -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="isbn">ISBN</label>
                                    <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN"
                                           required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="price">Giá</label>
                                    <input type="text" class="form-control" id="price" name="price" placeholder="Giá"
                                           required/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="quantity">Số lượng</label>
                                    <input type="text" class="form-control" id="quantity" name="quantity"
                                           placeholder="Số lượng" required/>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="sale">Sale (%)</label>
                                    <input type="text" class="form-control" id="sale" name="sale"
                                           placeholder="Giảm giá %"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description_short">Mô tả ngắn</label>
                            <textarea rows="3" class="form-control" id="description_short"
                                      name="description_short" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả chi tiết</label>
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
<style>
    #image-error {
        position: absolute;
        top: 30px;
        left: 0px;
    }
</style>
@stop

@section('javascript')
<script>
    function BrowseServer() {
        var finder = new CKFinder();
        //finder.basePath = '../';
        finder.selectActionFunction = SetFileField;
        finder.popup();
    }
    function SetFileField(fileUrl) {
        document.getElementById('image').value = fileUrl;
    }
    var editor = CKEDITOR.replace('description');
    CKFinder.setupCKEditor(editor, "{{asset('/plugins/ckfinder')}}");
    $("#chkAll").on("ifCreated ifClicked ifChanged ifChecked ifUnchecked ifDisabled ifEnabled ifDestroyed", function (e) {
        if (e.type == "ifChecked") {
            $("#book_table > tbody .icheckbox_square-blue").iCheck('check');
        }
        else {
            $("#book_table > tbody .icheckbox_square-blue").iCheck('uncheck');
        }
    });

    function resetBookForm() {
        resetForm('book_form');
        $(".error").attr('style', "border-color: #ccc; color: inherit;");
        $('label.error').hide();
        $('#select2-genre_id-container').html('');
        $('#select2-publisher_id-container').html('');
        $('#select2-author_id-container').html('');
    }

    function openBookDialog() {
        $("#book_dialog").modal('show');
    }
    function closeBookDialog() {
        $("#book_dialog").modal('hide');
    }
    function editBook(tr) {
        resetBookForm();
        $("#dialog_title").html("Sửa thể loại sách");
        var book_id = $(tr).attr('id');
        $.ajax({
            type: 'POST',
            url: "{{asset('adpage/book/info')}}",
            cache: false,
            data: {id: book_id},
            success: function (data) {
                $("#book_form #book_id").val(data['id']);
                $("#book_form #title").val(data['title']);
                $("#genre_id").select2("val", data['genre_id']);
                $("#author_id").select2("val", data['author_id']);
                $("#publisher_id").select2("val", data['publisher_id']);
                $("#book_form #image").val(data['image']);
                $("#book_form #isbn").val(data['isbn']);
                $("#book_form #price").val(data['price']);
                $("#book_form #quantity").val(data['quantity']);
                $("#book_form #sale").val(data['sale']);
                $("#book_form #description_short").val(data['description_short']);
                CKEDITOR.instances['description'].setData(data['description']);
            }
        });
        openBookDialog();
    }
    function addBook() {
        resetBookForm();
        $("#dialog_title").html("Thêm thể loại sách");
        openBookDialog();
    }

    function delBook() {
        var arrBook_ID = [];
        $("#book_table > tbody .icheckbox_square-blue").each(function () {
            if ($(this).attr("aria-checked") == "true") {
                arrBook_ID.push($(this).children().attr('id'));
            }
        });
        $('#ajaxAlert').attr('class', 'alert');
        $('#ajaxAlert').hide();
        var jsonString = JSON.stringify(arrBook_ID);
        $.ajax({
            type: 'POST',
            url: "{{asset('adpage/book/delBook')}}",
            cache: false,
            data: {bookIds: jsonString},
            success: function (msg) {
                if (msg === 'true') {
                    $("#book_table > tbody .icheckbox_square-blue").each(function () {
                        if ($(this).attr("aria-checked") == "true") {
                            $(this).parents('tr').fadeOut(function () {
                                $(this).remove();
                            });
                        }
                    });
                    $('#ajaxAlert').attr('class', 'alert alert-success alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-check');
                    $('#alert-content').html("Xóa sách thành công!");
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
        var $form = $('#book_form');

        if (!$form.valid()) return false;
        saveBook();
    });

    function saveBook() {
        $('#ajaxAlert').hide();
        $('#description').val(CKEDITOR.instances['description'].getData());
        var data = $("#book_form").serialize();
        $.ajax({
            type: 'POST',
            url: "{{asset('adpage/book/saveBook')}}",
            cache: false,
            data: data,
            success: function (data) {
                if (data == 'EDIT_SUCCEED') {
                    $("#book_table > tbody > tr#" + $("#book_form #book_id").val() + ">td:nth-child(3)").html("<img src='../" + $('#image').val() + "' style='max-width: 100%; max-height: 100%' />");
                    $("#book_table > tbody > tr#" + $("#book_form #book_id").val() + ">td:nth-child(4)").html($("#book_form #title").val());
                    $("#book_table > tbody > tr#" + $("#book_form #book_id").val() + ">td:nth-child(5)").html($("#book_form #genre_id").select2().find(":selected").data("name"));
                    $("#book_table > tbody > tr#" + $("#book_form #book_id").val() + ">td:nth-child(6)").html($("#book_form #author_id").select2().find(":selected").data("name"));
                    $("#book_table > tbody > tr#" + $("#book_form #book_id").val() + ">td:nth-child(7)").html(accounting.formatNumber($("#book_form #price").val(), 0, ".", ","));
                    $("#book_table > tbody > tr#" + $("#book_form #book_id").val() + ">td:nth-child(8)").html($("#book_form #sale").val());
                    $("#book_table > tbody > tr#" + $("#book_form #book_id").val() + ">td:nth-child(9)").html($("#book_form #quantity").val());
                    closeBookDialog();
                    $('#ajaxAlert').attr('class', 'alert alert-success alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-check');
                    $('#alert-content').html("Sửa thông tin sách thành công!");
                    $('#ajaxAlert').show();
                }
                else if (data['msg'] == "ADD_SUCCEED") {
                    $("#book_table > tbody").append("<tr id='" + data['book_id'] + "' onclick='editBook(this);'>" +
                        "<td><div class='checkbox icheck' style='margin-top: 0'>" +
                        "<label><input id='" + data['book_id'] + "' type='checkbox'/></label></div></td>" +
                        "<td>{{$stt+1}}</td><td><img src='../" + $('#image').val() + "' style='max-width: 100%; max-height: 100%' /></td>" +
                        "<td>" + $("#book_form #title").val() + "</td><td>" + data['genre_name'] + "</td><td>" + data['author_name'] + "</td>" +
                        "<td>" + accounting.formatNumber($("#book_form #price").val(), 0, ".", ",") + "</td>" +
                        "<td>" + $("#book_form #sale").val() + "</td><td>" + $("#book_form #quantity").val() + "</td></tr>");
                    setCheckboxStyle();
                    closeBookDialog();
                    $('#ajaxAlert').attr('class', 'alert alert-success alert-dismissable fade in');
                    $('#alert-icon').attr('class', 'icon fa fa-success');
                    $('#alert-content').html("Thêm sách thành công!");
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