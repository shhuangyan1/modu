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
        $input = $request -> input();
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
}
