<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

Class IndexController extends Controller{
	public function index(){

		return view('admin.index');
	}

	public function info(){
		return view('admin.info');
	}
	public function modify(){
		return view('admin.password');
	}
}