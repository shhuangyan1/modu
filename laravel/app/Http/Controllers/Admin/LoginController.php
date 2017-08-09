<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;

require_once '/lirary/code/Code.class.php';
class LoginController extends Controller{
	public function login(Request $request){
		if($input = $request->input()){
			$code=new \Code();
			$getcode=$code->get();
			if(strtoupper($input['code'])!=$getcode){
				return back()->with('msg','验证码错误');
			}
echo 123;
			$user=User::first();//echo Crypt::encrypt(123456);
			if($user->username != $input['username'] ||  $input['password']!= Crypt::decrypt($user->admin_pwd)){
				return back()->with('msg','用户名或者密码错误');
			}
			session(['user'=>$user]);
			//dd(session('user'));exit;
			return redirect('admin/index');

		}else{
			//echo Crypt::encrypt(123456);
			return view('admin/login');
		}


	}
	public  function code(){
		$code=new \Code();
		$code->make();
	}

	public function logout(){
		session(['user'],null);
		return redirect('admin/login');
	}

	public function jiekou(){
		$data['status']=1;
		$data['msg']="querenchengsgj";
		echo json_encode($data);
	}
}