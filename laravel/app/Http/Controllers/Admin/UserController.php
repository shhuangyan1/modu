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

class UserController extends Controller{

    public function index(){

        return view('admin.user.list');
    }

    public function date(){
        return view("admin/user/info");
    }

    //往user.list页面填充数据接口
    public function fill(Request $request){
        $user = $request->get('nickname');
        $data = User::where(function($query)use( $user){
            if( $user){
                $query -> where('nickname', 'like', '%'. $user.'%');
            }
        })->orderby('id','desc')->paginate(5);
        //dump($data);die;
        echo json_encode($data);
    }
}