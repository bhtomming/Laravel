@extends('layouts.app')
@section('title')
    我的消息
@stop
@section('content')
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3 class="text-center">
                    <span class="glyphicon glyphicon-bell" aria-hidden="true"></span>我的通知
                </h3>
                <hr/>

                @if($notifications->count())
                    @foreach($notifications as  $notification)
                        @include('notifications.types._'.snake_case(class_basename($notification->type)))
                    @endforeach
                    {!! $notifications->render() !!}
                    @else
                    <div class="empty-block">没有新的通知</div>
                @endif
            </div>
        </div>
    </div>
@stop