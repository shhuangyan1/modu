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
                    $activity = DB::table("activity")
                        ->where("id",$v->resourceid)
                        ->select("image","title")
                        ->get();
                    foreach($activity as $k){
                        $v->title=$k->title;
                        $v->image=$k->image;
                        $v->join=0;
                    }
                }
                $v->time=date("Y-m-d H:i",$v->time);
            }
            echo json_encode($collect);


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
        $input['time'] = time();
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

}


