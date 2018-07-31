<table id="tableBotLike" class="table table-bordered" >
    <thead>
    <tr>
        <th>Id</th>
        <th>User Id</th>
        <th>Facebook Id</th>
        <th>Name</th>
        <th>Like</th>
        <th>Action</th>
    </tr>
    </thead>

    <tbody>
    @foreach($botlikes as $botlike)
        <tr>
            <td>{!! $botlike->id !!}</td>
            <td>{!! $botlike->user_id !!}</td>
            <td>
                <a href="https://href.li/?https://www.facebook.com/{!! $botlike->facebook_id !!}" target="_blank">{!! $botlike->facebook_id !!}</a>
            </td>
            <td>{!! $botlike->name !!}</td>
            <td>{!! $botlike->like !!}</td>
            <td>
                {!! Form::open(['route' => ['botlikes.destroy', $botlike->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('botlikes.show', [$botlike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('botlikes.edit', [$botlike->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>

    <tfoot>
    <tr>
        <th>Id</th>
        <th>User Id</th>
        <th>Facebook Id</th>
        <th>Name</th>
        <th>Like</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>