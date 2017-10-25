<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use DB;

Class IndexController extends Controller{
	public function index(){

		return view('admin.index');
	}

	public function info(){
		return view('admin.info');
	}
	public function modify(){
		return view('admin.password');
	}
	//掌上魔都整体情况接口
	public function nums(){
		$articlenums = DB::table("article")
				->count();
		$topicnums = DB::table("topic")
				->count();
		$activitynums = DB::table("activity")
				->count();
		$usernums = DB::table("user")
				->count();
		$nums['articlenums'] = $articlenums;
		$nums['topicnums'] = $topicnums;
		$nums['activitynums'] = $activitynums;
		$nums['usernums'] = $usernums;
		echo json_encode($nums);
	}

	//记录文章总阅读数接口
	public function totalviews(){
		$views = DB::table("article")
				->sum('view');
		$map['views'] = $views;
		$map['time'] = time();
		$id = DB::table("article_total_nums")
				->insertGetId($map);
		if($id){
			echo "success";
		}else{
			echo "fail";
		}
	}

}