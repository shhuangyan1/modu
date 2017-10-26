<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/9
 * Time: 10:10
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Model\Activity;
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

        return view('admin.message.system');
    }
}
