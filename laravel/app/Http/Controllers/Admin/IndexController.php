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

		$articel_total_nums = DB::table("article_total_nums")
				->get();
		foreach($articel_total_nums as $v){
			$v->date = strtotime($v->date);
		}
		echo json_encode($articel_total_nums);
	}

	//各类文章占比饼形图
	public function article_piechart(){
		$info = DB::select('select cat_name,count("cat_id") as num from article INNER JOIN category ON article.cat_id=category.id GROUP by cat_id');
		echo json_encode($info);
	}

}