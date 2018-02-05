@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="panel panel-default col-md-10 col-md-offset-1">
            <div class="panel-heading">
                <h4>
                    <i class="glyphicon glyphicon-edit"></i>编辑资料
                </h4>
            </div>
            @include('common.error')
            <div class="panel-body">
                <form action="{{ route('users.update',$user->id) }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <label for="name-field">用户名</label>
                        <input type="text" name="name" id="name-field" class="form-control" value="{{ old('name',$user->name) }}" />
                    </div>

                    <div class="form-group">
                        <label for="email-field">邮箱</label>
                        <input type="email" name="email" id="email-field" class="form-control" value="{{ old('email',$user->email) }}" />
                    </div>

                    <div class="form-group">
                        <label for="avatar">用户头像</label>
                        <input type="file" name="avatar" >
                        @if($user->avatar)
                            <hr/>
                            <img src="{{ $user->avatar }}" width="200" class="thumbnail img-responsive"/>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="introduction-field" >个人简介</label>
                        <textarea name="introduction" id="introduction-field" class="form-control" rows="3" >{{ old('introduction',$user->introduction) }}</textarea>
                    </div>

                    <div class="well well-sm">
                        <button class="btn btn-primary" type="submit">保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
