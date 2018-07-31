@extends('layouts.app')

@section('sidebar-menu')
    <li class="active"><a href="{{ url('/home') }}"><i class="fa fa-fw fa-dashboard"></i> <span>Dashboard</span></a>
    </li>
    <li><a href="{{ url('/home/tang-like') }}"><i class="fa fa-fw fa-thumbs-up"></i> <span>Tăng Like</span></a></li>
    <li><a href="{{ url('/home/tang-comment') }}"><i class="fa fa-fw fa-commenting"></i> <span>Tăng Comment</span></a>
    </li>
@endsection
<!-- Content Header (Page header) -->
@section('content-header')
    <h1>
        {{ $page_title or "Dashboard" }}
        <small>{{ $page_description or "Log" }}</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ url('dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Log</li>
    </ol>
@endsection

<!-- Main content -->
@section('content')
    <!-- Your Page Content Here -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Data Table With Full Features</h3>
                </div>

                <div class="box-body">
                    <table id="tableLog" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>User Id</th>
                            <th>Object Id</th>
                            <th>Bot Like</th>
                            <th>Auto Like</th>
                            <th>Auto Comment</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>{!! $log->id !!}</td>
                                <td>{!! $log->user_id !!}</td>
                                <td>
                                    <a href="https://href.li/?https://www.facebook.com/{!! $log->object_id !!}"
                                       target="_blank">{!! $log->object_id !!}</a>
                                </td>
                                <td>{!! $log->botlike !!}</td>
                                <td>{!! $log->like !!}</td>
                                <td>{!! $log->comment !!}</td>
                                <td>{!! $log->created_at !!}</td>
                                <td>{!! $log->updated_at !!}</td>
                            </tr>
                        @endforeach
                        </tbody>

                        <tfoot>
                        <tr>
                            <th>Id</th>
                            <th>User Id</th>
                            <th>Object Id</th>
                            <th>Bot Like</th>
                            <th>Auto Like</th>
                            <th>Auto Comment</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')

    @include('layouts.partials.scripts')

    <script>
        $(document).ready(function () {
            $('#tableLog').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true
            });
        });
    </script>

@endsection