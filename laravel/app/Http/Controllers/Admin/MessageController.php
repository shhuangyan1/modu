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
        return view('admin.message.activity');
    }

    public function show()
    {
        return view('admin.message.back');
    }
}