<?php
/*layout chung trong project 
 *gom co 
 		header
 			--banner
 			--navigator
 		body
 			--sidebar --content
 		footer	
*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>

    <title>@yield('title')</title>
    {{-- {{ HTML::style('/bootstrap/css/bootstrap.css'); }} --}}
    <link rel="stylesheet" href="{{asset('resources/assets/css/font-awesome/css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" href="{{asset('resources/assets/bootstrap/css/bootstrap.min.css')}}"/>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{asset('resources/assets/plugins/daterangepicker/daterangepicker-bs3.css')}}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{asset('resources/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">

    <link rel="stylesheet" href="{{asset('resources/assets/css/skins/_all-skins.min.css')}}">
    <!-- alert animation style -->
    <link rel="stylesheet" href="{{asset('resources/assets/plugins/alert-animation/alert.animation.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('resources/assets/plugins/select2/select2.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('resources/assets/css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('resources/assets/plugins/iCheck/square/blue.css')}}">
    <!-- MyStyle -->
    <link rel="stylesheet" href="{{asset('resources/assets/css/style.admin.css')}}">

    @yield('style')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('admin.include.header')

    @include('admin.include.sidebar')
    {{-- Content --}}
    <div class="content-wrapper" style="min-height: 916px;">
        @yield('content')
    </div>
    @if (session('message'))
    <div id="myAlert" class="alert {{session('alert-class')}} alert-dismissable fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fa {{session('fa-class')}}"></i>
        {{ session('message') }}
    </div>
    @endif
    <div id="ajaxAlert" class="alert" style="display: none">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i id="alert-icon" class="icon fa"></i>
        <span id="alert-content"></span>
    </div>
    {{-- Footer --}}
    @include('admin.include.footer')
</div>
<!-- jQuery 2.1.4 -->
<script src="{{asset('resources/assets/plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
<!--jQuery validate-->
<script src="{{asset('resources/assets/plugins/jQueryValidate/jquery.validate.js')}}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{asset('resources/assets/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('resources/assets/plugins/select2/select2.full.min.js')}}"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{asset('resources/assets/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('resources/assets/plugins/fastclick/fastclick.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('resources/assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('resources/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('resources/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{asset('resources/assets/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- CK Finder -->
<script src="{{asset('resources/assets/plugins/ckfinder/ckfinder.js')}}"></script>
<!-- CK Editor -->
<script src="{{asset('resources/assets/plugins/ckeditor/ckeditor.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('resources/assets/js/app.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes)
<script src="{{asset('js/dashboard2.js')}}"></script>
-->
<!-- AdminLTE Demo -->
<script src="{{asset('resources/assets/js/demo.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('resources/assets/plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{asset('resources/assets/js/back-to-top.js')}}" type="text/javascript" charset="utf-8"></script>
<script src="{{asset('resources/assets/js/accounting.js')}}" type="text/javascript" charset="utf-8"></script>
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.fn.modal.Constructor.prototype.enforceFocus = function () {
        };

        //Initialize Select2 Elements
        $(".select2").select2();

        //Initialize CKEditor
        CKEDITOR.editorConfig = function (config) {
            config.language = 'vi';
            config.uiColor = '#AADC6E';
            config.filebrowserBrowseUrl = "{{asset('resources/assets/plugins/ckfinder/ckfinder.html')}}";
            config.filebrowserImageBrowseUrl = "{{asset('resources/assets/plugins/ckfinder/ckfinder.html?type=Images')}}";
            config.filebrowserFlashBrowseUrl = "{{asset('resources/assets/plugins/ckfinder/ckfinder.html?type=Flash')}}";
            config.filebrowserUploadUrl = "{{asset('resources/assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')}}";
            config.filebrowserImageUploadUrl = "{{asset('resources/assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images')}}";
            config.filebrowserFlashUploadUrl = "{{asset('resources/assets/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash')}}";
        };

        //Datetime range
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePicker12Hour: false,
            timePickerIncrement: 30,
            format: 'DD/MM/YYYY h:mm A'
        });

        //Checkbox style
        setCheckboxStyle();

        //Set style cho alert
        var window_width = $(window).width();
        var alert_width = 400;
        if (window_width < alert_width) {
            alert_width = window_width - 20;
        }
        $('#myAlert').attr('style', 'width:' + alert_width + 'px;left:' + (window_width - alert_width) / 2 + 'px');
        $('#ajaxAlert').attr('style', 'width:' + alert_width + 'px;display:none;left:' + (window_width - alert_width) / 2 + 'px');

        //Set active cho sidebar-menu
        $('#sidebar-menu').find("a[href='{{URL::current()}}']").parent().parent().parent().addClass('active');
        $('#sidebar-menu').find("a[href='{{URL::current()}}']").parent().parent().addClass('menu-open');
        $('#sidebar-menu').find("a[href='{{URL::current()}}']").parent().parent().attr('style', 'display: block');
        $('#sidebar-menu').find("a[href='{{URL::current()}}']").parent().addClass('active');

        //Validate
        jQuery.validator.addMethod("phoneno", function (phone_number, element) {
            phone_number = phone_number.replace(/\s+/g, "");
            return this.optional(element) || phone_number.length > 9 &&
                phone_number.match(/^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/);
        }, "Please specify a valid phone number");
        $('#order_form').validate({
            rules: {
                name: 'required',
                phone: {
                    required: true,
                    phoneno: true,
                    minlength: 10,
                    maxlength: 11
                },
                address: 'required',
                ship_time: 'required',
                order_status: 'required'
            }
        });
        $('#book_form').validate({
            rules: {
                isbn: 'digits',
                price: 'digits',
                quantity: 'digits',
                sale: 'digits',
                'description': {
                    required: true
                }
            },
            ignore: []
        });
        $("#customer_form").validate({
            rules: {
                name: 'required',
                address: 'required',
                phone: 'required',
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "{{asset('adpage/checkexist/email')}}",
                        type: 'POST'
                    }
                }
            },
            messages: {
                email: {
                    remote: "Email already in use!"
                }
            }
        });
        $("#account_form").validate({
            rules: {
                username: {
                    required: true,
                    remote: {
                        url: "{{asset('adpage/checkexist/username')}}",
                        type: 'POST'
                    }
                },
                password: {
                    minlength: 8
                },
                retype_password: {
                    equalTo: "#password",
                    minlength: 8
                },
                email: {
                    required: true,
                    email: true,
                    remote: {
                        url: "{{asset('adpage/checkexist/email')}}",
                        type: 'POST'
                    }
                }
            },
            messages: {
                username: {
                    remote: "Account already in use!"
                },
                email: {
                    remote: "Email already in use!"
                }
            }
        });
    });


    function setCheckboxStyle() {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    }
    function resetForm(id) {
        arrInput = $('#' + id).find('input');
        for (var i = 0; i < arrInput.length; i++) {
            $(arrInput[i]).val('');
        }
        arrArea = $('#' + id).find('textarea');
        for (var i = 0; i < arrArea.length; i++) {
            $(arrArea[i]).val('');
        }
        arrSelectBox = $('#' + id).find('select');
        for (var i = 0; i < arrSelectBox.length; i++) {
            $(arrSelectBox[i]).val('');
        }
    }
</script>
@yield('javascript')
</body>
</html>