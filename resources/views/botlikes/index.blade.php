@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Botlikes</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('botlikes.create') !!}">Add New</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Table With Full Features</h3>
                    </div>

                    <div class="box-body">
                        @include('botlikes.table')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    @include('layouts.partials.scripts')

    <script>
        $(document).ready(function () {
            $('#tableBotLike').DataTable({
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
