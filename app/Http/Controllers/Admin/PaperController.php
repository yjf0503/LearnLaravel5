<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Paper;

class PaperController extends Controller
{
    public function index(){
    	return view('admin/paper/index')->withPapers(Paper::all());
    }

    public function create(){
    	return view('admin/paper/create');
    }

    public function store(Request $request) // Laravel 的依赖注入系统会自动初始化我们需要的 Request 类
	{
    	// 数据验证
    	$this->validate($request, [
        	'title' => 'required|unique:papers|max:255', // 必填、在 papers 表中唯一、最大长度 255
        	'body' => 'required', // 必填
    	]);

    	// 通过 Paper Model 插入一条数据进 papers 表
    	$paper = new Paper; // 初始化 Article 对象
    	$paper->title = $request->get('title'); // 将 POST 提交过了的 title 字段的值赋给 paper 的 title 属性
    	$paper->body = $request->get('body'); // 同上
    	$paper->user_id = $request->user()->id; // 获取当前 Auth 系统中注册的用户，并将其 id 赋给 paper 的 user_id 属性

    	// 将数据保存到数据库，通过判断保存结果，控制页面进行不同跳转
    	if ($paper->save()) {
        	return redirect('admin/papers'); // 保存成功，跳转到 文章管理 页
    	} else {
        	// 保存失败，跳回来路页面，保留用户的输入，并给出提示
        	return redirect()->back()->withInput()->withErrors('保存失败！');
    	}
	}

	public function edit($id){
		return view('admin/paper/edit')->withPaper(Paper::find($id));
	}

	public function update($id,Request $request){
		// 数据验证
    	$this->validate($request, [
        	'title' => 'required|max:255', // 必填、在 papers 表中唯一、最大长度 255
        	'body' => 'required', // 必填
    	]);

		$paper = Paper::find($id);
		$paper->title = $request->get('title');
		$paper->body = $request->get('body');

		// 将数据更新到数据库，通过判断保存结果，控制页面进行不同跳转
		if ($paper->save()) {
        	return redirect('admin/papers'); // 编辑成功，跳转到 文章管理 页
    	} else {
        	// 编辑失败，跳回来路页面，保留用户的输入，并给出提示
        	return redirect()->back()->withInput()->withErrors('编辑失败！');
    	}
	}

	public function destroy($id){
    	Paper::find($id)->delete();
    	return redirect()->back()->withInput()->withErrors('删除成功！');
	}
}
