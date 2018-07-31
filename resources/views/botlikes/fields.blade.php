<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::number('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Facebook Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('facebook_id', 'Facebook Id:') !!}
    {!! Form::text('facebook_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Like Field -->
<div class="form-group col-sm-6">
    {!! Form::label('like', 'Like:') !!}
    {!! Form::number('like', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('botlikes.index') !!}" class="btn btn-default">Cancel</a>
</div>
