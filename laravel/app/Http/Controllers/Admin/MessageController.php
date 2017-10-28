<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/9
 * Time: 10:10
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Model\Message;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;


class MessageController extends Controller{
    public function index(){
        //$data = Activity::where('status',0)->get();
        //dd($data);

        return view('admin.message.activity');
    }

    public function show()
    {
        $data = DB::table("back")
            ->orderby('id','desc')
            ->paginate(5);
        return view('admin.message.back',compact('data'));
    }


    public function system_msg(){
        $data = DB::table("message")
            ->orderby('id','desc')
            ->paginate(5);

        return view('admin.message.system',compact('data'));
    }

    public function store(Request $request){
        $input = $request->input();
        $input['time'] = time();
        $input['sendby']= session('user')->username;
        $message = DB::table("message")
            ->insertGetId($input);
        $data = DB::table("message")
            ->orderby('id','desc')
            ->paginate(5);
        return view('admin.message.system',compact('data'));
    }

    public function destroy($id)
    {
        //删除系统消息
        $info = Message::where('id',$id)->delete();
        if($info){
            echo json_encode(array('success'=>"success",'msg'=>'删除成功'));
        }else{
            echo json_encode(array('fail'=>"fail",'msg'=>'删除失败'));
        }
    }

}
