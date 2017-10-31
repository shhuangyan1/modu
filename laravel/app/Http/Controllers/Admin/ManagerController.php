<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Model\Manager;
use App\Http\Controllers\Controller;
use DB;
class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $manage = $request->get('username');
        $data = Manager::where(function($query)use( $manage){
            if( $manage){
                $query -> where('username', 'like', '%'. $manage.'%');
            }
        })->orderby('id','desc')->paginate(10);

      // dd($data);
        return view('admin.manager.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manager.join');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //存储表单提交过来的信息
        $input = $request -> except('authority');
        $input['admin_pwd'] = md5($input['admin_pwd']);
        $admin = DB::table("admin")->insert($input);
        if($admin){
            return redirect('admin/manager');
        }else{
            return back()->with('error','数据添加失败!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除管理员
        $info = Manager::where('id',$id)->delete();
        if($info){
            echo json_encode(array('success'=>"success",'msg'=>'删除成功'));
        }else{
            echo json_encode(array('fail'=>"fail",'msg'=>'删除失败'));
        }
    }


    public function menus(){

        return view('admin.manager.menus');
    }

    //权限管理添加新的父级菜单项
    public function add_pmenus(Request $request){
        $input = $request->input();
        $grant = DB::table("grant")->insert($input);
        if($grant){
            $date['success'] = 'success';
            $date['msg'] = '数据添加成功！';
            echo json_encode($date);
        }else{
            $date['fail'] = 'fail';
            $date['msg'] = '数据添加失败！';
            echo json_encode($date);
        }
    }

    //权限管理添加子页面接口
    public function add_cmenus(Request $request){
        $input = $request->input();
        $grant = DB::table("grant")->insert($input);
        if($grant){
            $date['success'] = 'success';
            $date['msg'] = '数据添加成功！';
            echo json_encode($date);
        }else{
            $date['fail'] = 'fail';
            $date['msg'] = '数据添加失败！';
            echo json_encode($date);
        }
    }

    //加载全部grant信息接口
    public function showgrant(){
        $grant = DB::table("grant")
            ->get();
        echo json_encode($grant);
    }

    //权限管理菜单编辑接口
    public function editmenus(){
        $map['name']=$_GET['name'];
        $map['url'] = $_GET['url'];
        $grant = DB::table("grant")
            ->update($map);
        if($grant){
            $date['success'] = 'success';
            $date['msg'] = '数据修改成功！';
            echo json_encode($date);
        }else{
            $date['fail'] = 'fail';
            $date['msg'] = '数据修改失败！';
            echo json_encode($date);
        }
    }
}
