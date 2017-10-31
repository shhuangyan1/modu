<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use App\Http\Model\Category;
use App\Http\Model\Article;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class WxController extends Controller
{
    public $appId = 'wx93ff713a8e32c6be';
    public $appSecret = 'ddd2af2ceb83528ec190650762367f79';

    public function getopenid()
    {
        $js_code = $_GET['code'];
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid=$this->appId&secret=$this->appSecret&js_code=$js_code&grant_type=authorization_code";
        $res = file_get_contents($url);
        $res = json_decode($res);
        $openid = $res->openid;
        $date['openid'] = $openid;
        $_SESSION['openid'] = $openid;
        echo json_encode($date);
    }

    //用户授权登陆之后，收集用户信息
    public function usersave(Request $request){
        $input = $request->input();
        $input['time'] = time();
        //if(isset($input['openid'])){
            $map['openid'] = $input['openid'];
            $nouser = DB::table("user")
                ->where($map)
                ->first();
       // }
        //判断用户信息是否已经收集了
        if($nouser){
            $date['code']='fail';
            $date['msg']='信息已经收集了';
            die;
        }
        $user = DB::table("user")->insert($input);
    }

    public function collect(Request $request)
    {
        $input = $request->input();
        $map['resourceid'] =$input['resourceid'];
        $map['type'] = $input['type'];
        $map['openid'] =$input['openid'];
        $map['time'] = time();
        $collect = DB::table("collect")
            ->insertGetId($map);
        $data['id']=$collect;
        echo json_encode($data);

    }

    public function collectdell(Request $request){
        $input= $request->input();
        $id = $input['id'];
        $collect = DB::table("collect")
            ->where("id",$id)
            ->delete();
        if($collect){
            $data['msg']="删除成功！";
            echo json_encode($data);
        }
    }

    public function showcollect(){
        $map['openid'] = $_GET['openid'];
        if(empty($_GET['current'])){
            $collect = DB::table("collect")
                ->select("id","resourceid","type","time")
                ->where($map)
                ->limit(5)
                ->orderby("id","desc")
                ->get();
        }else{
            $current = $_GET['current'];
            $collect = DB::table("collect")
                ->select("id","resourceid","type","time")
                ->where($map)
                ->where("id","<",$current)
                ->limit(5)
                ->orderby("id","desc")
                ->get();
        }

            //dump($collect);die;
            foreach($collect as $v){
                if($v->type==1){
                    $article = DB::table("article")
                        ->where("id",$v->resourceid)
                        ->select("title","author")
                        ->get();
                    foreach($article as $k){
                        $v->title=$k->title;
                        $v->author=$k->author;
                    }

                }
                if($v->type==2){
                    $resourceid = $v ->resourceid;
                    $topic = DB::table("topic")
                        ->where("id",$resourceid)
                        ->select("title","image")
                        ->get();
                    $num = DB::table("topic_comment")
                        ->where("top_id",$resourceid)
                        ->count();
                    foreach($topic as $k){
                        $v->title=$k->title;
                        $v->image=$k->image;
                        $v->join=$num;
                    }
                }
                if($v->type==3){
                    $resourceid = $v ->resourceid;
                    $activity = DB::table("activity")
                        ->where("id",$v->resourceid)
                        ->select("image","title")
                        ->get();
                    $num = DB::table("join_activity")
                        ->where("act_id",$resourceid)
                        ->count();
                    foreach($activity as $k){
                        $v->title=$k->title;
                        $v->image=$k->image;
                        $v->join=$num;
                    }
                }
                $v->time=date("Y-m-d H:i",$v->time);
            }
            echo json_encode($collect);


    }

    //魔都小程序个人中心我的活动接口
    public function my_activities(){
        $map['openid'] = $_GET['openid'];
        //$map['openid'] = 'o81b50LEXGR1jWLgImzDcm0eNHp4';
        //join("article","article.id","=","article_recommend.article_id")
        if(empty($_GET['current'])){
            $join_activity = DB::table("join_activity")
                ->join("activity","activity.id","=","join_activity.act_id")
                ->select("activity.id","image","title","activity.time","status")
                ->where($map)
                ->limit(5)
                ->orderby("join_activity.id","desc")
                ->get();

        }else{
            $current = $_GET['current'];
            $join_activity = DB::table("join_activity")
                ->join("activity","activity.id","=","join_activity.act_id")
                ->select("activity.id","image","title","activity.time","status")
                ->where($map)
                ->where("activity.id","<",$current)
                ->limit(5)
                ->orderby("join_activity.id","desc")
                ->get();
        }
        foreach($join_activity as $v){
            $join = get_object_vars($v);
            //dump($join);die;
            $acttimestart = strtotime($join['time']);
            $acttimeend = $acttimestart+3600*6;

            if($join['status'] == 1){
                $v->msg="活动已经结束！";
            }else{
                if($acttimestart<=time()){
                    $v->msg="活动正在进行！";
                }elseif($acttimestart>time()){
                    $resttime = $acttimestart - time();
                    $rest = floor($resttime/86400);
                    $v->msg="活动开始剩余".$rest."天";
                }
            }

        }

        echo json_encode($join_activity);
    }

    public function topic_comment(Request $request){
        $input= $request->input();
        $map['top_id'] = $input['top_id'];
        $map['comment'] = $input['comment'];
        $map['time'] = time();
        $map['openid'] = $input['openid'];
        $arr[] = $input['avatarUrl'];
        $arr[] = $input['nickName'];
        $str=implode(",", $arr);
        $map['userinfo'] = $str;
        $id = DB::table("topic_comment")
            ->insertGetId($map);
        $comment = DB::table("topic_comment")
            ->where("id",$id)
            ->first();
        $comment->time=date("Y-m-d H:i:s",$comment->time);
        //$array=explode(separator,$string);
        $array = explode(",",$comment->userinfo);
        $comment->avatarUrl=$array[0];
        $comment->nickName=$array[1];
        unset($comment->userinfo);
        echo json_encode($comment);
    }

    public function article_comment(Request $request){
        $input = $request->input();
        $map['article_id'] = $input['article_id'];
        $map['comment'] = $input['comment'];
        $map['time'] = time();
        $map['openid'] = $input['openid'];
        $arr[] = $input['avatarUrl'];
        $arr[] = $input['nickName'];
        $str=implode(",", $arr);
        $map['userinfo'] = $str;
        $id = DB::table("article_comment")
            ->insertGetId($map);
        $comment = DB::table("article_comment")
            ->where("id",$id)
            ->first();
        //$comment->thumb=0;
        $comment->time=date("Y-m-d H:i:s",$comment->time);
        //$array=explode(separator,$string);
        $array = explode(",",$comment->userinfo);
        $comment->avatarUrl=$array[0];
        $comment->nickName=$array[1];
        unset($comment->userinfo);
        echo json_encode($comment);
    }

    public function topic_commentlist(){
        $map['top_id']=$_GET['top_id'];
        if(empty($_GET['current'])){
            $topic = DB::table("topic_comment")
                ->select("comment","time","userinfo","id")
                ->where($map)
                ->limit(8)
                ->orderby("id","desc")
                ->get();
            foreach($topic as $v){
                $v->time=date("Y-m-d H:i:s",$v->time);
                $arr = explode(",",$v->userinfo);
                $v->avatarUrl = $arr[0];
                $v->nickName = $arr[1];
                $v->thumb=0;
            }
        }else{
            $current = $_GET['current'];
            $topic = DB::table("topic_comment")
                ->select("comment","time","userinfo","id")
                ->where($map)
                ->where("id","<",$current)
                ->limit(8)
                ->orderby("id","desc")
                ->get();
            foreach($topic as $v){
                $v->time=date("Y-m-d H:i:s",$v->time);
                $arr = explode(",",$v->userinfo);
                $v->avatarUrl = $arr[0];
                $v->nickName = $arr[1];
                $v->thumb=0;
            }
        }
        echo json_encode($topic);
    }

    public function article_commentlist(){
        $map['article_id']=$_GET['article_id'];
        if(empty($_GET['current'])){
            $article = DB::table("article_comment")
                ->select("comment","time","userinfo","id","thumb")
                ->where($map)
                ->limit(8)
                ->orderby("id","desc")
                ->get();
            foreach($article as $v){
                $v->time=date("Y-m-d H:i:s",$v->time);
                $arr = explode(",",$v->userinfo);
                $v->avatarUrl = $arr[0];
                $v->nickName = $arr[1];
                //$v->thumb=0;
            }
        }else{
            $current = $_GET['current'];
            $article = DB::table("article_comment")
                ->select("comment","time","userinfo","id","thumb")
                ->where($map)
                ->where("id","<",$current)
                ->limit(8)
                ->orderby("id","desc")
                ->get();
            foreach($article as $v){
                $v->time=date("Y-m-d H:i:s",$v->time);
                $arr = explode(",",$v->userinfo);
                $v->avatarUrl = $arr[0];
                $v->nickName = $arr[1];
                //$v->thumb=0;
            }
        }
        echo json_encode($article);
    }

    public function back(Request $request){
        $input = $request->input();
        $map['openid'] = $input['openid'];
        $map['content'] = $input['content'];
        $map['time'] = time();
        $back = DB::table('back')
            ->insert($map);
    }

    public function thumb(Request $request){
        $input = $request->input();
        $type = $input['type'];
        $id = $input['id'];
        if($type==1){
            $article = DB::table("article_comment")
                ->where("id",$id)
                ->first();
            $article = get_object_vars($article);
            $thumb = $article['thumb'] + 1;
            //var_dump($thumb);die;
            $articlecomment = DB::table("article_comment")
                ->where("id",$id)
                ->update(array("thumb"=>$thumb));
            echo json_encode($thumb);
        }else{
            $topic = DB::table("topic_comment")
                ->select("thumb")
                ->where("id",$id)
                ->first();
            $topic->thumb = $topic->thumb + 1;
            $topiccomment = DB::table("topic_comment")
                ->where("id",$id)
                ->update("thumb",$topic->thumb);
            echo json_encode($topic->thumb);
        }
    }

    public function act_comment(Request $request){
        $input= $request->input();
        $map['act_id'] = $input['act_id'];
        $map['content'] = $input['content'];
        $map['time'] = time();
        $map['openid'] = $input['openid'];
        $arr[] = $input['avatarUrl'];
        $arr[] = $input['nickName'];
        $str=implode(",", $arr);
        $map['userinfo'] = $str;
        $id = DB::table("act_comment")
            ->insertGetId($map);
        $comment = DB::table("act_comment")
            ->where("id",$id)
            ->first();
        $comment->time=date("Y-m-d H:i:s",$comment->time);
        //$array=explode(separator,$string);
        $array = explode(",",$comment->userinfo);
        $comment->avatarUrl=$array[0];
        $comment->nickName=$array[1];
        unset($comment->userinfo);
        echo json_encode($comment);
    }

    public function act_commentlist(){
        $map['act_id']=$_GET['act_id'];
        if(empty($_GET['current'])){
            $actvity = DB::table("act_comment")
                ->select("content","time","userinfo","id","reply")
                ->where($map)
                ->limit(8)
                ->orderby("id","desc")
                ->get();
            foreach($actvity as $v){
                $v->time=date("Y-m-d H:i:s",$v->time);
                $arr = explode(",",$v->userinfo);
                $v->avatarUrl = $arr[0];
                $v->nickName = $arr[1];
            }
        }else{
            $current = $_GET['current'];
            $actvity = DB::table("act_comment")
                ->select("content","time","userinfo","id","reply")
                ->where($map)
                ->where("id","<",$current)
                ->limit(8)
                ->orderby("id","desc")
                ->get();
            foreach($actvity as $v){
                $v->time=date("Y-m-d H:i:s",$v->time);
                $arr = explode(",",$v->userinfo);
                $v->avatarUrl = $arr[0];
                $v->nickName = $arr[1];
            }
        }
        echo json_encode($actvity);
    }
    /*public function getuserinfo(){
        $js_code = $_GET['code'];
        //https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=APPID&secret=APPSECRET
        $url1 = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$this->appId&secret=$this->appSecret&code=$js_code&grant_type=authorization_code";
        $res1 = file_get_contents($url1);
        $res1 = json_decode($res1);
        $access_token = $res1->access_token;

        $openid = "o81b50LEXGR1jWLgImzDcm0eNHp4";


        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid&lang=zh_CN ";
        $res = file_get_contents($url);
        $res = json_decode($res);
        echo 'nihao';
        dump($res);

    }*/

    //个人中心 文章收藏数 和活动参与数接口
    public function pieces(){
        $openid = $_GET['openid'];
        $join_activity = DB::table("join_activity")
            ->where("openid",$openid)
            ->count();
        $article_comment = DB::table("collect")
            ->where("openid",$openid)
            ->count();
        $date['collect'] = $article_comment;
        $date['actnum'] = $join_activity;
        echo json_encode($date);
    }

    //个人中心系统消息更新
    public function update_message(){

        if(empty($_GET['current'])){
            $id = DB::select("select max(id) from message");
            $id = get_object_vars($id[0]);
           $info = DB::table("message")
               ->where("id",$id)
               ->get();


        }else{
            $info = DB::table("message")
                ->where("id",">",$_GET['current'])
                ->get();

        }
        foreach($info as $v){
            $v->time = date("Y-m-d H:i",$v->time);
        }

        echo json_encode($info);
    }

    //管理员信息修改
    public function pwd_modify(Request $request){
        $input = $request->input();
        $password = md5($input['old_password']);
        $user=DB::table('admin')
            ->where(array('username'=>session('user')->username,'admin_pwd'=>$password))
            ->get();
        if(!$user){
            $date['fail']='fail';
            $date['msg'] = "密码错误！";
            echo json_encode($date);die;
        }
        $password = md5($input['new_password']);
        $admin = DB::table("admin")
            ->where("username",session('user')->username)
            ->update(array('admin_pwd'=>$password));
        if($admin){
            $date['success']='success';
            $date['msg'] = "修改成功！";
            echo json_encode($date);
        }
    }



}

