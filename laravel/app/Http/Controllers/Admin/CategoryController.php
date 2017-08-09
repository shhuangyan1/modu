<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Model\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller{
	public function index(){
		$category=(new Category)->tree();
		return view('admin.category.list')->with('data',$category);
	}

	public function create(){
		$data=Category::where('cat_pid',0)->get();

		return view('admin.category.add',compact('data'));
	}

	public function store(){
		$input=Input::except('_token');//dd($input);
		$rule=[
			'cat_name'=>'required',
		];
		$message = [
			'cat_name.required'=>'分类名称不能为空!',
		];
		$validator = Validator::make($input,$rule,$message);
		//dd($validator);exit;
		if($validator->passes()){
			
			$result = Category::create($input);//dd(12333);exit;
			if(!empty($result)){
				return redirect('admin/category');
			}else{
				return back()->with('error',"数据添加失败");
			}
		}else{
			return back()->withErrors($validator);
		}
	}

		public function edit($id){
			$info=Category::find($id);//dd($info);
			$data=Category::where('cat_pid',0)->get();
			return  view('admin.category.edit',compact('field','data'));
		}

		public function update(){

		}

		public function destory(){

		}

}





