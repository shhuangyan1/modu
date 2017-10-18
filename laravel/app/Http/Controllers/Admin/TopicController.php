<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Model\Topic;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title= $request->get('title');
        $select = $request->get('select');
        $data =Topic::where(function($query)use($title){
            if($title){
                $query -> where('title', 'like', '%'.$title.'%');
            }

        })->where(function($query)use($select){
            if(isset($select)){
                if($select==2){
                    return;
                }
                $query-> where('status','=',$select);
            }
        })
            ->orderby('id','desc')->paginate(10);
        //$data=Topic::where('status',0)->get();
        //dd($data);
        return view('admin.topic.list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.topic.new');
    }
    public function info()
    {

        return view('admin.topic.info');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');//dd($data);
        $file = $request->file('image');//dd($file);
        if($file){
            $allowed_extensions = ["png", "jpg", "gif","jpeg"];
            if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
                return ['error' => 'You may only upload png, jpg, jpeg or gif.'];
            }
            $date = date('Y-m-d',time());//dd($date);
            $destinationPath = 'storage/topic/'.$date.'/'; //public 文件夹下面建 storage/uploads 文件夹
            $extension = $file->getClientOriginalExtension();
            $fileName = str_random(20).'.'.$extension;
            $file->move($destinationPath, $fileName);

            $filePath = asset($destinationPath.$fileName);//dd($filePath);
        }
        $data['image']=$filePath;//dd($data);
        $data['time']=date('Y-m-d H:i:s',time());
        $info = Topic::create($data);
        //dd($info);
        if($info){
            return redirect('admin/topic');
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
    /*public function show($id)
    {
      // return view('admin.topic.')
    }*/

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
        $info = Topic::where('id',$id)->update(['status'=>1]);
        if($info){
            echo json_encode(array('status'=>1000,'msg'=>'更新成功1'));
        }else{
            echo json_encode(array('status'=>1001,'msg'=>'更新失败1'));
        }
    }

    public function stoptopic(Request $request){
        
        $id = $request->get('id');
        $info = Topic::where('id',$id)->update(['status'=>1]);
        //var_dump($id);die;
        if($info){
            echo json_encode(array('status' => 1000, 'msg'=>'更新成功!'));
        }else{
            echo json_encode(array('status' => 1001, 'msg'=>'更新失败!'));

        }

    }
    public function topic_format(){
        $results = DB::select('select MAX(id) from topic');
        $arr = get_object_vars($results[0]);
        $maxid = $arr['MAX(id)'];
        $num = DB::table("topic_comment")
            ->where("top_id",$maxid)
            ->count();
        $topic = DB::table("topic")
            ->where("id",$maxid)
            ->select("id","image","title","content","view")
            ->get();
        foreach($topic as $v){
            $v->join=$num;
        }
        echo json_encode($topic,JSON_UNESCAPED_UNICODE);
    }
    public function oldtopic_format(){
        if(empty($_GET['id'])){
            $results = DB::select('select MAX(id) from topic');
            $arr = get_object_vars($results[0]);
            $maxid = $arr['MAX(id)'];
            if($maxid==null){
                $topic=array();
                echo json_encode($topic,JSON_UNESCAPED_UNICODE);die;
            }
            $topic = DB::table("topic")
                ->select("id","image","title","content","view")
                ->where("id","<",$maxid)
                ->limit(5)
                ->orderBy('id','desc')
                ->get();
            foreach($topic as $v){
                $num = DB::table("topic_comment")
                    ->where("top_id",$v->id)
                    ->count();
                $v->join=$num;
            }
           echo json_encode($topic,JSON_UNESCAPED_UNICODE);
        }else{
            $current = $_GET['id'];
            $topic = DB::table("topic")
                ->where("id","<","$current-5")
                ->select("id","image","title","content","view")
                ->limit(5)
                ->orderBy('id','desc')
                ->get();
            foreach($topic as $v){
                $num = DB::table("topic_comment")
                    ->where("top_id",$v->id)
                    ->count();
                $v->join=$num;
            }
            echo json_encode($topic,JSON_UNESCAPED_UNICODE);
        }


    }

    public function topic_detail(){
        $map['id'] = $_GET['id'];
        $view = DB::table("topic")
            ->where($map)
            ->select("view")
            ->first();
        $view = $view->view +1;
        $topic = DB::table("topic")
            ->where($map)
            ->update(array("view"=>$view));
        $detail = DB::table("topic")
            ->select("id","image","title","content","view")
            ->where($map)
            ->limit(5)
            ->get();
        foreach($detail as $v){
            $v->join=0;
        }
        echo json_encode($detail,JSON_UNESCAPED_UNICODE);
    }
}
