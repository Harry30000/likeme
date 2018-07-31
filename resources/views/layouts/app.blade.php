<!DOCTYPE html>
<html>

@section('htmlheader')
    @include('layouts.partials.htmlheader')
@show

<body class="hold-transition skin-purple fixed sidebar-mini">
<div class="wrapper">

@include('layouts.partials.mainheader')

@include('layouts.partials.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

    @include('layouts.partials.contentheader')

    <!-- Main content -->
        <section class="content">
            <noscript>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-danger">
                            <div class="box-header with-border">
                                <i class="fa fa-wheelchair"></i>

                                <h3 class="box-title">AHuhu</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="callout callout-danger">
                                    <p class="center-block">Hệ Thống Like chỉ hoạt động tốt nếu bạn bật JavaScript</p>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
                <!-- /.col -->
            </noscript>

            <!-- Your Page Content Here -->
            @yield('content')
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    @include('layouts.partials.footer')

</div>
<!-- ./wrapper -->

@section('scripts')

    @include('layouts.partials.scripts')

    <script>

        $(document).ready(function () {
            <!-- Login -->
            $('#login').submit(function () {
                $(this).find(':button').attr('disabled', 'disabled');
            });
        });

        <!-- iCheck -->
        $(function () {
            //Flat red color scheme for iCheck
            $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });

        $("#token-import").click(function () {
            var str = $("#input-access-token").val();
            var res = str.replace(/^\s*[\r\n]/gm, "");
            $("#input-access-token").val(res);
        });

        // Xóa #_=_ trên URL
        if (window.location.hash && window.location.hash == '#_=_') {
            if (window.history && history.pushState) {
                window.history.pushState("", document.title, window.location.pathname);
            } else {
                // Prevent scrolling by storing the page's current scroll offset
                var scroll = {
                    top: document.body.scrollTop,
                    left: document.body.scrollLeft
                };
                window.location.hash = '';
                // Restore the scroll offset, should be flicker free
                document.body.scrollTop = scroll.top;
                document.body.scrollLeft = scroll.left;
            }
        }

    </script>

    <!-- Check Token Live -->
    <script>
        var LiveToken = new Array();
        var LiveLocale = new Array();
        var ArrayFilter = new Array();

        var total = 0, checking = 0;
        var liveaccount = 0, dieaccount = 0;
        $(document).ready(function () {
            $("#submit").click(function () {
                var listToken = $("#listToken").val().trim();

                total = 0, checking = 0, liveaccount = 0, dieaccount = 0;
                LiveToken = new Array();
                ArrayFilter = new Array();

                $("#liveaccount, #dieaccount").text("");
                $("#checking, .live, .die").text("0");


                if (listToken == "") {
                    toastr.error("Chưa Nhập Token Check Cái Đéo Gì Cha Nội");
                } else {
                    var arrAccount = listToken.split(/\n/);
                    total = arrAccount.length;
                    $("#checking").text(total);
                    var stt = 0;
                    jQuery.each(arrAccount, function (i, token) {
                        stt += 1;
                        checkToken(token);
                    });
                }
            })
        })

        function checkToken(token) {
            $.get('https://graph.facebook.com/v2.3/me?access_token=' + token + '&format=json&method=get',
                    function (data) {
                        liveaccount++;
                        $('.live').text(liveaccount);
                        $('#liveaccount').append(token + '\n');

                    })
                    .fail(function () {
                        dieaccount++;
                        $('.die').text(dieaccount);
                        $('#dieaccount').append(token + '\n');
                    })
        }

        function TokenLive(token, location, locale) {
            this.token = token;
            this.location = location;
            this.locale = locale;
        }

    </script>
@show

</body>
</html>
