<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\comment;

class CommentController extends Controller
{
     public function index(){
    	return view('admin/comments/index')->withComments(Comment::all());
    }

     public function edit($id){
		return view('admin/comments/edit')->withComments(Comment::find($id));
    }

    public function update($id,Request $request){
		// 数据验证
    	$this->validate($request, [
        	'nickname' => 'required|max:255', // 必填、在 papers 表中唯一、最大长度 255
        	'email' => 'required|max:255', // 必填
        	'website' => 'required|max:255', // 必填
			'content' => 'required', // 必填
    	]);

		$comment = Comment::find($id);
		$comment->nickname = $request->get('nickname');
		$comment->email = $request->get('email');
		$comment->website = $request->get('website');
		$comment->content = $request->get('content');

		// 将数据更新到数据库，通过判断保存结果，控制页面进行不同跳转
		if ($comment->save()) {
        	return redirect('admin/comments'); // 编辑成功，跳转到 文章管理 页
    	} else {
        	// 编辑失败，跳回来路页面，保留用户的输入，并给出提示
        	return redirect()->back()->withInput()->withErrors('编辑失败！');
    	}
    }

    public function destroy($id){
    	Comment::find($id)->delete();
    	return redirect()->back()->withInput()->withErrors('删除成功！');
	}
}
