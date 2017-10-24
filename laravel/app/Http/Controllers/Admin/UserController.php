<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/18
 * Time: 10:02
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Model\User;
use App\Http\Controllers\Controller;
use DB;

class UserController extends Controller{

    public function index(){

        return view('admin.user.list');
    }

    public function date(){
        return view("admin/user/info");
    }

    //往user.list页面填充数据接口
    public function fill(Request $request){
        /*$user = $request->get('nickname');
        $data = User::where(function($query)use( $user){
            if( $user){
                $query -> where('nickname', 'like', '%'. $user.'%');
            }
        })->orderby('id','desc')->get();
        dump($data);die;*/
        $input = $request->input();
        //$map['pagesize'] = $input['pagesize'];
        // $map['nickName'] = $input['nickName'];
        //$map['current'] = $input['current'];

        if(!empty($input['nickname'])){
            //$map['nickName'] = $input['nickname'];
            $data = DB::table("user")
                ->where(array("nickName","like",'%'.$input['nickname'].'%'))
                ->get();
            if($data){
                $data = $data;
            }else{
                $data['msg'] = "当前查询下没有数据！";
            }
        }else{
            $a = $input['current'] - 1;
            $b = $input['pagesize'];
            $data = DB::table("user")
                ->orderby("id","desc")
                ->offset($a*$b)
                ->limit($b)
                ->get();
            //dump($data);die;
        }


        //dump($user);die;
        echo json_encode($data);
    }
}