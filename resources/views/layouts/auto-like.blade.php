@extends('layouts.app')

@section('sidebar-menu')
    <li><a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> <span>Dashboard</span></a></li>
    <li class="active"><a href="{{ url('/home/tang-like') }}"><i class="fa fa-fw fa-thumbs-up"></i> <span>Tăng Like</span></a></li>
    <li><a href="{{ url('/home/tang-comment') }}"><i class="fa fa-fw fa-commenting"></i> <span>Tăng Comment</span></a></li>
@endsection
<!-- Content Header (Page header) -->
@section('content-header')
    <h1>
        {{ $page_title or "Dashboard" }}
        <small>{{ $page_description or "Tăng Like" }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Tăng Like</li>
    </ol>
@endsection

<!-- Main content -->
@section('content')
    <!-- Your Page Content Here -->
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <i class="fa fa-facebook-official"></i>

                    <h3 class="box-title">{{Auth::check() ? Auth::user()->name : 'User'}}</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form accept-charset="UTF-8" action="{{ url('/home/tang-like') }}" method="post">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label class="control-label">Nhập ID</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-tags"></i>
                                </div>
                                <input autofocus type="text" class="form-control" placeholder="373676439503367" name="fbid" id="fbid">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">Giới hạn số lượng:</label>
                            <input id="limit" name="limit" />
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="button" class="btn btn-success btn-block btn-flat ajax" id="like"
                                    data-loading-text="<i class='fa fa-spin fa-refresh'></i> Đang Tăng Like">
                                Submit
                            </button>
                            <button type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
@endsection

@section('scripts')

    @include('layouts.partials.scripts')

    <script>
        $(document).ready(function () {

            // Biến kiểm tra
            var ajax_sendding = false;

            /**
             * Auto Like
             */
            $('#like').click(function (e) {

                var ids = $('#fbid').val();
                var $id = '';
                //limit = document.getElementById('limit').value;
                //autos = 'like';
                if (ids.match(/fbid=([0-9]*)&set/)) {
                    id = ids.match(/photo.php\?fbid=([0-9]*)&set/)[1];
                } else if (ids.match(/story_fbid=([0-9]*)&/)) {
                    id = ids.match(/story_fbid=([0-9]*)&/)[1];
                } else if (ids.match(/posts\/([0-9]*)/)) {
                    id = ids.match(/posts\/([0-9]*)/)[1];
                } else if (ids.match(/fbid=([0-9]*)&/)) {
                    id = ids.match(/posts\/([0-9]*)/)[1];
                } else if (ids.match(/facebook\.com\/([0-9]*)\/photos/)) {
                    id = ids.match(/facebook\.com\/([0-9]*)\/photos/)[1];
                } else if (ids.match(/www.facebook.com\/(.*)\/videos\/([0-9]*)/)) {
                    id = ids.match(/www.facebook.com\/(.*)\/videos\/([0-9]*)/)[2];
                } else {
                    id = ids;
                }

                $("#fbid").val(id);

                // kiểm tra trạng thái có đang gửi ajax không
                // Nếu đang gửi thì dừng
                if (ajax_sendding == true) {
                    return false;
                }

                // Ngược lại thì bắt đầu gửi ajax
                // Nhưng trước hết gán biến ajax_sendding = true để khi người dùng click tiếp
                // sẽ không có tác dụng
                ajax_sendding = true;

                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var $this = $(this);
                $this.button('loading');

                $.ajax({
                    url: '{{ url('/home/tang-like') }}',
                    type: 'POST',
                    data: {
                        'fbid': id,
                        'limit': $('#limit').val(),
                        '_token': $('input[name=_token]').val()
                    },
                    dataType: 'JSON',
                }).always(function () {
                    ajax_sendding = false;
                    $this.button('reset');
                }).error(function (data) {
                    console.log(data);
                    var results = data.responseJSON;
                    var msg = '';
                    $.each(results, function (key, value) {
                        msg += value[0] + "<br/>";
                    });

                    toastr.error(msg);
                }).success(function (data) {
                    toastr["success"](data['success']);
                });
            });


        });
    </script>

@endsection