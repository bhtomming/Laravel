<div class="panel panel-default">
    <div class="panel panel-body">
        <a href="{{ route('topics.create') }}" class="btn btn-success btn-block" aria-label="Left Align">
            <span class="glyphicon glyphicon-pencil"></span>
            发布新帖
        </a>
    </div>
</div>

@if(count($activeUsers))
    <div class="panel panel-default">
        <div class="active-users panel-body">
            <div class="text-center">活跃用户</div>
            <hr/>
            @foreach($activeUsers as $activeUser)
                <a class="media" href="{{ route('users.show',$activeUser->id) }}">
                    <div class="media-left media-middle">
                        <img src="{{ $activeUser->avatar }}" width="24px" height="24px" class="img-circle media-object"/>
                    </div>

                    <div class="media-body">
                        <span class="media-heading">{{ $activeUser->name }}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endif