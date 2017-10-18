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

    public function index(Request $request){
        $user = $request->get('nickname');
        $data = User::where(function($query)use( $user){
            if( $user){
                $query -> where('nickname', 'like', '%'. $user.'%');
            }
        })->orderby('id','desc')->get();
        //dump($data);die;
        return view('admin.user.list',compact('data'));
    }

    public function date(){
        return view("admin/user/info");
    }
}