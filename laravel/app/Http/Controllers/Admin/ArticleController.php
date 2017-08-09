<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Model\category;
use App\Http\Model\article;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


Class ArticleController extends Controller{
	public function index(){
		$data = Article::orderby('id','desc')->paginate(2);
		return view('admin.article.list',compact('data'));
	}

	//将添加页面所需要的数据分配到页面中
	public function create(){
		$data=(new category)->tree();
		//dd($category);
		return view('admin.article.add',compact('data'));
	}
	//获取表单提交过来的数据(post方法)
	public function store(){

		$input=Input::except('_token');
		$rule = [
			'title'=>'required',
			'author'=>'required',
		];
		$message = [
			'title.required' => '标题不能为空!',
			'author.required'=>'作者不能为空!',
		];
		$validate = Validator::make($input,$rule,$message);
		if($validate->passes()){
			$result = Article::create($input);
			if($result){
				return redirect('admin/article');
			}else{
				return back()->with('error','数据添加失败!');
			}
		}
		//dd($input);

	}

	public function edit($id){
		$category = (new Category)->tree();
		$data=Article::find($id);
		//dd($data);
		return view('admin.article.edit',compact('data','category'));
	}
	public function update($id){
		$input=input::except('_method','_token');
		$info=Article::where('id',$id)->update($input);
		if($info){
			return redirect('admin/article');
		}else{
			return back()->with('error','更新错误');
		}
	}

	public function destroy($id){
		$info=Article::where('id',$id)->delete();
		if($info){
			$data = [
				'status'=>1,
				'msg'=>'删除成功!',
			];
		}else{
			$data = [
				'status'=>0,
				'msg'=>'删除失败',
			];
		}
		return $data;
	}

	public function upload(){
		$file = Input::file();
		dd($file);
		if($file -> isValid()){
			$entension = $file -> getClientOriginalExtension(); //上传文件的后缀.
			$newName = date('YmdHis').mt_rand(100,999).'.'.$entension;
			$path = $file -> move(base_path().'/uploads',$newName);
			$filepath = 'uploads/'.$newName;
			return $filepath;
		}
	}
}














?>