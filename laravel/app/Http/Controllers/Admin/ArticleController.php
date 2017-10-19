<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use App\Http\Model\Category;
use App\Http\Model\Article;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

Class ArticleController extends Controller{
	public function index(Request $request){

		$info = (new category)->tree();
		$title=$request->get('title');
		$cat_id=$request->get('cat_id');
		$data = Article::where(function($query)use($title,$cat_id){
				if($title){
					$query -> where('title', 'like', '%'.$title.'%');
				}
				if($cat_id){
					$query ->where('cat_id', $cat_id);
				}
		})->where('status','0')->join('category','article.cat_id','=','category.id')->select('article.*','category.cat_name')->orderby('article.id','desc')->paginate(10);

		//dd($data);
		return view('admin.article.list',compact('data','info'));
	}

	//将添加页面所需要的数据分配到页面中
	public function create(){
		$data=(new category)->tree();
		//dd($category);
		return view('admin.article.publish',compact('data'));
	}

	//获取表单提交过来的数据(post方法)
	public function store(Request $request){
		$filePath='';
		$file = '';
		$file1 = $file2 = $file3 = '';
		$compose = $_POST['compose'];
		if($compose==3){
			$file = $request->file('image1');
			}
		elseif($compose==1){
			$file = $request->file('image2');
		}
		elseif($compose==2){
			$file1 = $request->file('image3');
			$file2 = $request->file('image4');
			$file3 = $request->file('image5');
		}
		if($file){
			$allowed_extensions = ["png", "jpg", "gif"];
			if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
				return ['error' => 'You may only upload png, jpg or gif.'];
			}

			$destinationPath = 'storage/uploads/'; //public 文件夹下面建 storage/uploads 文件夹
			$extension = $file->getClientOriginalExtension();
			$fileName = str_random(10).'.'.$extension;
			$file->move($destinationPath, $fileName);

			$filePath = asset($destinationPath.$fileName);
		}
		if($file1){
			$allowed_extensions = ["png", "jpg", "gif"];
			if ($file1->getClientOriginalExtension() && !in_array($file1->getClientOriginalExtension(), $allowed_extensions)) {
				return ['error' => 'You may only upload png, jpg or gif.'];
			}

			$destinationPath = 'storage/uploads/'; //public 文件夹下面建 storage/uploads 文件夹
			$extension = $file1->getClientOriginalExtension();
			$fileName = str_random(10).'.'.$extension;
			$file1->move($destinationPath, $fileName);

			$filePath[] = asset($destinationPath.$fileName);
		}
		if($file2){
			$allowed_extensions = ["png", "jpg", "gif"];
			if ($file2->getClientOriginalExtension() && !in_array($file2->getClientOriginalExtension(), $allowed_extensions)) {
				return ['error' => 'You may only upload png, jpg or gif.'];
			}

			$destinationPath = 'storage/uploads/'; //public 文件夹下面建 storage/uploads 文件夹
			$extension = $file2->getClientOriginalExtension();
			$fileName = str_random(10).'.'.$extension;
			$file2->move($destinationPath, $fileName);

			$filePath[] = asset($destinationPath.$fileName);
		}
		if($file3){
			$allowed_extensions = ["png", "jpg", "gif"];
			if ($file3->getClientOriginalExtension() && !in_array($file3->getClientOriginalExtension(), $allowed_extensions)) {
				return ['error' => 'You may only upload png, jpg or gif.'];
			}

			$destinationPath = 'storage/uploads/'; //public 文件夹下面建 storage/uploads 文件夹
			$extension = $file3->getClientOriginalExtension();
			$fileName = str_random(10).'.'.$extension;
			$file3->move($destinationPath, $fileName);

			$filePath[] = asset($destinationPath.$fileName);
			//$char = implode("^", $array);
			$filePath = implode(',',$filePath);
		}
		//dump($filePath);die;
		$input=Input::except('_token');
		//$author = session('user.attributes.username');
		$author = session('user')->username;
//		$rule = [
//			'title'=>'required',
//			'from'=>'required',
//		];
//		$message = [
//			'title.required' => '标题不能为空!',
//			'from.required'=>'来源不能为空!',
//		];
		//$validate = Validator::make($input,$rule,$message);
		//dd(Input::all());
		//if($validate->passes()){
			/*if($filePath){
				$input['image']=$filePath;
			}*/
		if($compose==3){
			$input['image'] = $filePath;
			unset($input['image1']);
		}
		elseif($compose==1){
			$input['image'] = $filePath;
			unset($input['image2']);
		}
		elseif($compose==2){
			$input['image'] = $filePath;
			unset($input['image5']);
			unset($input['image4']);
			unset($input['image3']);
		}
			$input['author']=$author;
			$input['time']=time();
			//dd($input);exit;
		$result = DB::table("article")
				->insertGetId($input);
		$data['time']=$input['time'];
		$data['article_id']=$result;
		$article = DB::table("article_recommend")
				->insert($data);
			if($result){
				return redirect('admin/article');
			}else{
				return back()->with('error','数据添加失败!');
			}
		//}
		//dd($input);

	}

	public function rule(){
		$regular = DB::table("regular")
				->get();
		return view("admin/article/rule",compact('regular'));
	}
	public function detail(){
    		return view("admin/article/detail");
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
		$article = DB::table("article_recommend")
				->select("id")
				->where("article_id",$id)
				->first();
		if($article->id){
			$info=DB::table("article_recommend")
					->where("article_id",$id)
					->delete();
		}
		$collect = DB::table("collect")
				->where(array("resourceid"=>$id,"type"=>1))
				->delete();
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

	public function confirm(){
		//$info = Article::where('status','1')->orderby('id','desc')->paginate(5);
		$info = DB::table('articleconfirm')->join('article','article.id','=','articleconfirm.article_id')->join('category','article.cat_id','=','category.id')->select('articleconfirm.*','article.title','article.author','category.cat_name')->paginate(10);
		//dd($info);
		return view('admin.article.confirm',compact('info'));
	}

	public function  shenhe(Request $request){
		$id = $request->get('id');//dd($id);
		$info= Article::where('id',$id)->update(['status' => 1]);
		$articleconfirm['time'] = time();
		$articleconfirm['article_id'] = $id;
		DB::table('articleconfirm')->insert($articleconfirm);
		if($info){
			$data['status'] = 1000;
			$data['msg'] = '更改成功!';
			echo json_encode($data);
		}else{
			$data['status'] = 1001;
			$data['msg'] = '更改失败!';
			echo json_encode($data);
		}
	}
	//文章管理，恢复删除文章
	public function article_recover(Request $request){
		$id = $request->get("id");
		$info= Article::where('id',$id)->update(['status' => 0]);
		$articleconfirm = DB::table("articleconfirm")->where("article_id",$id)->delete();
		if($articleconfirm){
			$data['success'] = 'success';
			$data['msg'] = '文章恢复成功!';
			echo json_encode($data);
		}else{
			$data['fail'] = 'fail';
			$data['msg'] = '文章恢复失败!';
			echo json_encode($data);
		}
	}
	public function article_format(){

		$cat_id = $_GET['cat_id'];

		//$cursor = $_GET['cursor'];

		if(!empty($_GET['current'])){
			$current = $_GET['current'];
			$current = $current - 8;
			$map['cat_id'] = $cat_id;
			if($map['cat_id']==0){
				//$info = DB::table('articleconfirm')->join('article','article.id','=','articleconfirm.article_id')->join('category','article.cat_id','=','category.id')->select('articleconfirm.*','article.title','article.author','category.cat_name')->paginate(10);
				$article = DB::table("article_recommend")
						->join("article","article.id","=","article_recommend.article_id")
						->select("title","author","compose","from","article.id","view","image")
						->where("article_id","<","$current")
						->orderby("article_recommend.id","desc")
						->limit(8)
						->get();
				$num = DB::table('article_recommend')
						->where("article_id","<","$current")
						->limit(8)
						->count();
				if($num == 0){
					$data['msg']='没有最新的了！';
				}else{
					$data['msg']="页面已加载".$num."条数据";
				}

			}else{
				$article = DB::table("article")
						->where($map)
						->where("id","<","$current")
						->select("title","author","compose","from","id","view","image")
						->orderby("id","desc")
						->limit(8)
						->get();
				$num = DB::table("article")
						->where($map)
						->where("id","<","$current")
						->select("title","author","compose","from","id","view","image")
						->limit(8)
						->count();
				if($num == 0){
					$data['msg']='没有最新的了！';
				}else{
					$data['msg']="页面已加载".$num."条数据";
				}
			}
			$data['num'] = $num;
			$data['article']=$article;
			$data['status']=1001;
			echo json_encode($data,JSON_UNESCAPED_UNICODE);
		}else{
			$map['cat_id'] = $cat_id;
			if($map['cat_id']==0){
			//$info = DB::table('articleconfirm')->join('article','article.id','=','articleconfirm.article_id')->join('category','article.cat_id','=','category.id')->select('articleconfirm.*','article.title','article.author','category.cat_name')->paginate(10);
			$article = DB::table("article_recommend")
					->join("article","article.id","=","article_recommend.article_id")
					->select("title","author","compose","from","article.id","view","image")
					->orderby("article_recommend.id","desc")
					->limit(8)
					->get();
				$num = DB::table('article_recommend')
						->limit(8)
						->count();
				if($num<8){
					$num = $num;
				}else{
					$num=8;
				}

			}else{
				$article = DB::table("article")
						->where($map)
						->select("title","author","compose","from","id","view","image")
						->orderby("id","desc")
						->limit(8)
						->get();
				$num = DB::table('article')
						->where($map)
						->count();
				if($num<8){
					$num = $num;
				}else{
					$num=8;
				}
			}
			$data['num']=$num;
			$data['article']=$article;
			$data['msg']="页面已加载".$num."条数据";
			$data['status']=1000;
			echo json_encode($data,JSON_UNESCAPED_UNICODE);
		}


		/*if(!empty($cursor)){
			if($cursor=='down'){
				$map['cat_id'] = $cat_id;
				$article = DB::table("article")
						->where($map)
						->where("id","<","$current-8")
						->select("title","author","compose","from","id","view","image")
						->limit(8)
						->get();
				$data['article']=$article;
				$data['msg']='加载更多';
				$data['status']=1001;
				echo json_encode($data,JSON_UNESCAPED_UNICODE);
			}else{
				$results = DB::select('select MAX(id) from article');
				$arr = get_object_vars($results[0]);
				$maxid = $arr['MAX(id)'];
				if($maxid=$current){
					$map['cat_id'] = $cat_id;
					$article = DB::table("article")
							->where($map)
							->where("id","<","$current-8")
							->select("title","author","compose","from","id","view","image")
							->orderby("id","desc")
							->limit(8)
							->get();
					$data['article']=$article;
					$data['msg']='当前文章最新';
					$data['status']=1000;
					echo json_encode($data,JSON_UNESCAPED_UNICODE);
				}else{
					$map['cat_id'] = $cat_id;
					$article = DB::table("article")
							->where($map)
							->select("title","author","compose","from","id","view","image")
							->limit(8)
							->get();
					$data['article']=$article;
					$data['msg']='刷新成功！';
					$data['status']=1000;
					echo json_encode($data,JSON_UNESCAPED_UNICODE);
				}
			}

		}else{
			$map['cat_id'] = $cat_id;
			$article = DB::table("article")
					->where($map)
					->select("title","author","compose","from","id","view","image")
					->orderby("id","desc")
					->limit(8)
					->get();
			//select("title","author","compose","from","id","view","image");
			//dump($article);die;
			$num = DB::table('article')
					->where($map)
					->count();
			if($num<8){
				$num = $num;
			}else{
				$num=8;
			}
			$data['num']=$num;
			$data['article']=$article;
			$data['msg']='页面初始化成功！';
			$data['status']=1000;
			echo json_encode($data,JSON_UNESCAPED_UNICODE);
		}*/
	}

	public function article_detail(){
		$openid = $_GET['openid'];
		$map['id'] = $_GET['id'];
		$view = DB::table("article")
				->where($map)
				->select("view")
				->first();
		$view = $view->view +1;
		/*$article = DB::table("article")
				->where($map)
				->update(array("view"=>$view));*/
		$article= DB::table("article")
				->where($map)
				->update(array("view"=>$view));
		$collect = DB::table("collect")
				->where(array("resourceid"=>$map['id'],"type"=>1,"openid"=>$openid))
				->first();
		$detail = DB::table("article")
				->where($map)
				->select("title","content","author","from")
				->first();
		if($collect){
			$detail->collect=1;
			$detail->id=$collect->id;
		}else{
			$detail->collect=0;
		}
		echo json_encode($detail,JSON_UNESCAPED_UNICODE);
	}
	public function ai_publish(){
		$category = DB::table("category")
				->get();
		//dump($category);die;
		return view('admin/article/ai_publish',compact('category'));
	}
	public function preview(){
        return view('admin/article/preview');
	}

	public function ai_article(){
		//var_dump($_POST);
		$url = @$_POST['url'];
//echo $url;
		if(!empty($url)) {
			$html = file_get_contents($url);
			$a = date("YmdHis");
			file_put_contents('htmls/'.$a.'.html',$html);

//echo $html;
			/*$pattern = "/<[img|IMG].*?data-src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png|\.jpeg]))[\'|\"].*?[\/]?>/";*/
			$pattern = "/<[img|IMG].*?data-src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png|\.jpeg|\.0]))[\'|\"].*?[\/]?>/";
			preg_match_all($pattern, $html, $match);
			$count = sizeof($match[1]);
			//var_dump($match[1]);die;
			$a = 'htmls/'.$a.'.html';
			/*$str1 = file_get_contents($match[1][0]);
            $str2 = file_get_contents($match[1][1]);
            file_put_contents('images/1.jpg',$str1);
            file_put_contents('images/2.jpg',$str2);*/
//print_r($str);die;
//$str = file_get_contents($match[1][3]);
//var_dump($match[1]) ;
//file_put_contents('images/b.gif',$str);
			//dump($match[1]);die;
			for ($i = 0; $i < $count; $i++) {
				$str[] = file_get_contents($match[1][$i]);
				$c = time().rand(1000,9999);
				file_put_contents('image/'.$c.'.jpg', $str[$i]);
				$b['image'][]='image/'.$c.'.jpg';

			}
			$b['file']=$a;
			echo json_encode($b);

		}
	}
	//回传全部规则，给智能发布文章页面
	public function showregular(){
		$regular = DB::table("regular")
				->get();
		echo json_encode($regular);
	}

	//解析规则管理，添加规则
	public function addregular(Request $request){
		$input=$request->input();
		$regular = DB::table("regular")->insertGetId($input);
		echo json_encode($regular);
	}
	//解析规则管理，修改规则
	public function modifyregular(Request $request){
		$input=$request->input();
		$map['id']=$input['id'];
		$regular = DB::table("regular")
				->where($map)
				->update($input);
		if($regular){
			$date['code']="success";
			$date['msg']="更新成功！";
		}else{
			$date['code']="success";
			$date['msg']="更新成功！";
		}
		echo json_encode($date);
	}


	//智能发布文章 ，确定发布接口
	public function confirm_release(Request $request){
		$input = $request->input();
		if(isset($input['recommend'])){
			unset($input['recommend']);
			$data['article_id'] = DB::table("article")->insertGetId($input);
			$data['time']=time();
			$article_recommend = DB::table("article_recommend")
					->insert($data);
			if($article_recommend){
				return redirect('admin/article');

			}else{
				return back()->with('error','发布失败!');
			}

		}else{
			$article = DB::table("article")->insert($input);
			if($article){
				return redirect('admin/article');
			}else{
				return back()->with('error','发布失败!');
			}
		}
	}

}














?>