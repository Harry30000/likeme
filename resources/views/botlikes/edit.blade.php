@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Botlike
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($botlike, ['route' => ['botlikes.update', $botlike->id], 'method' => 'patch']) !!}

                        @include('botlikes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection