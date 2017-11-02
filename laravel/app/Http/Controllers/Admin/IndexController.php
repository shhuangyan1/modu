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
		return view('admin.person');
	}

	public function get_grant(){
		$username=session('user')->username;
		$admin = DB::table("admin")
				->select("auth_id")
				->where("username",$username)
				->get();
		echo json_encode($admin);
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

	//首页文章阅读量走势图接口
	public function totalviews(){

		$map['date'] = date("Y-m-d",time()-86400);
		$articel_total_nums = DB::table("article_total_nums")
				->where("date",$map['date'])
				->first();
		if(!$articel_total_nums){
			$map['views'] = DB::table("article")
					->sum('view');
			$info = DB::table("article_total_nums")
					->insert($map);
		}

		$articel_total_nums = DB::table("article_total_nums")
				->get();

		echo json_encode($articel_total_nums);
	}

	//各类文章占比饼形图
	public function article_piechart(){
		$info = DB::select('select cat_name,count("cat_id") as num from article INNER JOIN category ON article.cat_id=category.id GROUP by cat_id');
		echo json_encode($info);
	}

}