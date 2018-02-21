@include('common.error')
<div class="reply-box">
    <form name="reply" id="reply-form" action="{{ route('replies.store') }}" method="post" accept-charset="utf-8">
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <input type="hidden" name="topic_id" value="{{ $topic->id }}"/>
        <div class="form-group">
            <textarea name="content" class="form-control" rows="3" placeholder="请输入你要分享的想法"></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-share"></i> 回复</button>
    </form>
</div>
<hr/>