<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Model\Category;
use App\Http\Model\Article;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use DB;

class CategoryController extends Controller{
	public function index(){
		$category=(new Category)->tree();
		return view('admin.category.list')->with('data',$category);
	}

	public function create(){
		$data=Category::where('cat_pid',0)->get();

		return view('admin.category.add',compact('data'));
	}

	public function category_format(){
		$data=DB::table("category")
				->select("id","cat_name")
				->get();
		foreach($data as $v){
			$v->name = $v->cat_name;
			unset($v->cat_name);
		}
		//dump($data);die;
		echo json_encode($data,JSON_UNESCAPED_UNICODE);
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
			return  view('admin.category.edit',compact('info','data'));
		}

		public function update($id){
			$input = input::except('_token','_method');
			//dd($input);
			$info = Category::where('id',$id)->update($input);
			if($info){
				return redirect('admin/category');
			}else{
				return back()->with('error','更新错误!');
			}

		}

		public function destroy($id){
            $info = DB::table('article')
                ->where('cat_id',$id)
                ->get();
			if($info){
				echo json_encode(array('status'=>1002,'msg'=>'该分类下还有文章,不能删除'));
			}else{
				$data = Category::where('id',$id)->delete();
				if($data){
					echo json_encode(array('status'=>1000,'msg'=>'删除成功'));
				}else{
					echo json_encode(array('status'=>1001,'msg'=>'删除失败'));
				}
			}

		}
	//下架分类类目

		public function off_category(){
			$id = $_GET['id'];
			$category = DB::table("category")
					->where("id",$id)
					->update(array("status"=>1));
			if($category){
				echo $data['success']='success';
			}else{
				echo $data['fail']='fail';
			}
		}
	//恢复分类类目

		public function recover_category(){

			$id = $_GET['id'];
			$category = DB::table("category")
					->where("id",$id)
					->update(array("status"=>0));
			if($category){
				echo $data['success']='success';
			}else{
				echo $data['fail']='fail';
			}
		}

}





