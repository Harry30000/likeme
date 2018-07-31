<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $price->id !!}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', 'Price:') !!}
    <p>{!! $price->price !!}</p>
</div>

<!-- Like Limit Field -->
<div class="form-group">
    {!! Form::label('like_limit', 'Like Limit:') !!}
    <p>{!! $price->like_limit !!}</p>
</div>

<!-- Comment Limit Field -->
<div class="form-group">
    {!! Form::label('comment_limit', 'Comment Limit:') !!}
    <p>{!! $price->comment_limit !!}</p>
</div>

<!-- Like Field -->
<div class="form-group">
    {!! Form::label('like', 'Like:') !!}
    <p>{!! $price->like !!}</p>
</div>

<!-- Comment Field -->
<div class="form-group">
    {!! Form::label('comment', 'Comment:') !!}
    <p>{!! $price->comment !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $price->description !!}</p>
</div>

