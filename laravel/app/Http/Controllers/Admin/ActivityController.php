<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Model\Activity;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $select = $request->get('select');
        $title= $request->get('title');

        $data =Activity::where(function($query)use($title){
            if($title){
                $query -> where('title', 'like', '%'.$title.'%');
            }

        })->where('status','!=',1)->where(function($query)use($select){
            if($select){
                if($select==3){
                    return;
                }
                $query-> where('status','=',$select);
            }
        })->orderby('id','desc')->paginate(5);
        //$data = Activity::where('status',0)->get();
        //dd($data);
        return view('admin.activity.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.activity.release');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');
        $restype = $request->get('restype');
        if($restype=='image'){
        $file = $request->file('image');//dd($file);
            if($file){
                $allowed_extensions = ["png", "jpg", "gif","jpeg"];
                if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
                    return ['error' => 'You may only upload png, jpg, jpeg or gif.'];
                }
                $date = date('Y-m-d',time());//dd($date);
                $destinationPath = 'storage/activity/'.$date.'/'; //public 文件夹下面建 storage/uploads 文件夹
                $extension = $file->getClientOriginalExtension();
                $fileName = str_random(20).'.'.$extension;
                $file->move($destinationPath, $fileName);

                $filePath = asset($destinationPath.$fileName);//dd($filePath);
                $data['image']=$filePath;//dd($data);
            }

        }else{

        }
        $data['addtime']=date('Y-m-d H:i',time());
        $info = Activity::create($data);
        if($info){
            return redirect('admin/activity');
        }else{
            return back()->with('error','数据插入失败!');
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
        $info = Activity::where('id',$id)->update(['status'=>1]);
        if($info){
            echo json_encode(array('status'=>1004,'msg'=>'取消成功'));
        }else{
            echo json_encode(array('status'=>1001,'msg'=>'取消失败'));
        }
    }

    public function uploadvideo(Request $request){
        $date = date('Y-m-d',time());
        $video = $request->file('video');
        if ($video) {//检查表单提交的时候是否有文件
//文件的存放目录 ./代表当前， / 在linux系统下是服务器更目录，在windows系统中是某盘的根目录
            $path = 'storage/activityvideo/'.$date.'/';
//获取后缀

            $suffix = $request->file('video')->getClientOriginalExtension();
            $suffixarr=['mp4','flv','wmv'];
            if(in_array($suffix, $suffixarr)){
                $fileName = time().rand(100000, 999999).'.'.$suffix;
                $request->file('video')->move($path, $fileName);
                //   $user -> profile = trim($path.'/'.$fileName,'.');
                $videoPath = asset($path.$fileName);//dd($videoPath);
                $data['status'] = 1000;
                $data['path'] = $videoPath;
                echo json_encode($data);

            }else{
                
                $data['status'] = 1001;
                $data['info'] = "文件不是视频，请上传格式为mp4/flv/png/wmv类型文件";
                echo json_encode($data);
               // return back()->with('info','文件不是视频，请上传格式为mp4/flv/png/wmv类型文件');
            }

        }
    }

    public function cancelactivity(Request $request){
        $id = $request->get('id');
        $info = Activity::where('id',$id)->update(['status'=>1]);
        if($info){
            echo json_encode(array('status' => 1000, 'msg'=>'更新成功!'));
        }else{
            echo json_encode(array('status' => 1001, 'msg'=>'更新失败!'));

        }

    }

    public function activity_format(){
        $activity = DB::table("activity")
            ->where("status",0)
            ->select("id","title","description","time","address","view","image","key")
            ->orderBy('id','desc')
            ->get();
        //dump($activity);die;
        foreach($activity as $v){
            $v->join=0;
        }
        echo json_encode($activity,JSON_UNESCAPED_UNICODE);
    }
    public function oldactivity_format(){
        if(empty($_GET['id'])){
            $_GET['id']='';
            $activity = DB::table("activity")
                ->select("id","title","time","view","image")
                ->where("status","=",1)
                ->limit(8)
                ->orderby("id","desc")
                ->get();

        }else{
            $current = $_GET['id'];
            $current = $current - 8;
            $map['status']=1;
            $activity = DB::table("activity")
                ->select("id","title","time","view","image")
                ->where($map)
                ->where("id","<",$current)
                ->limit(8)
                ->orderby("id","desc")
                ->get();
        }
        foreach($activity as $v){
            $v->join=0;
        }
        echo json_encode($activity,JSON_UNESCAPED_UNICODE);
    }

    public function activity_detail(){
            $openid = $_GET['openid'];
            $map['id'] = $_GET['id'];
            $view = DB::table("activity")
                ->where($map)
                ->select("view")
                ->first();
            $view = $view->view +1;
            $activity = DB::table("activity")
                ->where($map)
                ->update(array("view"=>$view));
            $collect = DB::table("collect")
                ->where(array("resourceid"=>$map['id'],"type"=>3,"openid"=>$openid))
                ->first();
            $detail = DB::table("activity")
                ->where($map)
                ->select("id","image","title","limits","fee","time","address","description","content")
                ->get();
            if($collect){
                foreach($detail as $v){
                    $v->joined='';
                    $v->joinedList='';
                    $v->collect=1;
                    $v->collectid=$collect->id;
                }
            }else{
                foreach($detail as $v){
                    $v->joined='';
                    $v->joinedList='';
                    $v->collect=0;
                }
            }

            echo json_encode($detail,JSON_UNESCAPED_UNICODE);

    }
}
