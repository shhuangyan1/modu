<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/1/31
 * Time: 11:56
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Model\Pingguo;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class PingguoController extends Controller{

    //用户领取小树苗
    public function index(Request $request){
        $input = $request->input();
        $openid = $input["openid"];
        $apple = DB::table("apple")->where(array('openid'=>$openid))->first();

        if(!$apple){
            //若果没有，新增一棵苹果树
            DB::table("apple")->insert(array("openid"=>$openid));
            $apple = DB::table("apple")->where(array('openid'=>$openid))->first();
        }
        $apple = get_object_vars($apple);
        $water = $apple['water'];
        $pid = $apple['pid'];
        $todaytime=strtotime("today");
        $info = DB::table('record_water')
            ->join('user', 'record_water.openids', '=', 'user.openid')
            ->where(array('pid'=>$pid))
            ->where('watertime', '>=', $todaytime)
            ->select('record_water.*','user.nickName','user.avatarUrl')
            ->get();
        foreach($info as $v){
            $v->watertime=date("Y-m-d H:i",$v->watertime);
        }
        $date['info'] = $info;
        $date['pid'] = $pid;
        $date['water'] = $water;
        echo json_encode($date);


    }

    public function helpIndex(Request $request){
        $input = $request->input();
        $openid = $input["openid"];
        $apple = DB::table("apple")->where(array('openid'=>$openid))->first();

        if(!$apple){
            //若果没有，新增一棵苹果树
            DB::table("apple")->insert(array("openid"=>$openid));
            $apple = DB::table("apple")->where(array('openid'=>$openid))->first();
        }
        $apple = get_object_vars($apple);
        $water = $apple['water'];
        $pid = $apple['pid'];
        $todaytime=strtotime("today");
        $info = DB::table('record_water')
            ->join('user', 'record_water.openids', '=', 'user.openid')
            ->where(array('pid'=>$pid))
            ->where('watertime', '>=', $todaytime)
            ->select('record_water.*','user.nickName','user.avatarUrl')
            ->get();
        foreach($info as $v){
            $v->watertime=date("Y-m-d H:i",$v->watertime);
        }
        $date['info'] = $info;
        $date['pid'] = $pid;
        $date['water'] = $water;
        echo json_encode($date);


    }


    //苹果剩余多少箱
    public function apple_box(){
        $info = DB::table('pingguo_address')->count();
        $info = 200 - $info;
        $date['num'] = $info;
        echo json_encode($date);
    }

    //用户点击浇水
    public function water(Request $request){
        $input = $request->input();
        $map['openids'] = $input["openid"];
        $map['pid'] = $input['pid'];
        $todaytime=strtotime('today');
        $info = DB::table('record_water')->where($map) ->where('watertime', '>=', $todaytime)->first();
        if($info){
            $date['fail'] = 'fail';
            $date['msg'] = '您今天已浇过水！';

        }else{
            $map['watertime'] = time();
            DB::table("record_water")->insert($map);//添加一条浇水记录
            DB::table('apple')->where('pid','=',$map['pid'])->increment('water');
            $date['success'] = 'success';
            $date['msg'] = '浇水成功！';

        }
        echo json_encode($date);

    }

    //苹果树长大，填写地址领取苹果
    public function fillAddress(Request $request){
        $input = $request->input();
        $map['openid'] = $input['openid'];
        $info = DB::table('pingguo_address')->where($map)->first();
        if($info){
            $date['msg'] = '您已经领取苹果，请不要重复领取！';
            $date['fail'] = 'fail';
        }else{
            $count = DB::table("pingguo_address")->count();
            $input['lastbox'] = 200 - $count;
            DB::table('pingguo_address')->insert($input);
            $date['msg'] = '地址填写成功';
            $date['success'] = 'success';
        }
        echo json_encode($date);

    }
    public function showaddr(){
        $info = DB::table("pingguo_address")->paginate(25);

        return view("admin.pingguo.address",compact('info'));
    }

    public function waterlist(){

    if(isset($_POST['water'])){

    $map['water'] = $_POST['water'];
    //dump($map['water']);
    if($map['water'] == ""){
    $info = DB::table("apple")->join('user', 'user.openid', '=', 'apple.openid')->orderby("water","desc")->paginate(25);
    }else{
    $info = DB::table("apple")->join('user', 'user.openid', '=', 'apple.openid')->where($map)->orderby("water","desc")->paginate(25);
    }



             foreach($info as $v){
             if($v->gender==1){
                $v->gender="男";
             }elseif($v->gender==2){
                $v->gender="女";
             }else{
                $v->gender="未知";
             }
             }
    }else{
            $info = DB::table("apple")->join('user', 'user.openid', '=', 'apple.openid')->orderby("water","desc")->paginate(25);
                     foreach($info as $v){
                     if($v->gender==1){
                        $v->gender="男";
                     }elseif($v->gender==2){
                        $v->gender="女";
                     }else{
                        $v->gender="未知";
                     }
                     }
    }

        return view('admin.pingguo.waterlist',compact('info'));
        }

    //浇水次数查询
    	public function water_search(){
    	$map['water'] = 5;//$_POST['water'];
    	$info = DB::table("apple")->join('user', 'user.openid', '=', 'apple.openid')->where($map)->orderby("water","desc")->paginate(25);
    	echo json_encode($info);
    	}
}