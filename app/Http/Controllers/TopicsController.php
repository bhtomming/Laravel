<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Category;
use App\Models\Topic;
use App\Http\Controllers\Controller;
use App\Http\Requests\TopicRequest;
use Auth;
use Symfony\Component\HttpFoundation\Request;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index(Request $request, Topic $topic)
	{
		//$topics = Topic::with('user','category')->paginate(30);
        $topics = $topic->withOrder($request->older)->paginate(20);
		return view('topics.index', compact('topics'));
	}

    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }

	public function create(Topic $topic)
	{
	    $categories = Category::all();
		return view('topics.create_and_edit', compact('topic','categories'));
	}

	public function store(TopicRequest $request, Topic $topic)
	{
		//$topic = Topic::create($request->all());
        $topic->fill($request->all());
        $topic->user_id = Auth::id();
        $topic->save();
		return redirect()->route('topics.show', $topic->id)->with('message', '创建成功！');
	}

	public function edit(Topic $topic)
	{
        $this->authorize('update', $topic);
		return view('topics.create_and_edit', compact('topic'));
	}

	public function update(TopicRequest $request, Topic $topic)
	{
		$this->authorize('update', $topic);
		$topic->update($request->all());

		return redirect()->route('topics.show', $topic->id)->with('message', '更新成功！');
	}

	public function destroy(Topic $topic)
	{
		$this->authorize('destroy', $topic);
		$topic->delete();

		return redirect()->route('topics.index')->with('message', '删除成功');
	}

	public function uploadImage(Request $requset,ImageUploadHandler $uploader){
        $data = [
            'success' => false,
            'msg' =>'上传失败',
            'file_path'=>'',
        ];
        if($file = $requset->upload_file){
            $result = $uploader->save($requset->upload_file,'topics',\Auth::id(),1024);
            if($result){
                $data['file_path'] = $result['path'];
                $data['success'] = true;
                $data['msg'] = '上传成功';
            }
        }

        return $data;
    }
}