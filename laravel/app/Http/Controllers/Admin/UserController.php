<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/18
 * Time: 10:02
 */
namespace App\Http\Controllers\Admin;

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
}