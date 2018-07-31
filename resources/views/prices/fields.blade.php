<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::number('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Like Limit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('like_limit', 'Like Limit:') !!}
    {!! Form::number('like_limit', null, ['class' => 'form-control']) !!}
</div>

<!-- Comment Limit Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comment_limit', 'Comment Limit:') !!}
    {!! Form::number('comment_limit', null, ['class' => 'form-control']) !!}
</div>

<!-- Like Field -->
<div class="form-group col-sm-6">
    {!! Form::label('like', 'Like:') !!}
    {!! Form::number('like', null, ['class' => 'form-control']) !!}
</div>

<!-- Comment Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comment', 'Comment:') !!}
    {!! Form::number('comment', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('prices.index') !!}" class="btn btn-default">Cancel</a>
</div>
